<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config.php';

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['kode_aturan'])) {
        // Update existing rule
        $kode_aturan = $_POST['kode_aturan'];

        if (isset($_POST['kode_gejala']) && is_array($_POST['kode_gejala'])) {
            $kode_gejala = implode(',', $_POST['kode_gejala']);
        } else {
            echo json_encode(["status" => "error", "message" => "Please select at least one symptom."]);
            exit;
        }

        $kode_penyakit = $_POST['kode_penyakit'];
        $update_sql = "UPDATE aturan SET kode_gejala='$kode_gejala', kode_penyakit='$kode_penyakit' WHERE kode_aturan='$kode_aturan'";

        if ($conn->query($update_sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Data aturan berhasil diupdate."]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        exit;
    } else {
        // Add new rule
        $result = $conn->query("SELECT kode_aturan FROM aturan ORDER BY kode_aturan DESC LIMIT 1");
        $last_code = $result->fetch_assoc();
        $last_number = (int)substr($last_code['kode_aturan'], 1);
        $new_code = 'A' . str_pad($last_number + 1, 2, '0', STR_PAD_LEFT);

        if (isset($_POST['kode_gejala']) && is_array($_POST['kode_gejala'])) {
            $kode_gejala = implode(',', $_POST['kode_gejala']);
        } else {
            echo json_encode(["status" => "error", "message" => "Please select at least one symptom."]);
            exit;
        }

        $kode_penyakit = $_POST['kode_penyakit'];
        $sql = "INSERT INTO aturan (kode_aturan, kode_gejala, kode_penyakit) VALUES ('$new_code', '$kode_gejala', '$kode_penyakit')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Data aturan berhasil ditambahkan dengan kode $new_code."]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        exit;
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $kode_aturan = $_GET['delete'];
    $delete_sql = "DELETE FROM aturan WHERE kode_aturan='$kode_aturan'";
    if ($conn->query($delete_sql) === TRUE) {
        echo json_encode(["status" => "success", "kode" => $kode_aturan]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
    exit();
}

// Fetch existing rules from the database
$aturan_result = $conn->query("SELECT * FROM aturan");

// Fetch symptoms and diseases for dropdown
$gejala_result = $conn->query("SELECT * FROM gejala");
$penyakit_result = $conn->query("SELECT * FROM penyakit");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aturan</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="card-title">Data Aturan</h4>
                            <button id="add-btn" class="btn btn-success">Tambah Data</button>
                        </div>
                        <div id="message" class="alert" style="display: none;"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Gejala</th>
                                        <th>Kode Penyakit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if ($aturan_result->num_rows > 0): ?>
                                    <?php while ($row = $aturan_result->fetch_assoc()): ?>
                                        <tr data-kode="<?= htmlspecialchars($row['kode_aturan']); ?>">
                                            <td><?= htmlspecialchars($row['kode_aturan']); ?></td>
                                            <td><?= htmlspecialchars(implode(', ', explode(',', $row['kode_gejala']))); ?></td>
                                            <td><?= htmlspecialchars($row['kode_penyakit']); ?></td>
                                            <td>
                                                <button class="btn btn-info edit-btn" data-kode="<?= htmlspecialchars($row['kode_aturan']); ?>" data-gejala="<?= htmlspecialchars($row['kode_gejala']); ?>" data-penyakit="<?= htmlspecialchars($row['kode_penyakit']); ?>">Edit</button>
                                                <button class="btn btn-danger delete-btn" data-kode="<?= htmlspecialchars($row['kode_aturan']); ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada aturan yang ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Aturan</h2>
            <form id="addForm">
                <label for="kode_gejala">Pilih Gejala:</label><br>
                <select name="kode_gejala[]" multiple required>
                    <?php
                    $gejala_result->data_seek(0);
                    while ($row = $gejala_result->fetch_assoc()): ?>
                        <option value="<?= $row['kode_gejala']; ?>"><?= htmlspecialchars($row['keterangan_gejala']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <label for="kode_penyakit">Pilih Penyakit:</label><br>
                <select name="kode_penyakit" required>
                    <?php
                    $penyakit_result->data_seek(0);
                    while ($row = $penyakit_result->fetch_assoc()): ?>
                        <option value="<?= $row['kode_penyakit']; ?>"><?= htmlspecialchars($row['nama_penyakit']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Aturan</h2>
            <form id="editForm">
                <input type="hidden" name="kode_aturan" id="edit_kode_aturan" value="">

                <label for="edit_kode_gejala">Pilih Gejala:</label><br>
                <select name="kode_gejala[]" id="edit_kode_gejala" multiple required>
                    <?php
                    $gejala_result->data_seek(0);
                    while ($row = $gejala_result->fetch_assoc()): ?>
                        <option value="<?= $row['kode_gejala']; ?>"><?= htmlspecialchars($row['keterangan_gejala']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <label for="edit_kode_penyakit">Pilih Penyakit:</label><br>
                <select name="kode_penyakit" id="edit_kode_penyakit" required>
                    <?php
                    $penyakit_result->data_seek(0);
                    while ($row = $penyakit_result->fetch_assoc()): ?>
                        <option value="<?= $row['kode_penyakit']; ?>"><?= htmlspecialchars($row['nama_penyakit']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <button type="submit" class="btn btn-info">Update</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#table').DataTable();

            // Show add modal
            $('#add-btn').click(function() {
                $('#addModal').show();
            });

            // Close modals
            $('.close').click(function() {
                $(this).closest('.modal').hide();
            });

            // Add rule with AJAX
            $('#addForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'tambah_aturan.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                            location.reload(); // Reload to see new data
                        } else {
                            $('#message').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
                        }
                    }
                });
            });

            // Populate edit modal and show it
            $('#table').on('click', '.edit-btn', function() {
                const kode = $(this).data('kode');
                const gejala = $(this).data('gejala').split(',');
                const penyakit = $(this).data('penyakit');

                $('#edit_kode_aturan').val(kode);
                $('#edit_kode_penyakit').val(penyakit);

                // Set selected options for symptoms
                $('#edit_kode_gejala option').each(function() {
                    $(this).prop('selected', gejala.includes($(this).val()));
                });

                $('#editModal').show();
            });

            // Edit rule with AJAX
            $('#editForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'tambah_aturan.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                            location.reload(); // Reload to see updated data
                        } else {
                            $('#message').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
                        }
                    }
                });
            });

            // Handle delete action
            $('#table tbody').on('click', '.delete-btn', function() {
                const kode_aturan = $(this).data('kode');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        type: 'GET',
                        url: 'tambah_aturan.php?delete=' + kode_aturan,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // Remove the row from the DataTable
                                const row = $(this).parents('tr');
                                table.row(row).remove().draw();
                                alert('Data berhasil dihapus!'); // Show delete success message
                            } else {
                                alert(response.message); // Show error message
                            }
                        }.bind(this), // Bind the context
                        error: function() {
                            alert('Error occurred while processing your request.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
