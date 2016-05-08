<?php
	include "./session.php";
	if(!isLoggedIn()){
		header("Location: ./index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php" ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3><a href="./profile.php" style="text-decoration: none;"><i class="fa fa-angle-left w3-margin-right"></i>Back to profile</a></h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Edit My Profile</h3>
				<?php
					include "./server.php";
					if(isApplicant()){
						$sql = ("SELECT pg.nama nama, pg.email email, pl.no_ktp no_ktp, pl.gender gender, pl.tanggal_lahir tanggal_lahir, pl.lokasi lokasi FROM pengguna pg INNER JOIN pelamar pl ON pg.id_pengguna = pl.id_pelamar WHERE pg.id_pengguna = :username");
						$params = array(":username" => getUsername());
						$sth = $dbh->prepare($sql);
						$sth->execute($params);

						$res = $sth->fetch();
						$nama = $res["nama"];
						$email = $res["email"];
						$gender = $res["gender"];
						$no_ktp = $res["no_ktp"];
						$tanggal_lahir = $res["tanggal_lahir"];
						$lokasi = $res["lokasi"];
				?>
				<hr>
				<form method="post" action="action_profile_edit.php">
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-comment w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Name</b></span>
						</p>
						<input type="text" value=<?php echo "\"".$nama."\"" ?> name="name" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;"  required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-venus-mars w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Gender</b></span>
						</p>
						<div class="w3-col s8 m8 l8" style="padding-top: 6px;">
							<input type="radio" value="male" name="gender" class="w3-radio" required <?php if($gender === "male"){echo "checked";} ?>>
							<span>male</span>
							<input type="radio" value="male" name="gender" class="w3-radio" required <?php if($gender === "female"){echo "checked";} ?>>
							<span>female</span>
						</div>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-birthday-cake w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Birthday</b></span>
						</p>
						<input type="date" value=<?php echo "\"".$tanggal_lahir."\"" ?> placeholder="Birthday" name="birthday" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-map-marker w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Location</b></span>
						</p>
						<input type="text" value=<?php echo "\"".$lokasi."\"" ?> placeholder="Location" name="location" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-envelope w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Email</b></span>
						</p>
						<input type="email" value=<?php echo "\"".$email."\"" ?> placeholder="Email" name="email" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-credit-card w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>ID Card</b></span>
						</p>
						<input type="text" value=<?php echo "\"".$no_ktp."\"" ?> placeholder="Email" name="ktp" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input name="username" value=<?php echo "\"".getUsername()."\"" ?> class="w3-hide">
					<input name="usertype" value="applicant" class="w3-hide">
					<input type="submit" value="Save change" class="w3-large w3-blue w3-btn w3-right">
				</form>
				<?php
					}else{
						$sql = ("SELECT nama, email FROM pengguna WHERE id_pengguna = :username");
						$params = array(":username" => getUsername());
						$sth = $dbh->prepare($sql);
						$sth->execute($params);

						$res = $sth->fetch();
						$nama = $res["nama"];
						$email = $res["email"];
				?>
				<hr>
				<form method="post" action="action_profile_edit.php">
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-comment w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Name</b></span>
						</p>
						<input type="text" value=<?php echo "\"".$nama."\"" ?> name="name" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;"  required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-envelope w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Email</b></span>
						</p>
						<input type="email" value=<?php echo "\"".$email."\"" ?> placeholder="Email" name="email" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input name="username" value=<?php echo "\"".getUsername()."\"" ?> class="w3-hide">
					<input name="usertype" value="employee" class="w3-hide">
					<input type="submit" value="Save change" class="w3-large w3-blue w3-btn w3-right">
				</form>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>