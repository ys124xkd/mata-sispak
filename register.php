<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/c424bbb0-a0e6-4a95-b422-56f707c6e172/dg7c28l-81258807-0f9b-4d7a-9185-738d000d03bc.jpg/v1/fill/w_1024,h_683,q_75,strp/nature_background_image__cartoon_style_by_gabimedia_dg7c28l-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2M0MjRiYmIwLWEwZTYtNGE5NS1iNDIyLTU2ZjcwN2M2ZTE3MlwvZGc3YzI4bC04MTI1ODgwNy0wZjliLTRkN2EtOTE4NS03MzhkMDAwZDAzYmMuanBnIiwiaGVpZ2h0IjoiPD02ODMiLCJ3aWR0aCI6Ijw9MTAyNCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS53YXRlcm1hcmsiXSwid21rIjp7InBhdGgiOiJcL3dtXC9jNDI0YmJiMC1hMGU2LTRhOTUtYjQyMi01NmY3MDdjNmUxNzJcL2dhYmltZWRpYS00LnBuZyIsIm9wYWNpdHkiOjk1LCJwcm9wb3J0aW9ucyI6MC40NSwiZ3Jhdml0eSI6ImNlbnRlciJ9fQ.kf5hpIk-dl_s0smKLMpeG5X0KWNKxELM8VHQRpAKqgk");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
            text-align: center; /* Center text inside the container */
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 40px; /* Add padding for icons */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            margin-top: 20px;
            color: green;
        }

        .error-message {
            margin-top: 20px;
            color: red;
        }

        .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px; /* Adjust icon size */
            height: 24px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            text-align: center; /* Center the back link */
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrasi</h2>
        <?php
        include 'config.php';

        // Jika form disubmit, masukkan nilai ke dalam database
        if (isset($_REQUEST['username'])) {
            // Menghapus backslashes
            $username = stripslashes($_REQUEST['username']);
            // Menghindari karakter khusus dalam string
            $username = mysqli_real_escape_string($conn, $username); 
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);
            $level = 'user'; // Set level secara langsung ke 'user'
            $nama = stripslashes($_REQUEST['nama']);
            $nama = mysqli_real_escape_string($conn, $nama);
            
            // Query untuk memasukkan data
            $query = "INSERT into `user` (nama, username, password, level) 
                      VALUES ('$nama', '$username', '$password', '$level')";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                // Redirect to login page on success
                header("Location: login.php");
                exit(); // Ensure no further code is executed
            } else {
                echo "<div class='error-message'>
                      <h3>Registrasi Gagal: " . mysqli_error($conn) . "</h3></div>";
            }
        } else {
        ?>
        <form name="registration" action="" method="post">
            <div class="form-group">
                <img src="assets/id-card.png" alt="Nama" class="icon">
                <input type="text" id="nama" name="nama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <img src="assets/profile.png" alt="Username" class="icon">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <img src="assets/lock.png" alt="Password" class="icon">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <img src="assets/hide.png" alt="Toggle Password" class="toggle-password" id="togglePassword" onclick="togglePasswordVisibility()">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Register" class="submit-button">
            </div>
        </form>
        <a href="login.php" class="back-link">Back to Login</a> <!-- Back to Login link -->
        <?php } ?>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.src = 'assets/view.png'; // Replace with your "view" icon
            } else {
                passwordInput.type = 'password';
                toggleIcon.src = 'assets/hide.png'; // Replace with your "hide" icon
            }
        }
    </script>
</body>
</html>
