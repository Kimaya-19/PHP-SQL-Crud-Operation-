<?php
session_start();
include "db_conn.php";

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Check if user is logged in and if they are the admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
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
            opacity: 0.7;
            z-index: -1;
        }

        .container {
            color: #ffffff;
        }

        .table thead th {
            color: #ffffff;
        }

        .table tbody td {
            background-color: rgba(0, 0, 0, 0.5);
            color: #ffffff;
        }

        .icon-red {
            color: red;
        }

        .icon-yellow {
            color: #f5b7b1;
        }

        .profile-info {
            display: flex;
            font-size: larger;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            font-weight: 550;
        }

        .user-info {
            color: black;
            margin-right: 15px;
            display: flex;
            text-align: center;
        }

        .profile-icon {
            width: 30px; 
            height: 30px; 
            border-radius: 50%; 
            margin-right: 5px;
            display: flex;
            align-items: center;
        }

        .navbar {
            display: flex;
            justify-content: center;
        }

        .navbar .btn {
            position: absolute;
            right: 10px;
        }
    </style>

    <title>Hey, Let's Get Registered!</title>
</head>

<body>
<nav class="navbar navbar-light">
    <div class="profile-info">
        <?php if (isset($_SESSION['user'])): ?>
            <img src="user.png" alt="Profile Icon" class="profile-icon"> <!-- Replace with actual image path -->
            <span class="user-info"><?php echo $_SESSION['user']['email']; ?></span>
            <a href="?logout=true" class="btn btn-danger">Logout</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <?php
    if (isset($_SESSION['success_msg'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $_SESSION['success_msg'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['success_msg']); 
    }

    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    
    <a href="add-new.php" class="btn btn-dark mb-3">Add New</a>
    
    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `crud`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["first_name"] . "</td>
                    <td>" . $row["last_name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["gender"] . "</td>
                    <td>
                        <a href='edit.php?id=" . $row["id"] . "' class='link-dark'><i class='fa-solid fa-pen-to-square icon-yellow fs-5 me-3'></i></a>
                        <a href='delete.php?id=" . $row["id"] . "' class='link-dark' onclick='return confirmDelete()'><i class='fa-solid fa-trash icon-red fs-5'></i></a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this data?");
    }
</script>
</body>

</html>
