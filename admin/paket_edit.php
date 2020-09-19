<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}else{ 
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
<script type="text/javascript">
function valid(theform){
		pola_nama=/^[a-zA-Z]*$/;
		if (!pola_nama.test(theform.vehicletitle.value)){
		alert ('Hanya huruf yang diperbolehkan untuk Nama Baju!');
		theform.vehicletitle.focus();
		return false;
		}
		return (true);
}
</script>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Edit Data Baju</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Edit Data Baju</div>
									<div class="panel-body">
										<?php 
										$id=intval($_GET['id']);
										$sql ="SELECT * FROM paket WHERE id_paket='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										?>

										<form method="post" class="form-horizontal" name="theform" action ="paket_upd.php" onsubmit="return valid(this);" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Paket<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>" required>
												<input type="text" name="nama" class="form-control" value="<?php echo htmlentities($result['nama_paket']);?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Deskripsi<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<textarea class="form-control" name="deskripsi" rows="3" required><?php echo htmlentities($result['ket_paket']);?></textarea>
											</div>
										</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Mobil<span style="color:red">*</span></label>
										<div class="col-sm-4">
											<select id="jns" name="jns" class="form-control" onChange="changetextbox();" required>
												<option value="<?php echo $result['jns_mobil'];?>" selected><?php echo $result['jns_mobil'];?></option>
												<option value="Matic" >Matic</option>
												<option value="Manual" >Manual</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Harga /Packs<span style="color:red">*</span></label>
										<div class="col-sm-4">
											<input type="number" min="0" name="harga" class="form-control" value="<?php echo $result['harga'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Jumlah Pertemuan<span style="color:red">*</span></label>
										<div class="col-sm-4">
											<input type="number" min="0" name="ketemu" class="form-control" value="<?php echo $result['jml_latihan'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Jam/Pertemuan<span style="color:red">*</span></label>
										<div class="col-sm-4">
											<input type="number" min="0" name="jam" class="form-control" value="<?php echo $result['jml_jam'];?>" required>
										</div>
									</div>
										
									<div class="form-group">
										<div class="col-sm-4">
											<center>Gambar Paket<img src="gallery/<?php echo htmlentities($result['foto_paket']);?>" width="300" height="200" style="border:solid 1px #000">
											<br/>
											<br/>
											<a href="gambar_paket.php?imgid=<?php echo htmlentities($result['id_paket'])?>" class="btn btn-warning">&nbsp;&nbsp;Ganti Gambar&nbsp;&nbsp;</a></center>
										</div>
									</div>
									<div class="hr-dashed"></div>									
										
									</div>
								</div>
							</div>
						</div>
						
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<div class="col-sm-3">
											<div class="checkbox checkbox-inline">
												<button class="btn btn-primary" type="submit">Update</button>
												<a href="paket.php" class="btn btn-default">Batal</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					</div>
				</div>
				</form>

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