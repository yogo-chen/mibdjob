<?php
	include "./server.php";

	$id_lowongan = $_POST["id_lowongan"];
	$position = $_POST["position"];
	$salary = $_POST["salary"];
	$requirement = $_POST["requirement"];
	$end_date = $_POST["end_date"];

	$sql = ("UPDATE lowongan SET posisi = :position, gaji = :salary, keterangan = :requirement, tanggal_tutup = :end_date WHERE id_lowongan = :id_lowongan");
	$params = array(":position" => $position, ":salary" => $salary, ":requirement" => $requirement, ":end_date" => $end_date, ":id_lowongan" => $id_lowongan);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./job_detail.php?id=".$id_lowongan);
?>