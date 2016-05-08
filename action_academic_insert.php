<?php
	include "./server.php";

	$username = $_POST["username"];
	$university = $_POST["university"];
	$major = $_POST["major"];
	$degree = $_POST["degree"];
	$class = $_POST["class"];
	$gpa = $_POST["gpa"];

	$sql = ("INSERT INTO akademik(id_pelamar, nama_universitas, jurusan, tingkat, ip_lulus, tanggal_lulus) VALUES (:username, :university, :major, :degree, :gpa, :class)");
	$params = array(":username" => $username, ":university" => $university, ":major" => $major, ":degree" => $degree, ":gpa" => $gpa, ":class" => $class);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./profile.php");
?>