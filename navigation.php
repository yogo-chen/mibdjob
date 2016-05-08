<?php
	include_once "./session.php";
?>
<nav class="w3-sidenav w3-collapse w3-white w3-card-2 w3-animate-left" style="width:275px; z-index: 3;">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-hide-large">Close &times;</a>
	<div class="w3-center">
		<a href="#" class="w3-xxlarge w3-padding w3-hover-white">mibdJOB</a>
	</div>
	<hr>
	<a href="./dashboard.php" class="w3-padding w3-large w3-hover-light-grey"><i class="fa fa-home w3-margin-right"></i>Dashboard</a>
	<a href="./job_list.php" class="w3-padding w3-large w3-hover-light-grey"><i class="fa fa-suitcase w3-margin-right"></i>Job List</a>
	<a href="./company_list.php" class="w3-padding w3-large w3-hover-light-grey"><i class="fa fa-group w3-margin-right"></i>Company</a>
	<hr>
	<div class="w3-center">
		<?php if(isLoggedIn()){ ?>
		<p>Welcome, 
			<a href="./profile.php" class="w3-hover-text-teal w3-hover-white" style="display: inline; padding: 0px;">
				<b><?php echo getName();?></b>
			</a>
		</p>
		<a href="./action_sign_out.php" class="w3-hover-text-red w3-hover-white" style="display: inline; padding: 0px;"><i class="fa fa-power-off w3-margin-right"></i>Sign out</a>
		<?php } else { ?>
		<p>Welcome, <b>Guest</b></p>
		<a href="./sign_up.php" class="w3-hover-text-red w3-hover-white" style="display: inline; padding: 0px;"><i class="fa fa-user-plus w3-margin-right"></i>Sign up</a>
		<span class="w3-padding-ver-8">|</span>
		<a href="./sign_in.php" class="w3-hover-text-teal w3-hover-white" style="display: inline; padding: 0px;"><i class="fa fa-sign-in w3-margin-right"></i>Sign in</a>
		<?php } ?>
	</div>
</nav>
<script>
		function w3_open() {
			document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
		}
		function w3_close() {
			document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
		}
</script>