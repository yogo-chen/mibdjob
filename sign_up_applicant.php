<?php 
	include "./session.php";
	if(isLoggedIn()){
		header("Location: ./index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Sign Up</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Applicant Sign Up</h3>
				<hr>
				<form method="post" action="./action_sign_up_applicant.php" onsubmit="return checkPassword()">
					<div class="w3-row">
						<p class="w3-col s12 m12 l12"><a href="./sign_up_employee.php" class="w3-right w3-medium w3-text-teal">Employee? Click here to sign up</a></p>
					</div>
					<?php 
						if(isset($_GET["status"])){
							$message = $_GET["status"];
							if($message === "username_taken"){
					?>
					<p class="w3-center w3-text-red">Username is already taken</p>
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
						<input type="text" minlength="4" maxlength="20" pattern="^[a-zA-Z0-9_]+$" placeholder="username (4-20 alphanumeric characters)" name="username" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-key w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Password</b></span>
						</p>
						<input type="password" minlength="4" placeholder="password (4 characters or more)" name="password" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" id="password_input" onkeyup="checkPassword()" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-key w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Re-Password</b></span>
						</p>
						<input type="password" placeholder="re-type your password" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" id="re_password_input" onkeyup="checkPassword()" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-comment-o w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Name</b></span>
						</p>
						<input type="text" placeholder="your name" name="name" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-venus-mars w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Gender</b></span>
						</p>
						<div class="w3-col s8 m8 l8" style="padding-top: 8px;">
							<input type="radio" value="male" name="gender" class="w3-radio" required>
							<span class="w3-margin-right">Male</span>
							<input type="radio" value="female" name="gender" class="w3-radio" required>
							<span>Female</span>
						</div>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-birthday-cake w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Birthday</b></span>
						</p>
						<input type="date" placeholder="birthday" name="birthday" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-map-marker w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Location</b></span>
						</p>
						<input type="text" placeholder="your current location" name="location" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-envelope-o w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Email</b></span>
						</p>
						<input type="email" placeholder="your email address" name="email" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-credit-card w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>ID Card</b></span>
						</p>
						<input type="text" placeholder="your id card" name="id_card" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input type="submit" value="Sign up" class="w3-large w3-blue-grey w3-btn w3-right">
				</form>
			</div>
		</div>
	</div>
	<script>
	function checkPassword(){
		var password_input = document.getElementById("password_input");
		var re_password_input = document.getElementById("re_password_input");
		if(password_input.value.length < 4){
			password_input.classList.add("w3-border-red");
			re_password_input.classList.add("w3-border-red");
			return false;
		}else if(password_input.value !== re_password_input.value){
			password_input.classList.add("w3-border-red");
			re_password_input.classList.add("w3-border-red");
			return false;
		}else{
			password_input.classList.remove("w3-border-red");
			re_password_input.classList.remove("w3-border-red");
			return true;
		}
	}
	</script>
</body>
</html>