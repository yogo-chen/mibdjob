<?php 
	include "./server.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$name = $_POST["name"];
	$division = $_POST["division"];
	$email = $_POST["email"];
	$company_id = $_POST["company_id"];

	$sql = ("SELECT id_pengguna FROM pengguna WHERE id_pengguna = :username");
	$params = array(":username" => $username);
	$sth = $dbh->prepare($sql);
	$sth->execute($params);

	if($row = $sth->fetch()){
		header("Location: ./sign_up_employee.php?status=username_taken");
	}else{
		$sql = ("INSERT INTO pengguna (id_pengguna, password, nama, email, jenis_pengguna) VALUES (:username, :password, :name, :email, :usertype)");
		$params = array(":username" => $username, ":password" => $password, ":name" => $name, ":email" => $email, ":usertype" => "employee");
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		if($company_id === "new"){
			$company_name = $_POST["company_name"];

			$sql = ("INSERT INTO perusahaan (id_perusahaan, nama) VALUES (NULL, :company_name)");
			$params = array(":company_name" => $company_name);
			$sth = $dbh->prepare($sql);
			$sth->execute($params);

			$company_id = $dbh->lastInsertId();
		}
		
		$sql = ("INSERT INTO pegawai (id_pegawai, id_perusahaan, divisi) VALUES (:username, :company_id, :division)");
		$params = array(":username" => $username, ":company_id" => $company_id, ":division" => $division);
		$sth = $dbh->prepare($sql);
		$sth->execute($params);
		
		header("Location: ./sign_in.php?status=account_created");
	}
?>