<?php
session_start();
include "db_conn.php"; // Include your database connection file

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    header("Location: user_dashboard.php");
    exit();
}

// Initialize error message
$error_msg = "";

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Escape user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query to fetch user from the database
    $sql = "SELECT * FROM `crud` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 1) {
                // Regenerate session ID
                session_regenerate_id(true);
                
                // Set session variables for the user
                $_SESSION['user'] = [
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'gender' => $user['gender'],
                    'role' => 'user'
                ];
                header("Location: user_dashboard.php"); // Redirect to user dashboard
                exit();
            } else {
                $error_msg = "Please verify your email address.";
            }
        } else {
            $error_msg = "Invalid email or password.";
        }
    } else {
        $error_msg = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background Image Style */
        .container {
            color: #ffffff;
        }

        .form-label, .form-control::placeholder {
            color: #ffffff !important;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            border-radius: 5px;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.4) !important;
            border-color: #ffffff !important;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5) !important;
        }

        .register-container {
            margin-top: 20px;
            text-align: center;
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
    <title>Normal User Login</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
    </nav>

    <div class="container">
        <div class="text-center mb-3">
            <h3>Login</h3>
            <p style="color:black;padding:30px 20px">Enter your credentials to access the Dashboard</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:40vw; min-width:300px;">
                <?php if (!empty($error_msg)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error_msg) ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary" name="submit">Login</button>
                </div>
            </form>
        </div>

        <div class="register-container">
            <p>Not registered yet? <a href="add-new.php">Register here</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>