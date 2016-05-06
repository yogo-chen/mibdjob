<?php
	include "./server.php";
	$id_pelamar = $_POST["id_pelamar"];
	$id_lowongan = $_POST["id_lowongan"];

	$sql = ("DELETE FROM lamaran WHERE id_pelamar = :id_pelamar AND id_lowongan = :id_lowongan");
	$params = array(":id_pelamar" => $id_pelamar, ":id_lowongan" => $id_lowongan);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./job_detail.php?id=".$id_lowongan);
?>