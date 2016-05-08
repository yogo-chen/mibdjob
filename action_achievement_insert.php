<?php
	include "./server.php";

	$username = $_POST["username"];
	$name = $_POST["name"];
	$time_added = $_POST["time"];

	$sql = ("INSERT INTO prestasi(id_pelamar, nama, tanggal) VALUES (:username, :name, :time_added)");
	$params = array(":username" => $username, ":name" => $name, ":time_added" => $time_added);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./profile.php");
?>