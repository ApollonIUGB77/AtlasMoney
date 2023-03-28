<?php 
session_start();

$con = mysqli_connect('localhost', 'root', '', 'atlasmoney');
mysqli_select_db($con, 'atlasmoney');
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$Pass=$_POST['password'];

$s= "SELECT * FROM atlasin where email='$email' OR phone = '$phone';";
$result= mysqli_query($con, $s);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($email == $row['email']) {
        $error = "Email already exists";
    }
    if ($phone == $row['phone']) {
        $error = "phone already exists";
    }
    if (strlen($Pass) < 8) {
        $error = "password must be at least 4 digit";
         exit();
    }
    
    // Verify if the two passwords match
    if ($Pass != $confirm_Pass) {
        $error = "PASSWORD mismatch";
                exit();
    }
    
    
    // Pass the error message as a URL parameter
    header("Location: register.php?error=" . urlencode($error));
    exit();
} else {
    $reg = "INSERT INTO atlasin(name, email, phone, password) VALUES ('$name','$email','$phone','$Pass');";
    mysqli_query($con, $reg);
    
    // Authenticate user
    $s = "SELECT * FROM atlasin WHERE phone = '$phone' AND password = '$Pass';";
    $result = mysqli_query($con, $s);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        header("Location: atlasmoney.php");
        exit();
    } else {
        header("Location: login.php?error=Invalid phone or password");
        exit();
    }
}
?>
