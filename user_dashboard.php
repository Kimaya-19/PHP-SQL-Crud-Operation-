<?php
session_start();
// Check if user is logged in and if they are a normal user
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit();
    
}
echo "Redirecting to: normal_login.php"; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/dashboard.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(1.2px);
            z-index: -1;
        }

        .container {
            position: relative;
            z-index: 1;
            margin-top: 50px;
        }
        .welcome-msg {
            margin-top: 20px;
            color: #fff;
            text-align: center;
        }
        .user-details {
            margin-top: 30px;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.7); /* Adjusted transparency */
            padding: 20px;
            border-radius: 10px;
        }
        .logout-btn {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .logout-btn a {
            text-decoration: none;
        }
        .custom-btn {
            color: #000;
            background-color: #f4f4f4;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.9s ease;
        }
        .custom-btn:hover {
            background-color: black;
            color: white;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <?php
        // Display the success message if it exists
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']); // Clear the message after displaying it
        }
        ?>
        <div class="welcome-msg">
            <h1>Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</h1>
            <p>You have successfully registered.</p>
        </div>

        <div class="user-details">
            <h3>Your Details:</h3>
            <p><strong>First Name:</strong> <?php echo $_SESSION['user']['first_name']; ?></p>
            <p><strong>Last Name:</strong> <?php echo isset($_SESSION['user']['last_name']) ? $_SESSION['user']['last_name'] : 'N/A'; ?></p>
            <p><strong>Email:</strong> <?php echo $_SESSION['user']['email']; ?></p>
            <p><strong>Gender:</strong> <?php echo isset($_SESSION['user']['gender']) ? ucfirst($_SESSION['user']['gender']) : 'N/A'; ?></p>
        </div>

        <div class="logout-btn">
    <a href="logout.php" class="btn custom-btn">Logout</a>
  <!--  <a href="login.php" class="btn custom-btn">Login as Normal User</a>--> <!-- New login button -->
</div>

    </div>
</body>
</html>
