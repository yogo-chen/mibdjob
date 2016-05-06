<?php 
	include "./session.php";
	if(!isLoggedIn() || !isEmployee()){
		header("Location: ./index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Academic Life</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3>Create Job</h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">List A New Job</h3>
				<hr>
				<form method="post" action="action_job_create.php">
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-suitcase w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Position</b></span>
						</p>
						<input type="text" placeholder="job position" name="position" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-money w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Salary (IDR)</b></span>
						</p>
						<input type="number" min="0" placeholder="job salary" name="salary" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-list w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Requirement</b></span>
						</p>
						<input type="text" placeholder="job requirement" name="requirement" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-clock-o w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Close on</b></span>
						</p>
						<input type="date" placeholder="this job will available until" name="end_date" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input type="text" name="id_pegawai" value= <?php echo "\"".getUsername()."\""; ?> class="w3-hide"></input>
					<input type="submit" value="List job" class="w3-large w3-blue-grey w3-btn w3-right">
				</form>
			</div>
		</div>
	</div>
</body>
</html>