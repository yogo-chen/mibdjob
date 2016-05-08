<?php
	include "./server.php";

	$id_pelamar = $_POST["id_pelamar"];
	$instansi = $_POST["instansi"];
	$posisi = $_POST["posisi"];

	$sql = ("DELETE FROM pengalaman WHERE id_pelamar = :id_pelamar AND instansi = :instansi AND posisi = :posisi");
	$params = array(":id_pelamar" => $id_pelamar, ":instansi" => $instansi, ":posisi" => $posisi);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./profile.php");
?>