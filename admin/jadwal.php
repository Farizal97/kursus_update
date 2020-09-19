<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');}
else{
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

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Jadwal Hari Ini</h2>
						
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Daftar Jadwal Kursus Hari Ini</div>
							<div class="panel-body">
							<div class = "table-responsive">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr align="center">
										<th>No</th>
										<th>Kode Booking</th>
										<th>Paket </th>
										<th>Jam</th>
										<th>Member</th>
										<th>Driver </th>
										<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i=0;
										$now = date('Y-m-d');
										$sqlsewa = "SELECT transaksi.*,paket.*,member.*, driver.*, tmp_trx.* FROM transaksi, paket, member, driver, tmp_trx 
													WHERE transaksi.id_paket=paket.id_paket AND transaksi.email=member.email 
													AND transaksi.id_driver=driver.id_driver AND transaksi.id_trx=tmp_trx.id_trx
													AND tmp_trx.status='Sudah Dibayar' AND tmp_trx.tanggal='$now' ORDER BY transaksi.jam ASC";
										$querysewa = mysqli_query($koneksidb,$sqlsewa);
										while ($result = mysqli_fetch_array($querysewa)) {
											$i++;
											?>
										<tr align="center">
											<td><?php echo $i;?></td>
											<td><?php echo htmlentities($result['id_trx']);?></td>
											<td><a href="#myModal" data-toggle="modal" data-load-cd="<?php echo $result['id_paket']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_paket']; ?></a></td>
											<td><?php echo htmlentities($result['jam']);?></td>
											<td><a href="#myModal" data-toggle="modal" data-load-id="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_user']; ?></a></td>
											<td><a href="#myModal" data-toggle="modal" data-load-drv="<?php echo $result['id_driver']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_driver']; ?></a></td>
											<td>
											<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['id_trx']; ?>" data-remote-target="#myModal .modal-body"><span class="glyphicon glyphicon-eye-open"></span></a></td>
										</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
	<!-- Large modal -->
	<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<p>One fine body…</p>
				</div>
			</div>
		</div>
	</div>    
	<!-- Large modal --> 

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
	<script>
		var app = {
			code: '0'
		};
		$('[data-load-cd]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-cd');
					if(code) {
						$($this.data('remote-target')).load('paket_view.php?code='+code);
						app.code = code;
					}
		});
		$('[data-load-drv]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-drv');
					if(code) {
						$($this.data('remote-target')).load('drv_view.php?code='+code);
						app.code = code;
					}
		});
		$('[data-load-code]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-code');
					if(code) {
						$($this.data('remote-target')).load('trx_view.php?code='+code);
						app.code = code;
					}
		});
		$('[data-load-id]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-id');
					if(code) {
						$($this.data('remote-target')).load('userview.php?code='+code);
						app.code = code;
						
					}
		});
    </script>
</body>
</html>
<?php } ?>