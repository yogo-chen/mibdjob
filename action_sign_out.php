<?php 
	include "./session.php";
	destroySession();
	header("Location: ./index.php");
?>