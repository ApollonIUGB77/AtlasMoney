<?php
session_start();
include "db_connect.php";
if (isset($_POST['phone']) && isset($_POST['password'])) 
    {
        function validate ($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
    $phone = validate($_POST['phone']);
    $pass = validate($_POST['password']);
    if ( empty($phone))
    {
        header("Location: index.php?error=Phone number is required");
        exit();
    }
    else if (empty ($pass))
    {
        header("Location: index.php?error=Password is required");
        exit();
    }
   

    $sql ="SELECT * FROM atlasin  WHERE phone ='$phone' AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)===1)
    {
        $row=mysqli_fetch_assoc($result);
        if($row['phone']===$phone && $row['password']===$pass)
        {
            echo"Logged In!";
            $_SESSION['phone']=$row['phone'];
            $_SESSION['name']=$row['name'];
            $_SESSION['id']= $row['id'];
            header("Location: atlasmoney.php");
            exit();
        }
        else 
        {
            $_SESSION['message']="Incorrect Phone Number or Password."; 
            header("Location: index.php?error=Incorrect Phone Number or Password");
            echo '<h3>Invalid Phone Number or password</h3>';
            exit();
        }
    }
    else {
    
			header("Location: index.php?error=Incorrect Phone Number or password");
	        exit();
		
	}
}    
        else
        {
            
            header("Location: index.php");
            exit();
        }
    
       