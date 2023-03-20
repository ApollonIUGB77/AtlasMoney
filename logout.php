
<?php
if (!isset($_SESSION)) { 
    session_start(); 
}
$_SESSION = array(); 
session_destroy(); 

ob_start(); // start output buffering
header("Location: login.php"); 
ob_end_flush(); // end output buffering and send output to the browser

exit();
?>
