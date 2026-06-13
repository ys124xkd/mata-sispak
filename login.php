<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .input-container {
            position: relative;
            margin: 10px 0;
        }
        .input-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 10px 10px 40px; /* Adjust padding for icon */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 12px; /* Increased padding for better appearance */
            background-color: #5cb85c; /* Login button color */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px; /* Slightly increased border radius */
            font-size: 16px; /* Increased font size for better readability */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
            margin-top: 10px; /* Added margin for spacing */
        }
        input[type="submit"]:hover {
            background-color: #4cae4c; /* Darker shade on hover */
        }
        input[type="reset"] {
            background-color: #d9534f; /* Reset button color */
        }
        input[type="reset"]:hover {
            background-color: #c9302c; /* Darker shade on hover for reset button */
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .password-container {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .toggle-password {
            cursor: pointer;
            width: 20px;
            margin-left: -30px;
        }

        /* Responsive styles */
        @media (max-width: 480px) {
            .container {
                margin: 20px;
                padding: 15px;
            }
            h2 {
                font-size: 1.5em;
            }
            input[type="text"],
            input[type="password"],
            input[type="submit"],
            input[type="reset"] {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sign In</h2>

    <?php 
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == 'wrong_password') {
            echo "<p class='error-message'>Password yang Anda masukkan salah!</p>";
        }
    }
    ?>

    <form action="cek_login.php" method="post" name="login">
        <div class="input-container">
            <img class="input-icon" src="assets/profile.png" alt="User Icon" />
            <input type="text" name="username" placeholder="Username" required />
        </div>
        <div class="input-container">
            <img class="input-icon" src="assets/lock.png" alt="Password Icon" />
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required />
                <img class="toggle-password" src="assets/hide.png" id="toggleIcon" onclick="togglePassword()" alt="Toggle Password" />
            </div>
        </div>
        <input name="submit" type="submit" value="Login" />
        <input name="reset" type="reset" value="Reset" />
    </form>
    <div class="register-link">
        Not registered? <a href='register.php'>Register Here</a>
    </div>
</div>

<script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.src = "assets/view.png"; // Change to show password icon
    } else {
        passwordField.type = "password";
        toggleIcon.src = "assets/hide.png"; // Change to hide password icon
    }
}
</script>

</body>
</html>
