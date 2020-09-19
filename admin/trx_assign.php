<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}else{
	if(isset($_POST['submit'])){
		$drv = $_POST['drv'];
		$kode = $_POST['id'];
		$null="";
			$mySql	= "UPDATE transaksi SET id_driver = '$drv' WHERE id_trx='$kode'";
			$myQry	= mysqli_query($koneksidb, $mySql);
		echo "<script type='text/javascript'>
				alert('Driver berhasil diassign!'); 
				document.location = 'trx_drv.php'; 
			</script>";
	}else{
	}
	

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title><?php echo $pagedesc;?></title>
	<link rel="shortcut icon" href="img/fav.png">

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
</head>


<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>

		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Cek Pembayaran</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Info Member</div>
									<div class="panel-body">
										<?php 
										$id=$_GET['id'];
										$sqlsewa = "SELECT transaksi.*,paket.*,member.* FROM transaksi,paket,member WHERE transaksi.id_paket=paket.id_paket
													AND transaksi.email=member.email AND transaksi.id_trx ='$id'";
										$querysewa = mysqli_query($koneksidb,$sqlsewa);
										$result = mysqli_fetch_array($querysewa);
										?>

										<form method="POST" class="form-horizontal" name="cuti" enctype="multipart/form-data" onSubmit="return valid();">
										<div class="form-group">
											<label class="col-sm-2 control-label">Kode Booking</label>
											<div class="col-sm-4">
												<input type="text" name="id" class="form-control" value="<?php echo $id;?>" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Driver<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<select id="drv" name="drv" class="form-control" required>
												<option value="" selected>======== Pilih Driver ========</option>
												<?php
													$mySql = "SELECT * FROM driver ORDER BY nama_driver ASC";
													$myQry = mysqli_query($koneksidb, $mySql);
													$dataLeader = $result['id_driver'];
													while ($leaderData = mysqli_fetch_array($myQry)) {
														if ($leaderData['id_driver']== $dataLeader) {
														$cek = " selected";
														} else { $cek=""; }
														echo "<option value='$leaderData[id_driver]' $cek>".$leaderData[nama_driver]."</option>";
													}
												?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Member</label>
											<div class="col-sm-4">
												<input type="text" name="penyewa" class="form-control" value="<?php echo $result['nama_user'];?>" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Telepon</label>
											<div class="col-sm-4">
												<input type="text" name="telp" class="form-control" value="<?php echo $result['telp'];?>" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Status</label>
											<div class="col-sm-4">
												<input type="text" name="stt" class="form-control" value="<?php echo $result['stt_trx'];?>" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Alamat</label>
											<div class="col-sm-4">
												<textarea col="5" name="alamat" class="form-control" readonly><?php echo $result['alamat'];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Bukti Bayar</label>
											<div class="col-sm-4">
												<a href="../image/bukti/<?php echo $result['bukti_bayar'];?>" target="_blank"><img src="../image/bukti/<?php echo $result['bukti_bayar'];?>" width="150" height="150"></a>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-3">
												<div class="checkbox checkbox-inline">
													<button class="btn btn-primary" type="submit" name="submit" style="margin-top:4%">Simpan</button>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Detail Booking</div>
										<div class="panel-body">
										<form class="form-horizontal">
											<div class="form-group">
												<label class="col-sm-2 control-label">Paket</label>
												<div class="col-sm-4">
													<input type="text" name="namamobil" class="form-control" value="<?php echo $result['nama_paket'];?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Tanggal Mulai</label>
												<div class="col-sm-4">
													<input type="text" name="mulai" class="form-control" value="<?php echo IndonesiaTgl($result['tgl_mulai']);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Tanggal Selesai</label>
												<div class="col-sm-4">
													<input type="text" name="mulai" class="form-control" value="<?php echo IndonesiaTgl($result['tgl_selesai']);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Jam</label>
												<div class="col-sm-4">
													<input type="text" name="selesai" class="form-control" value="<?php echo $result['jam'];?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Biaya</label>
												<div class="col-sm-4">
													<input type="text" name="total" class="form-control" value="<?php echo format_rupiah($result['harga']);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Catatan</label>
												<div class="col-sm-4">
													<textarea class="form-control" readonly><?php echo $result['catatan'];?></textarea>
												</div>
											</div>
											</form>
									</div>
								</div>
							</div>
						</div>
				
					</div>
				</div>
			<!-- COntainer Fluid-->			
			</div>
		</div>
	</div>
</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>