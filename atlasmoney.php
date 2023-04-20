<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['phone'])) {

	require_once "db_connect.php";
	$userId = $_SESSION['id'];

	// Retrieve user's balance from the database
	$query = "SELECT balance FROM atlasin WHERE id = '$userId'";
	$result = mysqli_query($conn, $query);
	$balance = mysqli_fetch_assoc($result)['balance'];

	// Retrieve user's last 3 transactions from the database
	// Retrieve user's last 3 transactions from the database with sender and receiver names
	$query = "SELECT t.timestamp, a1.name AS sender_name, a1.phone AS sender_phone, a2.name AS receiver_name, a2.phone AS receiver_phone,(t.amount - t.fees) as amount , t.transaction_number as trans_id
	FROM transaction t
	JOIN atlasin a1 ON t.sender = a1.id
	JOIN atlasin a2 ON t.receiver = a2.id
	WHERE t.sender = '$userId' OR t.receiver = '$userId'
	ORDER BY t.timestamp DESC
	LIMIT 3";

	$result = mysqli_query($conn, $query);

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Atlas Money</title>
		<link rel="stylesheet" type="text/css" href="atlas.css">
	</head>

	<body>
		<header>
			<div class="left-side">
				<h1>
					<span class="ATLAS">ATLAS</span>
					<span class="MONEY">MONEY</span>
				</h1>
				<p id="name">Welcome, <span></span>
				</p>
			</div>
			<div class="right-side">
				<a href="assistance.html">Assistance</a>
				<a href="updateProfile.php">Profile</a>
				<a href="transactionDetail.php">Transaction Details</a>
				<a href="logout.php">Logout</a>
			</div>
		</header>
		<main>
			<div class="container">
				<div class="balance-section">
					<h2>Your Balance</h2>
					<p class="amount"> <?php echo number_format($balance, 0, '', ','); ?> FCFA</p>
					<button id="toggle-balance" onclick="toggleBalance()">Hide Balance</button>
				</div>

				<button class="send-money-button"><a href="SendMoney.php">Send Money</a></button>
				<div class="transactions-section">
					<h2>Recent Transactions</h2>
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
							<?php while ($row = mysqli_fetch_assoc($result)) { ?>
								<tr>
									<td><?php echo $row['timestamp']; ?></td>
									<td><?php echo $row['sender_name']; ?></td>
									<td><?php echo $row['sender_phone']; ?></td>
									<td><?php echo $row['receiver_name']; ?></td>
									<td><?php echo $row['receiver_phone']; ?></td>
									<td><?php echo number_format($row['amount'], 0, '', ','); ?> FCFA</td>
									<td><?php echo $row['trans_id']; ?></td>
                    </tr>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<a href="transactionDetail.php">See More</a>
				</div>
			</div>
		</main>

		<script>
			const nameElement = document.getElementById('name');
			const userName = '<?php echo $_SESSION["name"]; ?>';
			let currentIndex = 0;

			setInterval(() => {
				nameElement.style.fontFamily = 'monospace';
				nameElement.style.fontSize = '24px';
				nameElement.innerText = userName.slice(currentIndex) + ' ' + userName.slice(0, currentIndex);
				currentIndex = (currentIndex + 1) % userName.length;
			}, 300);
		</script>
		<script>
			const balanceElement = document.querySelector('.amount');
			const toggleBalanceButton = document.getElementById('toggle-balance');
			let isBalanceVisible = true;

			function toggleBalance() {
				if (isBalanceVisible) {
					balanceElement.textContent = '*'.repeat(balanceElement.textContent.length);
					toggleBalanceButton.innerText = 'Show Balance';
				} else {
					balanceElement.style.visibility = 'visible';
					balanceElement.textContent = '<?php echo $balance; ?> FCFA';
					toggleBalanceButton.innerText = 'Hide Balance';
				}
				isBalanceVisible = !isBalanceVisible;
			}
		</script>



	</body>

	</html>
<?php
	mysqli_close($conn);
} else {
	header("Location: index.php");
	exit();
}
?>