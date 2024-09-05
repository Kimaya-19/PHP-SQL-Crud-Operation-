<?php
session_start();
include "db_conn.php"; 

// Check if email is set in the session
if (!isset($_SESSION['email'])) {
    $_SESSION['message'] = "Please register first!";
    header("Location: add-new.php"); 
    exit();
}

// Set message for OTP sent (if this is the first visit to this page)
if (!isset($_SESSION['otp_sent'])) {
    $_SESSION['message'] = "OTP has been sent to your email.";
    $_SESSION['otp_sent'] = true; 
}

if (isset($_POST['verify'])) {
    $email = $_SESSION['email']; 
    $input_otp = $_POST['otp'];

    // Check the OTP in the database
    $sql = "SELECT * FROM `crud` WHERE `email`='$email' AND `otp`='$input_otp' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Update user as verified
        $sql_update = "UPDATE `crud` SET `is_verified`=1, `otp`=NULL WHERE `email`='$email'";
        mysqli_query($conn, $sql_update);

        // Fetch user details
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = [
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'gender' => $user['gender'],
            'role' => 'user', 
        ];

        $_SESSION['message'] = "OTP verified successfully! You can now log in.";
        header("Location: user_dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid OTP. Please try again.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>OTP Verification</title>
    <style>
        body {
            background-image: url('assets/dashboard.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: white;
            margin: 0; 
        }
        .container {
            background: rgba(0, 0, 0, 0.7); 
            padding: 30px; 
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            max-width: 40vw; 
            height: auto; 
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h3>OTP Verification</h3>
        <p>Please enter the OTP sent to your email address.</p>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <form action="" method="post" class="custom-form">
            <div class="mb-3">
                <input type="text" class="form-control" name="otp" placeholder="Enter OTP" required>
            </div>
            <button type="submit" class="btn btn-success" name="verify">Verify OTP</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
