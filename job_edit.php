<?php 
	include "./session.php";
	if(!isLoggedIn()){
		header("Location: ./sign_in.php");
	}
	include "./server.php";
	$id_lowongan = $_GET["id"];

	$sql = "SELECT * FROM lowongan WHERE id_lowongan = :id_lowongan AND id_pegawai = :id_pegawai";
	$params = array(":id_lowongan" => $id_lowongan, ":id_pegawai" => getUsername());
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	if(!($result = $sth->fetch())){
		header("Location: ./index.php");
	}else{
		$posisi = $result["posisi"];
		$gaji = $result["gaji"];
		$keterangan = $result["keterangan"];
		$tanggal_tutup = $result["tanggal_tutup"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Job</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Edit Job</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<form method="post" action="action_job_edit.php">
				<div class="w3-container w3-section w3-card-2 w3-white">
					<h3 class="w3-center">Edit Job</h3>
					<hr>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-suitcase w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Position</b></span>
						</p>
						<input type="text" value=<?php echo "\"".$posisi."\"" ?> placeholder="job position" name="position" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-money w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Salary</b></span>
						</p>
						<input type="number" min="0" value=<?php echo "\"".$gaji."\"" ?> placeholder="job salary" name="salary" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-list w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Requirement</b></span>
						</p>
						<input type="text" value=<?php echo "\"".$keterangan."\"" ?> placeholder="job requirement" name="requirement" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-hourglass-end w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Close</b></span>
						</p>
						<input type="date" value=<?php echo "\"".$tanggal_tutup."\"" ?> placeholder="this job will available until" name="end_date" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input type="text" name="id_lowongan" value=<?php echo $id_lowongan ?> class="w3-hide">
					<input type="submit" value="Save change" class="w3-large w3-blue-grey w3-btn w3-right">
				</div>
			</form>
		</div>
	</div>
</body>
</html>