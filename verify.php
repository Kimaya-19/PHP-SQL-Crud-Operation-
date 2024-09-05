<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "db_conn.php";
session_start();

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']); // Prevent SQL injection
    $sql = "SELECT * FROM `crud` WHERE `token`='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $sql_update = "UPDATE `crud` SET `is_verified`=1, `token`=NULL WHERE `token`='$token'";
        if (mysqli_query($conn, $sql_update)) {
            // Assuming 'user' role and setting session data for the user
            $_SESSION['user'] = [
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'gender' => $row['gender'],
                'role' => 'user'
            ];
            $_SESSION['message'] = "Email verified successfully.";
            header("Location: user_dashboard.php"); // Redirect to the user dashboard
            exit();
        } else {
            echo "Failed to update verification status.";
        }
    } else {
        echo "Invalid token!";
    }
} else {
    echo "No token provided!";
}
?>
