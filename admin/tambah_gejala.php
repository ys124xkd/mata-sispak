<?php
include '../config.php';

// Initialize the data array
$data = [];

// Fetch existing records from the gejala table
$result = $conn->query("SELECT kode_gejala, keterangan_gejala FROM gejala");

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
            $kode_gejala = $_POST['kode_gejala'];

            $delete_sql = $conn->prepare("DELETE FROM gejala WHERE kode_gejala = ?");
            $delete_sql->bind_param("s", $kode_gejala);

            if ($delete_sql->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }
            exit;

        } elseif ($_POST['action'] === 'update') {
            // Handle update request
            $kode_gejala = $_POST['kode_gejala'];
            $keterangan_gejala = $_POST['keterangan_gejala'];

            // Prepare and execute update statement
            $update_sql = $conn->prepare("UPDATE gejala SET keterangan_gejala = ? WHERE kode_gejala = ?");
            $update_sql->bind_param("ss", $keterangan_gejala, $kode_gejala);

            if ($update_sql->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }
            exit;
        }
    }

    // Add a new gejala
    $result = $conn->query("SELECT kode_gejala FROM gejala ORDER BY kode_gejala DESC LIMIT 1");
    $last_code = $result->fetch_assoc();

    $last_number = $last_code ? (int)substr($last_code['kode_gejala'], 1) : 0; // Default to 0 if no records exist
    $new_code = 'G' . str_pad($last_number + 1, 2, '0', STR_PAD_LEFT); // Create new code (G00, G01, etc.)

    $keterangan_gejala = $_POST['keterangan_gejala'];

    // Prepare and execute insert statement
    $sql = $conn->prepare("INSERT INTO gejala (kode_gejala, keterangan_gejala) VALUES (?, ?)");
    $sql->bind_param("ss", $new_code, $keterangan_gejala);

    if ($sql->execute()) {
        echo json_encode(['success' => true, 'new_code' => $new_code, 'keterangan_gejala' => $keterangan_gejala]);
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
    <title>Data Gejala</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">Data Gejala</h4>
                        <button id="add-btn" class="btn btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Gejala</th>
                                    <th>Keterangan Gejala</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['kode_gejala']); ?></td>
                                            <td><?php echo htmlspecialchars($row['keterangan_gejala']); ?></td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#editModal" 
                                                        data-kode="<?php echo htmlspecialchars($row['kode_gejala']); ?>" 
                                                        data-keterangan="<?php echo htmlspecialchars($row['keterangan_gejala']); ?>">Edit</button>
                                                <button class="btn btn-danger delete-btn" 
                                                        data-kode="<?php echo htmlspecialchars($row['kode_gejala']); ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
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
                <h5 class="modal-title" id="addModalLabel">Tambah Gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-form" class="ajax-form" method="POST">
                    <div class="form-group">
                        <label for="keterangan_gejala">Keterangan Gejala</label>
                        <input type="text" class="form-control" id="keterangan_gejala" name="keterangan_gejala" required>
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
                <h5 class="modal-title" id="editModalLabel">Edit Gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form" class="ajax-form" method="POST">
                    <input type="hidden" name="kode_gejala" id="edit_kode_gejala" value="">
                    <div class="form-group">
                        <label for="edit_keterangan_gejala">Keterangan Gejala</label>
                        <input type="text" class="form-control" id="edit_keterangan_gejala" name="keterangan_gejala" required>
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
            url: 'tambah_gejala.php',
            type: 'POST',
            data: form.serialize() + '&action=' + action,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(action === 'add' ? 'Data berhasil ditambahkan!' : 'Data berhasil diupdate!');
                    location.reload(); // Refresh the page
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error occurred while processing your request.');
            }
        });
    });

    // Populate edit modal with data
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var kode = button.data('kode');
        var keterangan = button.data('keterangan');

        var modal = $(this);
        modal.find('#edit_kode_gejala').val(kode);
        modal.find('#edit_keterangan_gejala').val(keterangan);
    });

    // Handle delete action with event delegation
    $('#table tbody').on('click', '.delete-btn', function() {
        var kode_gejala = $(this).data('kode');
        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: 'tambah_gejala.php',
                type: 'POST',
                data: { action: 'delete', kode_gejala: kode_gejala },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil dihapus!'); // Show delete success message
                        // Remove the row from the DataTable
                        table.row($(this).parents('tr')).remove().draw();
                    } else {
                        alert(response.error);
                    }
                }.bind(this), // Bind the context so `this` refers to the clicked button
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
