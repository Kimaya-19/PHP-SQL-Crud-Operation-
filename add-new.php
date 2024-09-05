<?php
session_start();
include "db_conn.php";
//ADD THE CODE GIVEN IN README FOR OTP VERIFICATION
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f4f4f4;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/dashboard.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(0.9px);
            z-index: -1;
        }

        .custom-form {
            background-color: rgba(40, 40, 40, 0.8);
            padding: 26px;
            border-radius: 10px;
            width: 50vw;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            color: #ffffff;
        }

        .custom-form .form-label, .custom-form .form-input-label {
            color: #ffffff;
        }

        .custom-form .form-control {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            border-radius: 5px;
        }

        .custom-form .form-control::placeholder {
            color: #ffffff !important;
        }

        .custom-form .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3) !important;
            border-color: #ffffff !important;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5) !important;
        }

        .custom-form .btn {
            margin-top: 10px;
        }

        .text-muted.text {
            color: #000000 !important;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 72%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .register-container a {
            color: #ffcc00; 
            text-decoration: none;
            font-weight: bold;
        }

        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Register Here</title>
</head>
<body>
    <div class="container text-center">
        <div class="mb-4">
            <h3>Register</h3>
            <p class="text-muted text">Complete the form below to add a new user</p>
        </div>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <div class="d-flex justify-content-center">
            <form action="" method="post" class="custom-form">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Kimaya" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Shimpi" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                </div>

                <div class="form-group mb-3">
                    <label>Gender:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="male" value="male" required>
                    <label for="male" class="form-input-label">Male</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female" required>
                    <label for="female" class="form-input-label">Female</label>
                </div>

                <div class="mb-3 password-container">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                </div>

                <button type="submit" name="submit" class="btn btn-warning btn-block">Register</button>
            </form>
        </div>
        <div class="mt-3 register-container">
            <p>Already registered? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <script>
    function togglePasswordVisibility() {
        const passwordInput = document.querySelector('input[name="password"]');
        const toggleIcon = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.innerHTML = '🙈'; // Change icon to indicate visibility
        } else {
            passwordInput.type = 'password';
            toggleIcon.innerHTML = '👁️'; // Change icon to indicate invisibility
        }
    }
    </script>

</body>
</html>
