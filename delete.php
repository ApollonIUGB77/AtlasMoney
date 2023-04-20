<?php

// Check if user is logged in
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}

// Connect to database
$sname = "localhost";
$usname = "root";
$password = "";
$db_name = "atlasmoney";

$conn = new mysqli($sname, $usname, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['delete'])) {

  // Get user ID from session
  $id = $_SESSION['id'];

  // Delete user account from database
  $sql = "DELETE FROM atlasin WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    // Account deleted successfully
    session_destroy();
    header('Location: index.php');
    exit();
  } else {
    // Error deleting account
    echo "Error deleting account: " . $conn->error;
  }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Delete Account</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
			background-color: #333;
			color: #fff;
			padding: 20px;
			text-align: center;
			margin-bottom: 30px;
		}
		h1 {
			margin: 0;
			font-size: 36px;
			font-weight: bold;
			text-transform: uppercase;
		}
    p {
      margin: 10px 0;
      text-align: center;
      color:red ;
      font-size: larger;
      font-family: Arial, Helvetica, sans-serif;
    }
    form {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

    input[type="submit"], input[type="button"] {
      background-color: gray;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 90px;
    }
    input[type="button"] {
      background-color: gray;
      margin-left: 1000px;
    }
    input[type="submit"]:hover {
			background-color: red;
    }
    input[type="button"]:hover {
			background-color: #0ce631;
    }
  </style>
</head>
<body>
  <header>
  <h1>Delete Account</h1>
  </header>
  <p>Are you sure you want to delete your account? This action cannot be undone.</p>
  <form method="post">
    <input type="submit" name="delete" value="Delete Account">
    <input type="button" value="Cancel" onclick="window.location.href='atlasmoney.php'">
  </form>
</body>
</html>
