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
	$query = "SELECT t.timestamp, t.sender, t.fees, u.name as sender_name, u.phone as sender_phone
    FROM transaction t
    INNER JOIN atlasin u ON t.sender = u.id
    WHERE t.fees > 0
    ORDER BY t.timestamp DESC
    LIMIT 4"; 
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
        <p id="name">Welcome, <span><?php echo $_SESSION['name']; ?></span></p>
    </div>
    <div class="right-side">
        <a href="AdminFees.php">Transaction Details</a>
        <a href="logout.php">Logout</a>
    </div>
</header>
<main>
    <div class="container">
	<div class="container">
				<div class="balance-section">
					<h2>Your Balance</h2>
					<p class="amount"> <?php echo number_format($balance, 0, '', ','); ?> FCFA</p>
					<button id="toggle-balance" onclick="toggleBalance()">Hide Balance</button>
				</div>

				<button class="send-money-button"><a href="Withdraw.php">Withdraw</a></button>
        <div class="transactions-section">
            <h2>All Fees</h2>
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
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['timestamp']; ?></td>
                        <td><?php echo $row['sender_name']; ?></td>
                        <td><?php echo $row['sender_phone']; ?></td>
						<td><?php echo number_format($row['fees'], 0, '', ','); ?> FCFA</td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
					<a href="AdminFees.php">See More</a>
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