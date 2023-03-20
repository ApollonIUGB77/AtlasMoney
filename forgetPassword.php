<?php
session_start();

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
  
    if (strlen($new_password) < 8) {
      $_SESSION['error'] = "Password must be at least 8 characters long";
      header('Location: resetPassword.php');
      exit();
    }
  
    $sql = "UPDATE atlasin SET password = '$new_password' WHERE email = '$email'";
  
    if ($conn->query($sql) === TRUE) {
      $_SESSION['success'] = "Password reset successfully";
      header('Location: login.php');
      exit();
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
    }

    h1 {
      margin-top: 0;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    label, input {
      margin: 10px;
    }

    input[type=submit] {
      margin-top: 20px;
    }

    .error {
      color: red;
      margin-top: 10px;
    }

    .success {
      color: green;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Reset Password</h1>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="error"><?php echo $_SESSION['error']; ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
      <div class="success"><?php echo $_SESSION['success']; ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <form method="post">
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" required>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" required>
      <input type="submit" name="reset" value="Reset Password">
      <input type="button" value="Cancel" onclick="window.location.href='index.php'">
    </form>
  </div>
</body>
</html>

