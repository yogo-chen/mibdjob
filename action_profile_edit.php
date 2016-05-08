<?php
	include "./server.php";

	$username = $_POST["username"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$usertype = $_POST["usertype"];

	$sql = ("UPDATE pengguna SET nama = :name, email = :email WHERE id_pengguna = :username");
	$params = array(":name" => $name, ":email" => $email, ":username" => $username);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	if($usertype === "applicant"){
		$ktp = $_POST["ktp"];
		$gender = $_POST["gender"];
		$birthday = $_POST["birthday"];
		$location = $_POST["location"];

		$sql = ("UPDATE pelamar SET no_ktp = :ktp, gender = :gender, tanggal_lahir = :birthday, lokasi = :location WHERE id_pelamar = :username");
		$params = array(":ktp" => $ktp, ":gender" => $gender, ":birthday" => $birthday, ":location" => $location, ":username" => $id_pengguna);
		$sth = $dbh->prepare($sql);
		$sth->execute($params);
	}
?>