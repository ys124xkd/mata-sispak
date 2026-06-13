<?php
include '../config.php';

// Initialize the data array
$data = [];

// Fetch existing records from the riwayat table
$result = $conn->query("SELECT nama_pasien, alamat, umur, jenis_kelamin, status, input_gejala, hasil_diagnosa, saran, detail_penyakit, diagnosa_lainnya FROM riwayat");

if ($result) {
    // Fetch all rows into the $data array
    $data = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo json_encode(['success' => false, 'error' => "Error fetching data: " . $conn->error]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <title>Data Riwayat</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">Data Riwayat</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>Umur</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                    <th>Input Gejala</th>
                                    <th>Hasil Diagnosa</th>
                                    <th>Saran</th>
                                    <th>Detail Penyakit</th>
                                    <th>Diagnosa Lainnya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_pasien']); ?></td>
                                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                            <td><?php echo htmlspecialchars($row['umur']); ?></td>
                                            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                                            <td><?php echo htmlspecialchars($row['input_gejala']); ?></td>
                                            <td><?php echo htmlspecialchars($row['hasil_diagnosa']); ?></td>
                                            <td><?php echo htmlspecialchars($row['saran']); ?></td>
                                            <td><?php echo htmlspecialchars($row['detail_penyakit']); ?></td>
                                            <td><?php echo htmlspecialchars($row['diagnosa_lainnya']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" class="text-center">No data found</td>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>
</body>
</html>
