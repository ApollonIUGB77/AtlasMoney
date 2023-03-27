<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}

$sname = "localhost";
$usname = "root";
$password = "";
$db_name = "atlasmoney";

$conn = new mysqli($sname, $usname, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['reset'])) {

  $id = $_SESSION['id'];
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  $sql = "SELECT password FROM atlasin WHERE id = $id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $stored_password = $row['password'];

  if ($new_password !== $confirm_password) {
    $_SESSION['error'] = "Passwords do not match";
    header('Location: resetPassword.php');
    exit();
  }

  if (strlen($new_password) < 4) {
    $_SESSION['error'] = "Password must be at least 4 characters long";
    header('Location: resetPassword.php');
    exit();
  }

  if ($stored_password !== $old_password) {
    $_SESSION['error'] = "Old password is incorrect";
    header('Location: resetPassword.php');
    exit();
  }

  $sql = "UPDATE atlasin SET password = '$new_password' WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Password reset successfully. Redirecting to home page...";
    header("Refresh: 3; url=atlasmoney.php");
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
    /* center the form on the screen */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f2f2f2;
    }
    
    /* style the form container */
    .form-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    
    /* style the form inputs */
    form label {
      font-size: 18px;
    }
    
    form input[type="password"] {
      font-size: 16px;
      padding: 10px;
      border-radius: 5px;
      border: none;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
      width: 100%;
      max-width: 400px;
    }
    
    form input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      font-size: 18px;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    form input[type="submit"]:hover {
      background-color: #0ce631;
    }
    input[type="button"] {
			background-color: #333;
			color: #fff;
			border: none;
			padding: 10px 20px;
			font-size: 18px;
			font-weight: bold;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type="button"]:hover {
			background-color: #0ce631;
		}
    
    a {
      font-size: 16px;
      margin-top: 10px;
      color: #4CAF50;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    a:hover {
      color: #3e8e41;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Reset Password</h1>
    <?php if (isset($_SESSION['error'])): ?>
      <div style="color: red;"><?php echo $_SESSION['error']; ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
  <div style="color: green;"><?php echo $_SESSION['success']; ?></div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

    <form method="post">
  <label for="old_password">Old Password:</label>
  <input type="password" name="old_password" maxlength="4" required >  <br>
  <label for="new_password">New Password:</label>
  <input type="password" name="new_password" maxlength="4" required > <br>
  <label for="confirm_password">Confirm Password:</label>
  <input type="password" name="confirm_password" maxlength="4" required>
  <input type="submit" name="reset" value="Reset Password">
  <input type="button" value="Back" onclick="window.location.href='updateProfile.php'">
</form>

  </div>
</body>
</html>
    