<?php
	include "./server.php";
	$id_pegawai = $_POST["id_pegawai"];
	$position = $_POST["position"];
	$salary = $_POST["salary"];
	$requirement = $_POST["requirement"];
	$end_date = $_POST["end_date"];

	$sql = ("SELECT id_perusahaan FROM pegawai WHERE id_pegawai = :id_pegawai");
	$params = array(":id_pegawai" => $id_pegawai);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	$row = $sth->fetch();
	$id_perusahaan = $row["id_perusahaan"];

	$sql = ("INSERT INTO lowongan (id_lowongan, id_pegawai, id_perusahaan, posisi, gaji, keterangan, tanggal_buka, tanggal_tutup) VALUES (NULL, :id_pegawai, :id_perusahaan, :position, :salary, :requirement, CURRENT_DATE, :end_date)");
	$params = array(":id_pegawai" => $id_pegawai, ":id_perusahaan" => $id_perusahaan, ":position" => $position, ":salary" => $salary, ":requirement" => $requirement, "end_date" => $end_date);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	header("Location: ./dashboard.php");
?>