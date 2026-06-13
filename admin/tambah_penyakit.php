<?php
include '../config.php';

// Initialize the data array
$data = [];

// Fetch existing records from the penyakit table
$result = $conn->query("SELECT kode_penyakit, nama_penyakit, detail_penyakit, saran_penyakit FROM penyakit");

if ($result) {
    // Fetch all rows into the $data array
    $data = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo json_encode(['success' => false, 'error' => "Error fetching data: " . $conn->error]);
    exit;
}

// Handle POST request for adding, updating, and deleting records
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set header to return JSON response
    header('Content-Type: application/json');

    // Use prepared statements to prevent SQL injection
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'delete') {
            // Handle delete request
            $kode_penyakit = $_POST['kode_penyakit'];

            $delete_sql = $conn->prepare("DELETE FROM penyakit WHERE kode_penyakit = ?");
            $delete_sql->bind_param("s", $kode_penyakit);

            if ($delete_sql->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }
            exit;

        } elseif ($_POST['action'] === 'update') {
            // Handle update request
            $kode_penyakit = $_POST['kode_penyakit'];
            $nama_penyakit = $_POST['nama_penyakit'];
            $detail_penyakit = $_POST['detail_penyakit'];
            $saran_penyakit = $_POST['saran_penyakit'];

            // Prepare and execute update statement
            $update_sql = $conn->prepare("UPDATE penyakit SET nama_penyakit = ?, detail_penyakit = ?, saran_penyakit = ? WHERE kode_penyakit = ?");
            $update_sql->bind_param("ssss", $nama_penyakit, $detail_penyakit, $saran_penyakit, $kode_penyakit);

            if ($update_sql->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }
            exit;
        }
    }

    // Add a new penyakit
    $result = $conn->query("SELECT kode_penyakit FROM penyakit ORDER BY kode_penyakit DESC LIMIT 1");
    $last_code = $result->fetch_assoc();

    $last_number = $last_code ? (int)substr($last_code['kode_penyakit'], 1) : 0; // Default to 0 if no records exist
    $new_code = 'P' . str_pad($last_number + 1, 2, '0', STR_PAD_LEFT); // Create new code (P00, P01, etc.)

    $nama_penyakit = $_POST['nama_penyakit'];
    $detail_penyakit = $_POST['detail_penyakit'];
    $saran_penyakit = $_POST['saran_penyakit'];

    // Prepare and execute insert statement
    $sql = $conn->prepare("INSERT INTO penyakit (kode_penyakit, nama_penyakit, detail_penyakit, saran_penyakit) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $new_code, $nama_penyakit, $detail_penyakit, $saran_penyakit);

    if ($sql->execute()) {
        echo json_encode(['success' => true, 'new_code' => $new_code, 'nama_penyakit' => $nama_penyakit]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <title>Data Penyakit</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">Data Penyakit</h4>
                        <button id="add-btn" class="btn btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Penyakit</th>
                                    <th>Nama Penyakit</th>
                                    <th>Detail Penyakit</th>
                                    <th>Saran Penyakit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['kode_penyakit']); ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_penyakit']); ?></td>
                                            <td><?php echo htmlspecialchars($row['detail_penyakit']); ?></td>
                                            <td><?php echo htmlspecialchars($row['saran_penyakit']); ?></td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#editModal" 
                                                        data-kode="<?php echo htmlspecialchars($row['kode_penyakit']); ?>" 
                                                        data-nama="<?php echo htmlspecialchars($row['nama_penyakit']); ?>"
                                                        data-detail="<?php echo htmlspecialchars($row['detail_penyakit']); ?>"
                                                        data-saran="<?php echo htmlspecialchars($row['saran_penyakit']); ?>">Edit</button>
                                                <button class="btn btn-danger delete-btn" 
                                                        data-kode="<?php echo htmlspecialchars($row['kode_penyakit']); ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
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

<!-- Modal for adding data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-form" class="ajax-form" method="POST">
                    <div class="form-group">
                        <label for="nama_penyakit">Nama Penyakit</label>
                        <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" required>
                    </div>
                    <div class="form-group">
                        <label for="detail_penyakit">Detail Penyakit</label>
                        <textarea class="form-control" id="detail_penyakit" name="detail_penyakit" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="saran_penyakit">Saran Penyakit</label>
                        <textarea class="form-control" id="saran_penyakit" name="saran_penyakit" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form" class="ajax-form" method="POST">
                    <input type="hidden" name="kode_penyakit" id="edit_kode_penyakit" value="">
                    <div class="form-group">
                        <label for="edit_nama_penyakit">Nama Penyakit</label>
                        <input type="text" class="form-control" id="edit_nama_penyakit" name="nama_penyakit" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_detail_penyakit">Detail Penyakit</label>
                        <textarea class="form-control" id="edit_detail_penyakit" name="detail_penyakit" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_saran_penyakit">Saran Penyakit</label>
                        <textarea class="form-control" id="edit_saran_penyakit" name="saran_penyakit" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="action" value="update">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#table').DataTable();

    // Handle form submit with AJAX for add and edit
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var form = $(this);
        var action = form.is('#edit-form') ? 'update' : 'add';

        $.ajax({
            url: 'tambah_penyakit.php', // Pastikan URL sesuai dengan file PHP
            type: 'POST',
            data: form.serialize() + '&action=' + action,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(action === 'add' ? 'Data berhasil ditambahkan!' : 'Data berhasil diupdate!');
                    location.reload(); // Refresh halaman
                } else {
                    alert('Error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    // Handle delete button
    $(document).on('click', '.delete-btn', function() {
        var kode_penyakit = $(this).data('kode');

        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: 'tambah_penyakit.php', // Pastikan URL sesuai dengan file PHP
                type: 'POST',
                data: { action: 'delete', kode_penyakit: kode_penyakit },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil dihapus!');
                        location.reload(); // Refresh halaman
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        }
    });

    // Pass data to the edit modal
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var kode = button.data('kode');
        var nama = button.data('nama');
        var detail = button.data('detail');
        var saran = button.data('saran');

        var modal = $(this);
        modal.find('#edit_kode_penyakit').val(kode);
        modal.find('#edit_nama_penyakit').val(nama);
        modal.find('#edit_detail_penyakit').val(detail);
        modal.find('#edit_saran_penyakit').val(saran);
    });
});
</script>
</body>
</html>
