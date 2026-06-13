<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../assets/logo.ico">
    <?php include('bootstrap.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Flexbox layout untuk footer di bawah */
        html, body {
            height: 100%; /* Memastikan body dan html memiliki tinggi penuh */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Minimal tinggi 100vh agar footer tetap di bawah */
        }

        main {
            flex: 1; /* Mengambil ruang kosong yang tersedia */
            padding: 20px;
        }

        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.1);
            margin-top: auto; /* Pastikan footer tetap di bawah */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <?php include "nav.php"; ?>
    </nav>

    <!-- Konten Utama -->
    <section>
        <?php
        $content;
        $mod = "";
        if (isset($_GET['page'])) $mod = $_GET['page'];
        switch ($mod) {
            case "tb": $content = "tambah_penyakit.php"; break;
            case "tg": $content = "tambah_gejala.php"; break;
            case "ta": $content = "tambah_aturan.php"; break;
            default: $content = "home.php";
        }
        include($content);
        ?>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
