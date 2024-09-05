<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];

  $sql = "UPDATE `crud` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`gender`='$gender' WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Record updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

$user_sql = "SELECT * FROM `crud` WHERE id = $id";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Edit User</title>

  <style>
    body {
      background: url('assets/register.jpg') no-repeat center center fixed; /* Adjust the path as necessary */
      background-size: cover;
      color: #ffffff; 
    }

    .navbar {
      background-color: rgba(255, 255, 255, 0.1); 
    }

    h3 {
      color: #ffffff; 
    }

    .form-label {
      color: #ffffff;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.5); 
      color: #ffffff;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.3);
      border-color: #00ff55; 
    }

    .container {
      background-color: rgba(0, 0, 0, 0.7); 
      border-radius: 10px; 
      padding: 20px; 
      width: 50vw; 
      min-width: 300px;
      margin: auto;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
 Update Data
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User</h3>
      <p class="text-muted">Complete the form below to edit user information</p>
    </div>

    <form action="" method="post">
      <div class="row mb-3">
        <div class="col">
          <label class="form-label">First Name:</label>
          <input type="text" class="form-control" name="first_name" value="<?php echo $user["first_name"] ?>" required>
        </div>

        <div class="col">
          <label class="form-label">Last Name:</label>
          <input type="text" class="form-control" name="last_name" value="<?php echo $user["last_name"] ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo $user["email"] ?>" required>
      </div>

      <div class="form-group mb-3">
        <label>Gender:</label>
        &nbsp;
        <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php if ($user['gender'] == 'male') echo 'checked'; ?> required>
        <label for="male" class="form-input-label">Male</label>
        &nbsp;
        <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php if ($user['gender'] == 'female') echo 'checked'; ?> required>
        <label for="female" class="form-input-label">Female</label>
      </div>

      <div>
        <button type="submit" class="btn btn-warning" name="submit">Update</button>
        <a href="index.php" class="btn btn-danger">Cancel</a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
