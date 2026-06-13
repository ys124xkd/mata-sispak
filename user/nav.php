<?php
    // Get the current page from the URL parameters, default to 'home' if not set
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<style>
    @media screen and (max-width: 600px) {
        .copyright {
            font-size: 8vw;
        }
    }

    /* Style untuk icon logout */
    .logout-btn {
        display: inline-block;
        padding: 5px;
        border-radius: 5px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    /* Efek saat di-hover */
    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Efek saat di-klik */
    .logout-btn:active {
        transform: translateY(2px);
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Navbar Styles */
    .navbar {
        background-color: #f8f9fa;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-nav .nav-link {
        color: #555;
        font-weight: 500;   
        position: relative;
        transition: color 0.3s ease;
    }

    /* Garis Penanda untuk Link Aktif */
    .navbar-nav .nav-link:after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: #007bff;
        transition: width 0.3s ease;
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
    }

    /* Hover Effect untuk Links */
    .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    /* Aktif Link Style */
    .navbar-nav .nav-link.active:after {
        width: 100%;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" style="margin-left: 30px;">
            <img src="../assets/logo.png" style="width: 150px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 30px;">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'home' ? 'active' : ''; ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'Di' ? 'active' : ''; ?>" href="index.php?page=Di">Diagnosa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'Ri' ? 'active' : ''; ?>" href="index.php?page=Ri">Riwayat</a>
                </li>
            </ul>
            <form class="d-flex ms-auto" action="logout.php" method="POST">
                <button class="btn btn-outline-danger my-2 my-sm-0 logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>