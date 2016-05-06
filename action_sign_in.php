<?php 
	include "./server.php";
	include "./session.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = ("SELECT id_pengguna, password, jenis_pengguna, nama FROM pengguna WHERE id_pengguna = :username AND password = :password");
	$params = array(':username' => $username, ':password' => $password);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);
	if($row = $sth->fetch()){
		setSession($row["id_pengguna"], $row["jenis_pengguna"], $row["nama"]);
		header("Location: ./index.php");
	}else{
		header("Location: ./sign_in.php?status=wrong");
	}
?>