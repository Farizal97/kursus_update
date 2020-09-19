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
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
<script type="text/javascript">
function valid(theform){
		pola_nama=/^[a-zA-Z]*$/;
		if (!pola_nama.test(theform.vehicletitle.value)){
		alert ('Hanya huruf yang diperbolehkan untuk Nama Mobil!');
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
					
						<h2 class="page-title">Edit Member</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Edit Member</div>
									<div class="panel-body">
										<?php 
										$email=$_GET['email'];
										$sql ="SELECT * FROM users WHERE email='$email'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										?>
										<form method="post" class="form-horizontal" name="theform" action ="usereditact.php" onsubmit="return valid(this);" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama User<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="hidden" name="email" class="form-control" value="<?php echo $email;?>" required>
												<input type="text" name="nama" class="form-control" value="<?php echo htmlentities($result['nama_user']);?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Telepon<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="number" name="telp" min="0" class="form-control" value="<?php echo htmlentities($result['telp']);?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="email" class="form-control" value="<?php echo htmlentities($result['email']);?>" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Alamat<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<textarea class="form-control" name="alamat" rows="5" required><?php echo htmlentities($result['alamat']);?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">KTP<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<img src="../image/id/<?php echo htmlentities($result['ktp']);?>" width="300" height="200" style="border:solid 1px #000">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">KK<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<img src="../image/id/<?php echo htmlentities($result['kk']);?>" width="300" height="200" style="border:solid 1px #000">
											</div>
										</div>
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
												<button class="btn btn-primary" type="submit" style="margin-top:4%">Save changes</button>
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