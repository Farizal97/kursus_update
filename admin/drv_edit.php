<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){
	header('location:index.php');
}else{
if(isset($_POST['update'])){
	$id=$_POST['id'];
	$nama=$_POST['nama'];
	$telp=$_POST['telp'];
	$alamat=$_POST['alamat'];
	$sql="UPDATE driver SET nama_driver='$nama', telp_driver='$telp', alamat_driver='$alamat' WHERE id_driver='$id'";
	$query	= mysqli_query($koneksidb, $sql);
	echo "<script type='text/javascript'>
			alert('Berhasil update data.');
			document.location = 'driver.php'; 
		</script>";
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
					
						<h2 class="page-title">Ubah Data Driver</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading"></div>
									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
										<?php
										$id=$_GET['id'];
										$sql ="SELECT * FROM driver WHERE id_driver='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										?>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Driver<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="nama" class="form-control" value="<?php echo $result['nama_driver'];?>" required>
												<input type="hidden" name="id" class="form-control" value="<?php echo $result['id_driver'];?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Telepon<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="number" name="telp" class="form-control" value="<?php echo $result['telp_driver'];?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Alamat<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<textarea class="form-control" name="alamat" rows="3" required><?php echo $result['alamat_driver'];?></textarea>
											</div>
										</div>
										<div class="hr-dashed"></div>											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
													<button class="btn btn-primary" name="update" type="submit">Update</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							
						</div>
						
					</div>
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