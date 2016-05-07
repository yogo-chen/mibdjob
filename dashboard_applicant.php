<?php include_once "./server.php";?>
<div class="w3-container w3-section w3-padding-hor-16 w3-card-2 w3-white">
	<h3 class="w3-center">All Submission</h3>
	<?php
		$sql = ("SELECT la.status status, lo.id_lowongan id_lowongan, lo.posisi posisi, lo.gaji gaji, p.id_perusahaan id_perusahaan, p.nama nama_perusahaan FROM lamaran la INNER JOIN lowongan lo ON la.id_lowongan = lo.id_lowongan INNER JOIN perusahaan p ON lo.id_perusahaan = p.id_perusahaan WHERE la.id_pelamar = :username ORDER BY la.tanggal_daftar DESC");
		$params = array(":username" => getUsername());
		$sth = $dbh->prepare($sql);
		$sth->execute($params);
		if($res = $sth->fetchAll()){
			foreach ($res as $row) {
	?>
	<hr>
	<div class="w3-container w3-padding-hor-16 w3-hover-light-grey">
		<span class="w3-large"><?php echo $row["posisi"]; ?></span>
		<p>
			<i class="fa fa-group"></i>
			<a href=""><?php echo $row["nama_perusahaan"]; ?></a>
			<span class="w3-padding-ver-8">|</span>
			<i class="fa fa-dollar w3-text-teal"></i>
			<span class="w3-text-teal"><?php echo "IDR ".number_format($row["gaji"]); ?></span>
		</p>
		<a href=<?php echo "\"job_detail.php?id=".$row["id_lowongan"]."\"" ?>><button class="w3-btn w3-purple">View job</button></a>
	</div>
	<?php
			}
		}else{
	?>
	<hr>
	<div class="w3-container w3-padding-hor-16">
		<span class="w3-large w3-text-teal">You don't have any submission.</span>
	</div>
	<?php
		}
	?>
</div>