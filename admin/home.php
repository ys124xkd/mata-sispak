<?php
include '../config.php'; // Include your database connection

// Function to count records in a given table
function getCount($table) {
    global $conn; // Use the global database connection
    $query = "SELECT COUNT(*) as count FROM $table";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['count'];
    } else {
        return 0; // Return 0 if the query fails
    }
}

// Get counts from various tables
$userCount = getCount('user');
$gejalaCount = getCount('gejala');
$penyakitCount = getCount('penyakit');
$rullCount = getCount('aturan');
$riwayatCount = getCount('riwayat');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            padding: 20px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-content {
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
            width: 100%;
            justify-content: center;
        }
        .icon {
            font-size: 1.5em;
        }
        .card h3 {
            margin: 0;
            font-size: 1.2em;
        }
        .card p {
            margin: 10px 0;
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Dashboard</h2>
    <div class="card-container">
        <div class="card">
            <div class="card-content">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h3>Jumlah Pengguna</h3>
            </div>
            <p><?php echo $userCount; ?></p>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="icon"><i class="fas fa-stethoscope"></i></div>
                <h3>Jumlah Gejala</h3>
            </div>
            <p><?php echo $gejalaCount; ?></p>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="icon"><i class="fas fa-heartbeat"></i></div>
                <h3>Jumlah Penyakit</h3>
            </div>
            <p><?php echo $penyakitCount; ?></p>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="icon"><i class="fas fa-cogs"></i></div>
                <h3>Rull Base</h3>
            </div>
            <p><?php echo $rullCount; ?></p>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="icon"><i class="fas fa-history"></i></div>
                <h3>Riwayat</h3>
            </div>
            <p><?php echo $riwayatCount; ?></p>
        </div>
    </div>
</div>

</body>
</html>
