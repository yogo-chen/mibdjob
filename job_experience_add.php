<!DOCTYPE html>
<html>
<head>
	<title>Add Job Experience</title>
<?php include "./style.php"; ?>
</head>
<body class="w3-light-grey">
	<?php include "./navigation.php"; ?>
	<div class="w3-main w3-animate-right" style="margin-left: 275px">
		<header class="w3-top w3-container w3-blue-grey" style="z-index: 2">
			<span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
			<h3><a href="./profile.php" style="text-decoration: none;"><i class="fa fa-angle-left w3-margin-right"></i>Back to profile</a></h3>
		</header>
		<div class="w3-container w3-content" style="padding-top: 96px">
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Add Job Experience</h3>
				<hr>
				<form method="post" action="action_job_experience_insert.php">
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-group w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Company</b></span>
						</p>
						<input type="text" placeholder="Company" name="company" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-suitcase w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Position</b></span>
						</p>
						<input type="text" placeholder="Position" name="position" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-sign-in w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Start</b></span>
						</p>
						<input type="date" placeholder="Works on" name="start" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-sign-out w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>End</b></span>
						</p>
						<input type="date" placeholder="Works until" name="end" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input name="username" value=<?php echo "\"".getusername()."\""; ?> class="w3-hide">
					<input type="submit" value="Add job experience" class="w3-large w3-blue w3-btn w3-right">
				</form>
			</div>
		</div>
	</div>
</body>
</html>