<?php
	include "./server.php";

	$id_pelamar = $_POST["id_pelamar"];
	$nama = $_POST["nama"];

	$sql = ("DELETE FROM prestasi WHERE id_pelamar = :id_pelamar AND nama = :nama");
	$params = array(":id_pelamar" => $id_pelamar, ":nama" => $nama);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./profile.php");
?>