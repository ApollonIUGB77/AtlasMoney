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
$sql_transactions = "SELECT t.timestamp, s.name as sender_name, s.phone as sender_phone, r.name as receiver_name, r.phone 
as receiver_phone, (t.amount - t.fees) as amount ,t.transaction_number as trans_id
                     
                     FROM transaction t
                     JOIN atlasin s ON t.sender = s.id
                     JOIN atlasin r ON t.receiver = r.id
                     WHERE t.sender='$id' OR t.receiver='$id'";


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
    <h2>My Transactions</h2>
    </header>
    <?php if (mysqli_num_rows($result_transactions) > 0): ?>
        <table>
            <thead>
                <tr>
                   <th>Date</th>
								<th>Sender</th>
								<th>Sender Phone</th>
								<th>Receiver</th>
								<th>Receiver Phone</th>
								<th>Amount</th>
                                <th>Trans_id</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_transactions)): ?>
                    <tr>
                       <td><?php echo $row['timestamp']; ?></td>
									<td><?php echo $row['sender_name']; ?></td>
									<td><?php echo $row['sender_phone']; ?></td>
									<td><?php echo $row['receiver_name']; ?></td>
									<td><?php echo $row['receiver_phone']; ?></td>
                                    <td><?php echo number_format($row['amount'], 0, '', ','); ?> FCFA</td>
                                    <td><?php echo $row['trans_id']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No transactions found.</p>
    <?php endif; ?>
    <div class="button-container-div">
    <input type="button" value="Back" onclick="window.location.href='atlasmoney.php'">
    </div>
    
</body>
</html>
