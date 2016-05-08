<?php include "./server.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Job List</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php" ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Job List</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-padding-hor-16 w3-card-2 w3-white">
				<h3 class="w3-center">Available Job</h3>
				<?php 
					$sql = ("SELECT l.id_lowongan id_lowongan, l.id_perusahaan id_perusahaan, l.gaji gaji, l.posisi posisi, p.nama nama_perusahaan FROM lowongan l INNER JOIN perusahaan p ON l.id_perusahaan = p.id_perusahaan WHERE l.tanggal_tutup > CURRENT_DATE ORDER BY l.tanggal_tutup ASC");
					$sth = $dbh->prepare($sql);
					$sth->execute();
					if($res = $sth->fetchAll()){
						foreach ($res as $row) {
				?>
				<hr>
				<div class="w3-container w3-padding-hor-16 w3-hover-light-grey">
					<span class="w3-large"><?php echo $row["posisi"]; ?></span>
					<p>
						<i class="fa fa-group" style="margin-right: 5px;"></i>
						<a href=<?php echo "\"./company_detail.php?id=".$row["id_perusahaan"]."\""; ?>><?php echo $row["nama_perusahaan"]; ?></a>
						<span class="w3-padding-ver-8">|</span>
						<i class="fa fa-money w3-text-teal" style="margin-right: 5px;"></i>
						<span class="w3-text-teal"><?php echo "IDR ".number_format($row["gaji"]); ?></span>
					</p>
					<a href=<?php echo "\"./job_detail.php?id=".$row["id_lowongan"]."\""; ?> ><button class="w3-btn w3-purple">View job</button></a>
				</div>
				<?php 
						}
					}else{
				?>
				<hr>
				<div class="w3-container w3-padding-hor-16">
					<span class="w3-large w3-text-teal">There is no available job at the moment.</span>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>