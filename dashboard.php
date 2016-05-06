<?php 
	include "./session.php";
	if(!isLoggedIn()){
		header("Location: ./index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Dashboard</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<?php if(isEmployee()){include "./dashboard_employee.php";} ?>
		</div>
	</div>
</body>
</html>