<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];
$name = "";
$error = "";
$admin_id=1;
// retrieve user information
$sql = "SELECT * FROM atlasin WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    // check if recipient phone number exists
    $sql = "SELECT * FROM atlasin WHERE phone='$phone'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $recipient_id = $row['id'];

        // check if sender has enough balance
        $sql = "SELECT balance FROM atlasin WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $balance = $row['balance'];
        if ($balance >= $amount) {
            // update sender and recipient balances
            // calculate the fees
            $fees = $amount * 0.01;
            
            // update sender and recipient balances (after deducting the fees)
            $sql = "UPDATE atlasin SET balance=balance-$amount WHERE id='$id'";
            mysqli_query($conn, $sql);
            
            $sql = "UPDATE atlasin SET balance=balance+($amount-$fees) WHERE id='$recipient_id'";
            mysqli_query($conn, $sql);
            
            // credit fees to admin account
            $sql = "UPDATE atlasin SET balance=balance+$fees WHERE id='$admin_id'";
            mysqli_query($conn, $sql);
            
            // add transaction record (including the fees)
            $sql = "INSERT INTO transaction (sender, receiver, amount, fees) VALUES ('$id', '$recipient_id', '$amount', '$fees')";
            if (mysqli_query($conn, $sql)) {
                $success = "Transaction successful!";
                header("Refresh: 3; url=atlasmoney.php");
            } else {
                $error = "Transaction failed due to technical issue. Please try again later.";
            }
        } else {
            $error = "Insufficient balance";
        }
    } else {
        $error = "Recipient phone number not found";
    }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Send Money</title>
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

            h2 
            {
                text-align: center;
                margin: 0;
                font-size: 36px;
                font-weight: bold;
                text-transform: uppercase;
            }

            input[type=text],
            input[type=number] {
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

            input[type="submit"]:hover {
			background-color: #0ce631;
		}
            
            input[type="button"] {
			background-color: #333;
			color: #fff;
			border: none;
			padding: 10px 70px;
			font-size: 18px;
			font-weight: bold;
			border-radius: 5px;
			cursor: pointer;
		}
        input[type="button"]:hover {
			background-color: #0ce631;
		}

            a {
                text-decoration: none;
                color: #0077b5;
                font-size: 16px;
            }
            .fees{
                color:red;
            }

            .error {
                color: red;
            }

            .hide {
                display: none;
            }

            .success {
                text-align: center;
                color: green;
            }
        </style>

    </head>

    <body>
        <header>
        <h2>WithDraw</h2>
        <div id="message">
            <?php if (isset($success)) { ?>
                <p class="success"><?php echo $success; ?></p>
            <?php } ?>
        </div>
        </header>
        <form method="post">
            <label for="phone"> <b> Agent Phone Number </b></label>
            <input type="text" id="phone" name="phone" required>
            <label for="amount"><b> Amount </b>
            <input type="number" id="amount" name="amount" required>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <input type="submit" value="Send">
            <br> <br>
            <input type="button" value="Logout" onclick="window.location.href='index.php'">
            <input type="button" value="Home" onclick="window.location.href='AdminPage.php'">

        </form>

    </body>

</html>