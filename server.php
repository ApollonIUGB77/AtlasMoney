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
if (mysqli_num_rows($result)> 0)
{
    $row = mysqli_fetch_assoc($result);
    if($email==$row['email'])
    {
            echo "email already exists";
    }
    if($phone==$row['phone'])
    {
        echo "phone  already exists";
    }

  
}else{
	$reg= "INSERT INTO atlasin(name, email, phone, password) VALUES ('$name','$email','$phone','$Pass');";
	mysqli_query($con, $reg);
	$_SESSION['name'] = $name;
	header("Location: login.php");
		        exit();

}

 ?>