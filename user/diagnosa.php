<?php
include '../config.php';

// Initialize message variable
$message = '';

// Check if the AJAX request has been made
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    // Check if required fields are present
    if (isset($_POST['nama_pasien'], $_POST['alamat'], $_POST['umur'], $_POST['jenis_kelamin'], $_POST['status'])) {
        // Retrieve form data
        $nama_pasien = $_POST['nama_pasien'];
        $alamat = $_POST['alamat'];
        $umur = $_POST['umur'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $status = $_POST['status'];

        // Get selected symptoms
        $selected_gejala = isset($_POST['gejala']) ? $_POST['gejala'] : [];
        $penyakit_ditemukan = [];

        if (count($selected_gejala) > 0) {
            // Fetch rules from the database
            $query = $conn->query("SELECT * FROM aturan");

            // Forward chaining process
            while ($row = $query->fetch_assoc()) {
                $kode_gejala_rule = explode(',', $row['kode_gejala']);
                $kode_penyakit = $row['kode_penyakit'];
                $matched_gejala = array_intersect($kode_gejala_rule, $selected_gejala);
                $persentase = (count($matched_gejala) / count($kode_gejala_rule)) * 100;

                if ($persentase > 0) {
                    $penyakit_ditemukan[] = [
                        'kode_penyakit' => $kode_penyakit,
                        'persentase' => $persentase
                    ];
                }
            }

            // Sort diseases by matching percentage in descending order
            usort($penyakit_ditemukan, function ($a, $b) {
                return $b['persentase'] <=> $a['persentase'];
            });

            // Retrieve primary diagnosis details
            $penyakit_utama = $penyakit_ditemukan[0];
            $query_penyakit = $conn->prepare("SELECT nama_penyakit, detail_penyakit, saran_penyakit FROM penyakit WHERE kode_penyakit = ?");
            $query_penyakit->bind_param("s", $penyakit_utama['kode_penyakit']);
            $query_penyakit->execute();
            $result_penyakit = $query_penyakit->get_result();
            $penyakit_info = $result_penyakit->fetch_assoc();
            
            // Compile other possible diseases for display and saving
            $diagnosa_lainnya = [];
            foreach (array_slice($penyakit_ditemukan, 1) as $penyakit) {
                $query_penyakit = $conn->prepare("SELECT nama_penyakit FROM penyakit WHERE kode_penyakit = ?");
                $query_penyakit->bind_param("s", $penyakit['kode_penyakit']);
                $query_penyakit->execute();
                $result_penyakit = $query_penyakit->get_result();
                $additional_penyakit = $result_penyakit->fetch_assoc();
                $diagnosa_lainnya[] = $additional_penyakit['nama_penyakit'] . ' (' . round($penyakit['persentase'], 2) . '%)';
            }
            
            // Insert data into riwayat table
            $input_gejala = implode(',', $selected_gejala);
            $hasil_diagnosa = $penyakit_info['nama_penyakit'];
            $saran = $penyakit_info['saran_penyakit'];
            $detail_penyakit = $penyakit_info['detail_penyakit'];
            $diagnosa_lainnya_str = implode('; ', $diagnosa_lainnya);

            $insert_query = $conn->prepare("INSERT INTO riwayat (nama_pasien, alamat, umur, jenis_kelamin, status, input_gejala, hasil_diagnosa, saran, detail_penyakit, diagnosa_lainnya) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($insert_query === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            
            $insert_query->bind_param("ssisssssss", $nama_pasien, $alamat, $umur, $jenis_kelamin, $status, $input_gejala, $hasil_diagnosa, $saran, $detail_penyakit, $diagnosa_lainnya_str);

            // Execute the insert query
            if ($insert_query->execute()) {
                // Return results as JSON
                echo json_encode([
                    'success' => true,
                    'nama_penyakit' => $penyakit_info['nama_penyakit'],
                    'persentase' => round($penyakit_utama['persentase'], 2),
                    'detail_penyakit' => $penyakit_info['detail_penyakit'],
                    'saran' => $penyakit_info['saran_penyakit'],
                    'diagnosa_lainnya' => $diagnosa_lainnya
                ]);
                exit; // Prevent further execution
            } else {
                echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data: ' . $conn->error]);
                exit; // Prevent further execution
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Semua kolom harus diisi!']);
        exit; // Prevent further execution
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Penyakit Mata</title>
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: auto;
            margin-bottom: 20px;
        }
        th {
            text-align: center;
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }
        td {
            vertical-align: middle;
            text-align: center;
        }
        h1 {
            text-align: center; /* Center the title */
            background-color: blue; /* Blue background */
            color: white; /* White text color for contrast */
            padding: 20px; /* Padding around the text */

        }
        h3 {
            color: #343a40;
        }
        .card {
            margin-top: 20px;
        }
        .additional-diseases-list {
            list-style-type: none;
            padding: 0;
        }
        .additional-diseases-list li {
            padding: 10px 15px;
            background-color: #f1f1f1;
            margin: 0 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>



<div class="container">
<h1>Sistem Pakar Diagnosa Penyakit Mata</h1>


    <!-- Display success or error message -->
    <div id="message" class="alert alert-info" style="display: none;"></div>

    <!-- Form untuk informasi pasien -->
    <form id="diagnosisForm">
        <h3 class="mt-4">Informasi Pasien</h3>
        <div class="form-group">
            <label for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="umur">Umur</label>
            <input type="number" class="form-control" id="umur" name="umur" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status (bekerja/mahasiswa)</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>

        <h3 class="mt-4">Pilih Gejala yang Dialami:</h3>
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Kode Gejala</th>
                    <th>Keterangan Gejala</th>
                    <th>Pilih Gejala</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch symptoms from the database
                $query_gejala = $conn->query("SELECT * FROM gejala");
                while ($row = $query_gejala->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['kode_gejala']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['keterangan_gejala']) . '</td>';
                    echo '<td><input type="checkbox" name="gejala[]" value="' . htmlspecialchars($row['kode_gejala']) . '"></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success" id="diagnoseButton">Diagnosa</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#diagnosisForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Check if any symptom is selected
        const selectedGejala = $('input[name="gejala[]"]:checked');
        if (selectedGejala.length === 0) {
            alert('Silakan pilih gejala terlebih dahulu sebelum melakukan diagnosa.');
            return; // Stop further execution if no symptom is selected
        }

        $('#diagnoseButton').prop('disabled', true); // Disable button to prevent multiple submissions

        $.ajax({
            type: 'POST',
            url: 'diagnosa.php', // URL of the PHP script
            data: $(this).serialize() + '&ajax=true', // Serialize form data and append ajax flag
            success: function(response) {
                // Parse the JSON response
                const data = JSON.parse(response);
                $('#message').hide();
                $('#diagnoseButton').prop('disabled', false); // Enable the button again

                // Clear previous results
                $('.card').remove();

                // Display success message if any
                if (data.success) {
                    $('#message').text('Data berhasil disimpan ke riwayat.').show();
                    
                    // Display primary disease name
                    $('.container').append(`
                        <div class="card mt-4">
                            <div class="card-header bg-primary text-white">
                                <h2>Nama Penyakit</h2>
                            </div>
                            <div class="card-body">
                                <h4>${data.nama_penyakit} (Kemungkinan: ${data.persentase}%)</h4>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header bg-info text-white">
                                <h2>Detail Penyakit</h2>
                            </div>
                            <div class="card-body">
                                <p>${data.detail_penyakit}</p>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header bg-success text-white">
                                <h2>Saran Penyakit</h2>
                            </div>
                            <div class="card-body">
                                <p>${data.saran}</p>
                            </div>
                        </div>
                    `);

                    // Display additional diseases
                    if (data.diagnosa_lainnya.length > 0) {
                        const additionalDiseases = data.diagnosa_lainnya.map(function(disease) {
                            return `<li>${disease}</li>`;
                        }).join('');
                        $('.container').append(`
                            <div class="card mt-4">
                                <div class="card-header bg-secondary text-white">
                                    <h2>Kemungkinan Penyakit Lainnya</h2>
                                </div>
                                <div class="card-body">
                                    <ul class="additional-diseases-list">${additionalDiseases}</ul>
                                </div>
                            </div>
                        `);
                    }
                } else {
                    $('#message').text(data.message).show();
                }
            },
            error: function() {
                $('#message').text('Terjadi kesalahan saat menghubungi server.').show();
                $('#diagnoseButton').prop('disabled', false); // Enable button again
            }
        });
    });
});
</script>
