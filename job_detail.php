<?php 
	if(!isset($_GET["id"])){
		header("Location: ./job_list.php");
	}else{
		include "./session.php";
		include "./server.php";
		$id_lowongan = $_GET["id"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Job Detail</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Job Detail</h3>
		</header>
		<?php
			$sql = ("SELECT * FROM lowongan WHERE id_lowongan = :id_lowongan");
			$params = array(":id_lowongan" => $id_lowongan);
			$sth = $dbh->prepare($sql);
			$sth->execute($params);

			$row = $sth->fetch();
		?>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Information</h3>
				<hr>
				<?php
					$sql = ("SELECT * FROM lowongan WHERE id_lowongan = :id_lowongan AND id_pegawai = :username");
					$params = array(":id_lowongan" => $id_lowongan, ":username" => getUsername());
					$sth = $dbh->prepare($sql);
					$sth->execute($params);

					if($sth->fetch()){
				?>
				<div class="w3-row">
					<p class="w3-right w3-text-teal"><a href=<?php echo "./job_edit.php?id=".$id_lowongan ?>>Edit job</a></p>
				</div>
				<?php
					}
				?>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-suitcase w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Position</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						<?php echo $row["posisi"]; ?>
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-group w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Company</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						<?php 
							$id_perusahaan = $row["id_perusahaan"];
							$sql = ("SELECT nama FROM perusahaan WHERE id_perusahaan = :id_perusahaan");
							$params = array(":id_perusahaan" => $id_perusahaan);
							$sth = $dbh->prepare($sql);
							$sth->execute($params);

							$row2 = $sth->fetch();
						?>
						<a href=<?php echo "\"./company_detail.php?id=".$row["id_perusahaan"]."\""; ?> >
							<?php echo $row2["nama"]; ?>
						</a>
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-money w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Salary</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						<?php echo "IDR ".number_format($row["gaji"]); ?>
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-list w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Requirement</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						<?php echo $row["keterangan"]; ?>
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-hourglass-start w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Open</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						<?php echo $row["tanggal_buka"]; ?>
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-hourglass-end w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Close</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						<?php echo $row["tanggal_tutup"]; ?>
					</p>
				</div>
				<?php
					$sql = ("SELECT * FROM lowongan WHERE id_lowongan = :id_lowongan AND id_pegawai = :username");
					$params = array(":id_lowongan" => $id_lowongan, ":username" => getUsername());
					$sth = $dbh->prepare($sql);
					$sth->execute($params);

					if($sth->fetch()){
				?>
				<div class="w3-row">
					<p class="w3-text-red"><a href=<?php echo "./action_job_delete.php?id_lowongan=".$id_lowongan ?>>Remove this job from list</a></p>
				</div>
				<?php
					}
				?>
			</div>
			<?php 
				if(isLoggedIn() && isApplicant()){
			?>
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Submission Status</h3>
				<hr>
			<?php
					$sql = ("SELECT status FROM lamaran WHERE id_pelamar = :username AND id_lowongan = :id_lowongan");
					$params = array(":username" => getUsername(), ":id_lowongan" => $id_lowongan);
					$sth = $dbh->prepare($sql);
					$sth->execute($params);
					if($row = $sth->fetch()){
						$status = $row["status"];
						if($status === "pending"){
			?>
				<form method="post" action="action_job_unapply.php">
					<input type="text" name="id_pelamar" value= <?php echo "\"".getUsername()."\""; ?> class="w3-hide">
					<input type="text" name="id_lowongan" value= <?php echo "\"".$id_lowongan."\""; ?> class="w3-hide">
					<p class="w3-xxlarge w3-center w3-opacity"><b>Waiting for response</b></p>
					<input type="submit" value="Cancel apply" class="w3-btn w3-red w3-large w3-right" >
				</form>
			<?php
						}else if($status === "accepted"){
			?>
				<p class="w3-xxlarge w3-center"><b>Your submission is <span class="w3-text-green">accepted</span></b></p>
				<button class="w3-btn w3-blue w3-large w3-right" disabled>Applied</button>
			<?php
						}else if($status === "rejected"){
			?>
				<p class="w3-xxlarge w3-center"><b>Your submission is <span class="w3-text-red">rejected</span></b></p>
				<button class="w3-btn w3-blue w3-large w3-right" disabled>Applied</button>
			<?php
						}
					}else{
			?>
				<form method="post" action="action_job_apply.php">
					<input type="text" name="id_pelamar" value= <?php echo "\"".getUsername()."\""; ?> class="w3-hide">
					<input type="text" name="id_lowongan" value= <?php echo "\"".$id_lowongan."\""; ?> class="w3-hide">
					<p class="w3-xxlarge w3-text-green w3-center"><b>Apply now!</b></p>
					<input type="submit" value="Apply" class="w3-btn w3-blue w3-large w3-right" >
				</form>
			<?php
					}
			?>
			</div>
			<?php
				}
			?>
			
			<?php
				if(isLoggedIn() && isEmployee()){

					$sql = ("SELECT * FROM lowongan WHERE id_lowongan = :id_lowongan AND id_pegawai = :username");
					$params = array(":id_lowongan" => $id_lowongan, ":username" => getUsername());
					$sth = $dbh->prepare($sql);
					$sth->execute($params);

					if($sth->fetch()){
			?>
			<div class="w3-container w3-section w3-padding-hor-16 w3-card-2 w3-white">
				<h3 class="w3-center">Submission List</h3>
				<?php
						$sql = ("SELECT p.id_pelamar id_pelamar, pg.nama nama, l.id_lowongan id_lowongan, l.status status, p.gender gender, p.tanggal_lahir birthday FROM lamaran l INNER JOIN pelamar p ON l.id_pelamar = p.id_pelamar INNER JOIN pengguna pg ON pg.id_pengguna = p.id_pelamar WHERE l.id_lowongan = :id_lowongan ORDER BY l.tanggal_status DESC");
						$params = array(":id_lowongan" => $id_lowongan);
						$sth = $dbh->prepare($sql);
						$sth->execute($params);

						if($res = $sth->fetchAll()){
							foreach ($res as $row) {
				?>
				<hr>
				<div class="w3-container w3-padding-hor-16 w3-hover-light-grey">
					<span class="w3-large"><?php echo $row["nama"]; ?></span>
					<p>
						<i class="fa fa-venus-mars" style="margin-right: 5px;"></i>
						<span><?php echo $row["gender"]; ?></span>
						<span class="w3-padding-ver-8">|</span>
						<i class="fa fa-birthday-cake" style="margin-right: 5px;"></i>
						<span>
						<?php
								$start = new DateTime($row["birthday"]);
								$now = new DateTime("today");
								echo ($start->diff($now)->y)." years old";
						?>
						</span>
						<?php
								$status = $row["status"];
								if($status === "accepted"){
						?>
						<span class="w3-padding-ver-8">|</span>
						<i class="fa fa-check w3-text-green" style="margin-right: 5px;"></i>
						<span class="w3-text-green">this apply is accepted</span>
						<?php
								}else if($status === "rejected"){
						?>
						<span class="w3-padding-ver-8">|</span>
						<i class="fa fa-times w3-text-red" style="margin-right: 5px;"></i>
						<span class="w3-text-red">this apply is rejected</span>
						<?php
								}
						?>
					</p>
					<a href=<?php echo "\"./profile.php?id=".$row["id_pelamar"]."\""; ?>><button class="w3-btn w3-purple">View profile</button></a>
					<?php
								if($status === "pending"){
									$id_pelamar = $row["id_pelamar"];
					?>
					<form method="post" action="action_job_apply_update.php" class="w3-hide" id="accept_form">
						<input type="text" name="id_pelamar" value= <?php echo "\"".$id_pelamar."\""; ?> class="w3-hide">
						<input type="text" name="id_lowongan" value= <?php echo "\"".$id_lowongan."\""; ?> class="w3-hide">
						<input type="text" name="status" value="accepted" class="w3-hide">
					</form>
					<form method="post" action="action_job_apply_update.php" class="w3-hide" id="reject_form">
						<input type="text" name="id_pelamar" value= <?php echo "\"".$id_pelamar."\""; ?> class="w3-hide">
						<input type="text" name="id_lowongan" value= <?php echo "\"".$id_lowongan."\""; ?> class="w3-hide">
						<input type="text" name="status" value="rejected" class="w3-hide">
					</form>
					<button type="submit" class="w3-btn w3-green" form="accept_form">Accept</button>
					<button type="submit" class="w3-btn w3-red" form="reject_form">Reject</button>
					<?php
								}
					?>
				</div>
				<?php
							}
						}else{
				?>
				<hr>
				<span class="w3-large w3-text-teal">No one applied</span>
				<?php
						}
				?>
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</body>
</html>