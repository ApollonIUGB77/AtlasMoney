<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];

// retrieve user balance
$sql_balance = "SELECT balance FROM atlasin WHERE id='$id'";
$result_balance = mysqli_query($conn, $sql_balance);
$balance = mysqli_fetch_assoc($result_balance)['balance'];

// retrieve user transactions
$sql_transactions = "SELECT t.timestamp, t.sender, t.fees, u.name as sender_name, u.phone as sender_phone
    FROM transaction t
    INNER JOIN atlasin u ON t.sender = u.id
    WHERE t.fees > 0
    ORDER BY t.timestamp DESC "; 


$result_transactions = mysqli_query($conn, $sql_transactions);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Transactions</title>
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
        table {
            background-color: #fff;
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
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
        .button-container-div {
            text-align: center;
            height: 40vh;
        }
		input[type="button"]:hover {
			background-color: #0ce631;
		}
    </style>
</head>
<body>
    <header>
    <h2>All Fees </h2>
    </header>
    <?php if (mysqli_num_rows($result_transactions) > 0): ?>
        <table>
            <thead>
                <tr>
                   <th>Date</th>
                    <th>Sender</th>
                    <th>Sender Phone</th>
                     <th>Fee Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_transactions)): ?>
                    <tr>
                       <td><?php echo $row['timestamp']; ?></td>
                        <td><?php echo $row['sender_name']; ?></td>
                        <td><?php echo $row['sender_phone']; ?></td>
						<td><?php echo number_format($row['fees'], 0, '', ','); ?> FCFA</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>fees found.</p>
    <?php endif; ?>
    <div class="button-container-div">
    <input type="button" value="Back" onclick="window.location.href='AdminPage.php'">
    </div>
    
</body>
</html>
