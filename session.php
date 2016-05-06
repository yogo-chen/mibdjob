<?php
	function startSession(){
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
	}

	function getUsername(){
		startSession();
		return $_SESSION["username"];
	}

	function getUsertype(){
		startSession();
		return $_SESSION["usertype"];
	}

	function getName(){
		startSession();
		return $_SESSION["name"];
	}

	function setSession($username, $usertype, $name){
		startSession();
		$_SESSION["username"] = $username;
		$_SESSION["usertype"] = $usertype;
		$_SESSION["name"] = $name;
	}

	function isLoggedIn(){
		startSession();
		return isset($_SESSION["username"]);
	}

	function isApplicant(){
		return getUsertype() === "applicant";
	}

	function isEmployee(){
		return getUsertype() === "employee";
	}

	function destroySession(){
		startSession();
		unset($_SESSION["username"]);
		unset($_SESSION["usertype"]);
		unset($_SESSION["name"]);
		session_destroy();
	}
?>