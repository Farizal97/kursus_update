<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 20px;"><img src="img/Citycons_car_icon-icons.com_67916.png" width="50px" height="50px"></a>
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
	<ul class="ts-profile-nav">
		<?php
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM admin WHERE id='$id'";
		$query = mysqli_query($koneksidb, $sql);
		$result = mysqli_fetch_array($query);
		$nama = $result['name'];
		$img = $result['Image'];
		?>
		<li class="ts-account">
			<a href="#">
				<img src="img/<?php echo $img; ?>" width="20px" height="20px" padding="0px">&nbsp;
				<?php echo $nama; ?>
				<span class="fa fa-angle-down"></span>
			</a>
			<ul>
				<li><a href="change-password.php"><i class="fa fa-key pull-right"></i>Ganti Password</a></li>
				<li><a href="profile.php"><i class="fa fa-user pull-right"></i>Profil</a></li>
				<li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i>Keluar</a></li>
			</ul>
		</li>
	</ul>
</div>