<?php 
	include "./server.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$name = $_POST["name"];
	$gender = $_POST["gender"];
	$birthday = $_POST["birthday"];
	$location = $_POST["location"];
	$email = $_POST["email"];
	$id_card = $_POST["id_card"];

	$sql = ("SELECT id_pengguna FROM pengguna WHERE id_pengguna = :username");
	$params = array(":username" => $username);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	if($row = $sth->fetch()){
		header("Location: ./sign_up_applicant.php?status=username_taken");
	}else{
		$sql = ("INSERT INTO pengguna (id_pengguna, password, nama, email, jenis_pengguna) VALUES (:username, :password, :name, :email, :usertype)");
		$params = array(":username" => $username, ":password" => $password, ":name" => $name, ":email" => $email, ":usertype" => "applicant");
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$sql = ("INSERT INTO pelamar (id_pelamar, no_ktp, gender, tanggal_lahir, lokasi) VALUES (:username, :id_card, :gender, :birthday, :location)");
		$params = array(":username" => $username, ":id_card" => $id_card, ":gender" => $gender, ":birthday" => $birthday, ":location" => $location);
		$sth = $dbh->prepare($sql);
		$sth->execute($params);
		
		header("Location: ./sign_in.php?status=account_created");
	}
?>