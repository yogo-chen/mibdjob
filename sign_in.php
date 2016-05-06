<?php 
	include "./session.php";
	if(isLoggedIn()){
		header("Location: ./index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Sign In</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Sign In</h3>
				<hr>
				<form method="post" action="action_sign_in.php">
					<?php 
						if(isset($_GET["status"])){
							$message = $_GET["status"];
							if($message === "wrong"){
					?>
					<p class="w3-center w3-text-red">Invalid username or password!</p>
					<?php
							}else if($message === "account_created"){
					?>
					<p class="w3-center w3-text-teal">Your account has been successfully created. Sign in to continue.</p>
					<?php
							}
						}
					?>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-user w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Username</b></span>
						</p>
						<input type="text" pattern="^[a-zA-Z0-9_]+$" placeholder="username" name="username" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-key w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Password</b></span>
						</p>
						<input type="password" placeholder="password" name="password" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input type="submit" value="Sign in" class="w3-large w3-blue-grey w3-btn w3-right">
				</form>
			</div>
		</div>
	</div>
</body>
</html>