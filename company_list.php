<?php include "./server.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Company List</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php" ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Company List</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-padding-hor-16 w3-card-2 w3-white">
				<h3 class="w3-center">Company List</h3>
				<?php 
					$sql = ("SELECT id_perusahaan, nama FROM perusahaan");
					$sth = $dbh->prepare($sql);
					$sth->execute();
					if($res = $sth->fetchAll()){
						foreach ($res as $row) {
				?>
				<hr>
				<div class="w3-container w3-padding-hor-16 w3-hover-light-grey">
					<p class="w3-large"><?php echo $row["nama"]; ?></p>
					<a href=<?php echo "\"./company_detail.php?id=".$row["id_perusahaan"]."\""; ?> ><button class="w3-btn w3-purple">View company</button></a>
				</div>
				<?php 
						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>