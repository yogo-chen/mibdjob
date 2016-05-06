<?php 
	include "./session.php";
	if(isLoggedIn()){
		header("Location: ./dashboard.php");
	}else{
		header("Location: ./sign_in.php");
	}
?>