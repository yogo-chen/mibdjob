<?php
	include "./server.php";

	$id_pelamar = $_POST["id_pelamar"];
	$tingkat = $_POST["tingkat"];

	$sql = ("DELETE FROM akademik WHERE id_pelamar = :id_pelamar AND tingkat = :tingkat");
	$params = array(":id_pelamar" => $id_pelamar, ":tingkat" => $tingkat);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./profile.php");
?>