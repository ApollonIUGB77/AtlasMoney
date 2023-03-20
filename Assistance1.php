<?php
	session_start();
	$id = $_SESSION["id"]; // assuming you have stored user ID in the session
	$date = $_POST["date"];
	$issue = $_POST["issue"];
	$expectation = $_POST["expectation"];

	$errors = array();
	if (empty($date)) {
	  $errors[] = "Date is required";
	}
	if (empty($issue)) {
	  $errors[] = "Issue description is required";
	}
	if (empty($expectation)) {
	  $errors[] = "Expectation is required";
	}

	// database connection 

	$conn = new mysqli('localhost','root','','atlasmoney');
	if($conn-> connect_error){
	    die('Connection failed : '.$conn-> connect_error );
	}else{
	    // retrieve name and phone from the database using the user ID
	    $query = "SELECT name, phone FROM atlasin WHERE id = $id";
	    $result = mysqli_query($conn, $query);
	    $row = mysqli_fetch_assoc($result);
	    $name = $row["name"];
	    $phone = $row["phone"];

	    // insert the assistance request into the database
	    $reg = "INSERT INTO assistance(name,phone,date,issue,expectation) VALUES ('$name','$phone','$date','$issue','$expectation')";
	    mysqli_query($conn, $reg);
	    header("Location: RequestSend.html");
	    exit();
	}
?>
