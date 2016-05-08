<!DOCTYPE html>
<html>
<head>
	<title>Add Achievement</title>
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
			<!-- Academic life -->
			<div class="w3-container w3-section w3-card-2 w3-white">
				<h3 class="w3-center">Add Achievement</h3>
				<hr>
				<form method="post" action="action_achievement_insert.php">
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-trophy w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Name</b></span>
						</p>
						<input type="text" placeholder="Achievement name" name="name" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<div class="w3-row">
						<p class="w3-col s3 m2 l2 w3-right-align">
							<i class="fa fa-calendar w3-margin-right"></i>
						</p>
						<p class="w3-col s1 m2 l2">
							<span class="w3-hide-small"><b>Time</b></span>
						</p>
						<input type="date" placeholder="Achieved year" name="time" class="w3-col s8 m8 l8 w3-input" style="padding-top: 14px;" required>
					</div>
					<input name="username" value=<?php echo "\"".getusername()."\""; ?> class="w3-hide">
					<input type="submit" value="Add achievement" class="w3-large w3-blue w3-btn w3-right">
				</form>
			</div>
		</div>
	</div>
</body>
</html>