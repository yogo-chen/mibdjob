<?php
	include "./server.php";

	$username = $_POST["username"];
	$company = $_POST["company"];
	$position = $_POST["position"];
	$start_date = $_POST["start"];
	$end_date = $_POST["end"];

	$sql = ("INSERT INTO pengalaman(id_pelamar, instansi, posisi, tanggal_mulai, tanggal_selesai) VALUES (:username, :company, :position, :start_date, :end_date)");
	$params = array(":username" => $username, ":company" => $company, ":position" => $position, ":start_date" => $start_date, ":end_date" => $end_date);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./profile.php");
?>