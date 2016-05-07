<?php
	include "./session.php";
	if(isLoggedIn()){
		if(isset($_GET["id"])){
			$id_pengguna = $_GET["id"];
		}else{
			$id_pengguna = getUsername();
		}

		include "./server.php";

		$sql = ("SELECT nama, email, jenis_pengguna FROM pengguna WHERE id_pengguna = :id_pengguna");
		$params = array(":id_pengguna" => $id_pengguna);
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		if(!($res = $sth->fetch())){
			//print not found
		}else{
			$nama = $res["nama"];
			$email = $res["email"];
			$jenis_pengguna = $res["jenis_pengguna"];
		
			if($jenis_pengguna === "applicant"){
				$sql = ("SELECT no_ktp, gender, tanggal_lahir, lokasi FROM pelamar WHERE id_pelamar = :id_pelamar");
				$params = array(":id_pelamar" => $id_pengguna);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				$res = $sth->fetch();
				$no_ktp = $res["no_ktp"];
				$tanggal_lahir = $res["tanggal_lahir"];
				$lokasi = $res["lokasi"];
			}else if($jenis_pengguna === "employee"){
				$sql = ("SELECT pr.id_perusahaan id_perusahaan, pr.nama nama_perusahaan, pg.divisi divisi FROM pegawai pg INNER JOIN perusahaan pr ON pg.id_perusahaan = pr.id_perusahaan WHERE pg.id_pegawai = :id_pegawai");
				$params = array(":id_pegawai" => $id_pengguna);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				$res = $sth->fetch();
				$id_perusahaan = $res["id_perusahaan"];
				$nama_perusahaan = $res["nama_perusahaan"];
				$divisi = $res["divisi"];
			}

			if($jenis_pengguna === "applicant"){
				$sql = ("SELECT up.jurusan jurusan, up.tingkat tingkat, up.ip_lulus ip_lulus, up.tanggal_lulus tanggal_lulus, u.nama nama_universitas FROM universitaspelamar up INNER JOIN universitas u ON up.id_universitas = u.id_universitas WHERE up.id_pelamar = :id_pelamar");
				$params = array(":id_pelamar" => $id_pengguna);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				if($res = $sth->fetchAll()){
					foreach ($res as $row) {
						$jurusan = $row["jurusan"];
						$tingkat = $row["tingkat"];
						$ip_lulus = $row["ip_lulus"];
						$tanggal_lulus = $row["tanggal_lulus"];
						$nama_universitas = $row["nama_universitas"];
					}
				}

				$sql = ("SELECT instansi, posisi, keterangan, tanggal_mulai, tanggal_selesai FROM pengalaman WHERE id_pelamar = :id_pelamar");
				$params = array(":id_pelamar" => $id_pengguna);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				if($res = $sth->fetchAll()){
					foreach ($res as $row) {
						$instansi = $row["instansi"];
						$posisi = $row["posisi"];
						$keterangan = $row["keterangan"];
						$tanggal_mulai = $row["tanggal_mulai"];
						$tanggal_selesai = $row["tanggal_selesai"];
					}
				}

				$sql = ("SELECT nama, keterangan, tanggal FROM prestasi WHERE id_pelamar = :id_pelamar");
				$params = array(":id_pelamar" => $id_pengguna);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				if($res = $sth->fetchAll()){
					foreach ($res as $row) {
						$nama = $row["nama"];
						$keterangan = $row["keterangan"];
						$tanggal = $row["tanggal"];
					}
				}
			}
		}
	}else{
		header("Location: ./index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Profile</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<!-- Profile detail -->
			<?php

			?>
			<div class="w3-container w3-section w3-card-2 w3-white">
				<header class="w3-padding-xlarge">
					<span class="w3-xlarge w3-margin-right"><b>Applicant Name</b></span>
					<span class="w3-opacity w3-large">(applicant username)</span>
				</header>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-venus-mars w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Gender</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-birthday-cake w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Age</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-map-marker w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Location</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-envelope w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Email</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-phone w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Phone</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
			</div>
			<!-- Academic life -->
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Academic</h3>
				<hr>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-university w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>University</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-tag w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Major</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-check w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Degree</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-graduation-cap w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Class</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-star w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>GPA</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
			</div>
			<!-- Job experience -->
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Job Experience</h3>
				<hr>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-group w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Company</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-suitcase w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Position</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-clock-o w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Works</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
			</div>
			<!-- Achievement -->
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Achievement</h3>
				<hr>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-trophy w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Name</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
				<div class="w3-row">
					<p class="w3-col s3 m2 l2 w3-right-align">
						<i class="fa fa-calendar w3-margin-right"></i>
					</p>
					<p class="w3-col s1 m2 l2">
						<span class="w3-hide-small"><b>Year</b></span>
					</p>
					<p class="w3-col s8 m8 l8">
						Bla bla
					</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>