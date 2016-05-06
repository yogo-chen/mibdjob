<?php
	include "./server.php";
	$id_pelamar = $_POST["id_pelamar"];
	$id_lowongan = $_POST["id_lowongan"];

	$sql = ("INSERT INTO lamaran (id_pelamar, id_lowongan, tanggal_daftar, status, tanggal_status, alasan) VALUES (:id_pelamar, :id_lowongan, CURRENT_DATE, :status, CURRENT_DATE, NULL)");
	$params = array(":id_pelamar" => $id_pelamar, ":id_lowongan" => $id_lowongan, ":status" => "pending");
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./job_detail.php?id=".$id_lowongan);
?>