<?php

$sname = "localhost";
$usname = "root";
$password = "";
$db_name = "atlasmoney";

$conn = new mysqli($sname, $usname, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['reset'])) {
  $email = $_POST['email'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if ($new_password !== $confirm_password) {
    $_SESSION['error'] = "Passwords do not match";
    header('Location: resetPassword.php');
    exit();
  }

  if (strlen($new_password) < 3) {
    $_SESSION['error'] = "Password must be 4 characters long";
    header('Location: resetPassword.php');
    exit();
  }

  $sql = "UPDATE atlasin SET password = '$new_password' WHERE email = '$email'";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Password reset successfully";
    echo '<div class="success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
    echo '<meta http-equiv="refresh" content="3;url=login.php">';
  } else {
    $_SESSION['error'] = "Error updating password: " . $conn->error;
    header('Location: resetPassword.php');
    exit();
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Reset Password</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    .container {
      margin: 0 auto;
      width: 400px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      text-align: center;
      position: relative;
    }

    h1 {
      margin-top: 0;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    label,
    input {
      margin: 10px;
    }

    input[type=submit] {
      margin-top: 20px;
    }

    .error,
    .success {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      margin-top: 10px;
    }

    .error {
      color: red;
    }

    .success {
      color: green;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Reset Password</h1>
    <form method="post">
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" maxlength="4" required>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" maxlength="4" required>
      <input type="submit" name="reset" value="Reset Password">
      <input type="button" value="Cancel" onclick="window.location.href='index.php'">
      <?php 
      if (isset($_SESSION['success'])) {
        echo '<div class="success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
      }
      
      if (isset($_SESSION['error'])) {
        echo '<div class="error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
      }
      
      ?>
    </form>
  </div>
</body>

</html>
