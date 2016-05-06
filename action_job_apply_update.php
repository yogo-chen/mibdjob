<?php
	include "./server.php";
	$id_lowongan = $_POST["id_lowongan"];
	$id_pelamar = $_POST["id_pelamar"];
	$status = $_POST["status"];

	echo $id_lowongan;
	echo $id_pelamar;
	echo $status;

	$sql = ("UPDATE lamaran SET status = :status, tanggal_status = CURRENT_DATE WHERE id_lowongan = :id_lowongan AND id_pelamar = :id_pelamar");
	$params = array(":id_lowongan" => $id_lowongan, ":id_pelamar" => $id_pelamar, ":status" => $status);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./job_detail.php?id=".$id_lowongan);
?>