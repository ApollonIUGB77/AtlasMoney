<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];
$name = "";
$email = "";
$phone = "";

// retrieve user information
// retrieve user information
$sql = "SELECT * FROM atlasin WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
}

// check if email or phone is already in use
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = mysqli_real_escape_string($conn, $_POST['name']);
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // check if new email or phone is already in use
    $sql = "SELECT * FROM atlasin WHERE (email='$new_email' OR phone='$new_phone') AND id!='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $message = "Email or phone already use.";
    } else {
        // update user information
        $sql = "UPDATE atlasin SET Name='$new_name', email='$new_email', phone='$new_phone' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['name'] = $new_name;
            $message = "Profile updated successfully.";
            echo "<script>setTimeout(function(){ window.location.href='atlasmoney.php'; }, 3000);</script>";
        } else {
            $message = "Error updating record: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        header {
			background-color: #333;
			color: #fff;
			padding: 20px;
			text-align: center;
			margin-bottom: 30px;
		}
        form {
            background-color: #fff;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
			text-transform: uppercase;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: #0077b5;
            font-size: 16px;
        }
        a:hover {
            color: #004471;
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
    </style>
</head>
<body>
    <header>
    <h2>Profile</h2>
    <?php if (!empty($message)) { ?>
    <p><?php echo $message; ?></p>
<?php } ?>

    </header>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name"> <b> Old Name :  <?php echo $name; ?> </b> <br>New Name : </label>
        <input type="text" id="name" name="name" value="">

        <label for="email"> <b> Old Email : <?php echo $email; ?></b><br>New Email : </label>
        <input type="text" id="email" name="email" value="">

        <label for="phone"><b> Old Phone: <?php echo $phone; ?></b><br>New Phone : </label>
        <input type="text" id="phone" name="phone" value="" maxlength="10">

        <input type="submit" name="submit" value="Update"> <br> <br>
        <input type="button" value="Back" onclick="window.location.href='atlasmoney.php'">

        <p><a href="delete.php">Delete account</a></p>
        <p><a href="ResetPassword.php">Change password</a></p>
      
    </form>
</body>
</html>