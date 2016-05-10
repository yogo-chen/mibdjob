<?php
	include "./server.php";

	$id_lowongan = $_GET["id_lowongan"];

	$sql = "DELETE FROM lamaran WHERE id_lowongan = :id_lowongan";
	$params = array(":id_lowongan" => $id_lowongan);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	$sql = "DELETE FROM lowongan WHERE id_lowongan = :id_lowongan";
	$params = array(":id_lowongan" => $id_lowongan);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);
	
	header("Location: ./index.php");
?>