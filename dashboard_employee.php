<?php include_once "./server.php"; ?>
<div class="w3-container w3-section w3-padding-hor-16 w3-card-2 w3-white">
	<a href="./job_create.php" class="w3-btn-floating w3-xxlarge w3-blue-grey w3-right" style="text-decoration: none;">+</a>
	<h3 class="w3-center">Active Job List</h3>
	<?php 
		$sql = ("SELECT id_lowongan, posisi, tanggal_tutup FROM lowongan WHERE id_pegawai = :username AND tanggal_tutup > CURRENT_DATE ORDER BY tanggal_tutup ASC");
		$params = array(":username" => getUsername());
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		if($res = $sth->fetchAll()){
			foreach ($res as $row) {
				$sql = ("SELECT la.status status, count(la.status) count FROM lowongan lo INNER JOIN lamaran la ON lo.id_lowongan = la.id_lowongan WHERE lo.id_lowongan = :id_lowongan GROUP BY la.status ORDER BY la.status ASC");
				$params = array(":id_lowongan" => $row["id_lowongan"]);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				unset($pending_count);
				unset($accepted_count);
				unset($rejected_count);

				if($res2 = $sth->fetchAll()){
					foreach ($res2 as $row2) {
						if($row2["status"] === "pending"){
							$pending_count = $row2["count"];
						}else if($row2["status"] === "accepted"){
							$accepted_count = $row2["count"];
						}else if($row2["status"] === "rejected"){
							$rejected_count = $row2["count"];
						}
					}
				}
				if(!isset($pending_count)){
					$pending_count = 0;
				}
				if(!isset($accepted_count)){
					$accepted_count = 0;
				}
				if(!isset($rejected_count)){
					$rejected_count = 0;
				}
				$total_count = $pending_count + $accepted_count + $rejected_count;
	?>
	<hr>
	<div class="w3-container w3-padding-hor-16 w3-hover-light-grey">
		<span class="w3-large"><?php echo $row["posisi"]; ?></span>
		<p>
			<i class="fa fa-user" style="margin-right: 5px;"></i>
			<span>
				<?php
					if($total_count == 0){
						echo "no one applied";
					}else if($total_count == 1){
						echo "1 total apply";
					}else{
						echo $total_count." total applies";
					}
				?>
			</span>
				<?php 
					if($total_count > 0){
						if($pending_count > 0){
				?>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-question w3-text-blue" style="margin-right: 5px;"></i>
			<span class="w3-text-blue">
				<?php
							if($pending_count == 1){
								echo "1 apply need your respond";
							}else{
								echo $pending_count." applies need your respond";
							}
				?>
			</span>
				<?php 
						}
				?>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-check w3-text-teal" style="margin-right: 5px;"></i>
			<span class="w3-text-teal">
				<?php
						if($accepted_count == 0){
							echo "no one accepted";
						}else if($accepted_count == 1){
							echo "1 accepted apply";
						}else{
							echo $accepted_count." accepted applies";
						}
				?>
			</span>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-check w3-text-red" style="margin-right: 5px;"></i>
			<span class="w3-text-red">
				<?php
						if($rejected_count == 0){
							echo "no one rejected";
						}else if($rejected_count == 1){
							echo "1 rejected apply";
						}else{
							echo $rejected_count." rejected applies";
						}
				?>
			</span>
				<?php
					}
				?>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-clock-o" style="margin-right: 5px;"></i>
			<span>
			<?php 
				$now = new DateTime("now");
				$then = new DateTime($row["tanggal_tutup"]);
				$interval = $now->diff($then);
				echo $interval->format("%a days remaining");
			?>
			</span>
		</p>
		<a href=<?php echo "\"./job_detail.php?id=".$row["id_lowongan"]."\""; ?> ><button class="w3-btn w3-purple">View job</button></a>
	</div>
	<?php
			}
		}else{
	?>
	<hr>
	<div class="w3-container w3-padding-hor-16">
		<span class="w3-large w3-text-teal">You have no active job listing at the moment.</span>
	</div>
	<?php
		}
	?>
</div>

<div class="w3-container w3-section w3-padding-hor-16 w3-card-2 w3-white">
	<h3 class="w3-center">All Job</h3>
	<?php 
		$sql = ("SELECT id_lowongan, posisi FROM lowongan WHERE id_pegawai = :username ORDER BY tanggal_buka DESC");
		$params = array(":username" => getUsername());
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		if($res = $sth->fetchAll()){
			foreach ($res as $row) {
				$sql = ("SELECT la.status status, count(la.status) count FROM lowongan lo INNER JOIN lamaran la ON lo.id_lowongan = la.id_lowongan WHERE lo.id_lowongan = :id_lowongan GROUP BY la.status ORDER BY la.status ASC");
				$params = array(":id_lowongan" => $row["id_lowongan"]);
				$sth = $dbh->prepare($sql);
				$sth->execute($params);

				unset($pending_count);
				unset($accepted_count);
				unset($rejected_count);

				if($res2 = $sth->fetchAll()){
					foreach ($res2 as $row2) {
						if($row2["status"] === "pending"){
							$pending_count = $row2["count"];
						}else if($row2["status"] === "accepted"){
							$accepted_count = $row2["count"];
						}else if($row2["status"] === "rejected"){
							$rejected_count = $row2["count"];
						}
					}
				}
				if(!isset($pending_count)){
					$pending_count = 0;
				}
				if(!isset($accepted_count)){
					$accepted_count = 0;
				}
				if(!isset($rejected_count)){
					$rejected_count = 0;
				}
				$total_count = $pending_count + $accepted_count + $rejected_count;
	?>
	<hr>
	<div class="w3-container w3-padding-hor-16 w3-hover-light-grey">
		<span class="w3-large"><?php echo $row["posisi"]; ?></span>
		<p>
			<i class="fa fa-user" style="margin-right: 5px;"></i>
			<span>
				<?php
					if($total_count == 0){
						echo "no one applied";
					}else if($total_count == 1){
						echo "1 total apply";
					}else{
						echo $total_count." total applies";
					}
				?>
			</span>
				<?php 
					if($total_count > 0){
						if($pending_count > 0){
				?>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-question w3-text-blue" style="margin-right: 5px;"></i>
			<span class="w3-text-blue">
				<?php
							if($pending_count == 1){
								echo "1 apply need your respond";
							}else{
								echo $pending_count." applies need your respond";
							}
				?>
			</span>
				<?php 
						}
				?>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-check w3-text-teal" style="margin-right: 5px;"></i>
			<span class="w3-text-teal">
				<?php
						if($accepted_count == 0){
							echo "no one accepted";
						}else if($accepted_count == 1){
							echo "1 accepted apply";
						}else{
							echo $accepted_count." accepted applies";
						}
				?>
			</span>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-check w3-text-red" style="margin-right: 5px;"></i>
			<span class="w3-text-red">
				<?php
						if($rejected_count == 0){
							echo "no one rejected";
						}else if($rejected_count == 1){
							echo "1 rejected apply";
						}else{
							echo $rejected_count." rejected applies";
						}
				?>
			</span>
				<?php
					}
				?>
		</p>
		<a href=<?php echo "\"./job_detail.php?id=".$row["id_lowongan"]."\""; ?> ><button class="w3-btn w3-purple">View job</button></a>
	</div>
	<?php
			}
		}else{
	?>
	<hr>
	<div class="w3-container w3-padding-hor-16">
		<span class="w3-large w3-text-teal">List your first job here.</span>
	</div>
	<?php
		}
	?>
</div>