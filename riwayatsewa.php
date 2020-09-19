<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title><?php echo $pagedesc;?></title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="admin/img/fav.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>

<?php
$email=$_SESSION['ulogin'];  
$sql1 	= "SELECT transaksi.*, paket.*, member.* FROM transaksi, paket, member WHERE transaksi.id_paket=paket.id_paket 
			AND transaksi.email=member.email AND transaksi.email='$email'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$durasi = $result['durasi'];
$totalsewa = $durasi*$harga;
$tglmulai = strtotime($result['tgl_mulai']);
$jmlhari  = 86400*1;
$tgl	  = $tglmulai-$jmlhari;
$tglhasil = date("Y-m-d",$tgl);
?>
<section class="user_profile inner_pages">
<center><h3>Riwayat Booking</h3></center>
	<div class="container">
	<div class = "table-responsive">
	<table class="table table-striped table-bordered">
	<thead>
		<tr>    
			<th width="5" align="center">No</th>
			<th width="10">Kode Booking</th>		
			<th width="20">Paket</th>
			<th width="10">Tgl. Trx</th>
			<th width="10">Tgl. Mulai</th>
			<th width="5">Jam</th>
			<th width="10">Biaya</th>
			<th width="10">Status</th>
			<th width="5">Opsi</th>
		</tr>
	</thead>
	<?php
	$email=$_SESSION['ulogin'];  
	$sql1 	= "SELECT transaksi.*, paket.*, member.* FROM transaksi, paket, member WHERE transaksi.id_paket=paket.id_paket 
			   AND transaksi.email=member.email AND transaksi.email='$email' ORDER BY transaksi.tgl_trx DESC";
	$query1 = mysqli_query($koneksidb,$sql1);
	if(mysqli_num_rows($query1)!=0){
		while($result = mysqli_fetch_array($query1)){
			$harga	= $result['harga'];
			$tglmulai = strtotime($result['tgl_take']);
			$jmlhari  = 86400*1;
			$tgl	  = $tglmulai-$jmlhari;
			$tglhasil = date("Y-m-d",$tgl);
			$nomor++;
		?>
			<tr>
				<td align="center"><?php echo $nomor; ?></td>
				<td><?php echo $result['id_trx']; ?></td>
				<td><?php echo $result['nama_paket']; ?></td>
				<td><?php echo IndonesiaTgl($result['tgl_trx']); ?></td>
				<td><?php echo IndonesiaTgl($result['tgl_mulai']); ?></td>
				<td><?php echo $result['jam']; ?></td>
				<td><?php echo format_rupiah($result['harga']); ?></td>
				<td><?php echo $result['stt_trx']; ?></td>
				<td align="center">
				<?php 
					if($result['stt_trx']=="Sudah Dibayar"||$result['stt_trx']=="Selesai"){
					?>
					<a href="booking_detail.php?kode=<?php echo $result['id_trx'];?>" class="btn btn-warning btn-xs">Detail</a>
					<?php 
						if($result['ubah_tgl']==0){
					?>
						<a href="booking_tgl.php?kode=<?php echo $result['id_trx'];?>" class="btn btn-primary btn-xs">Ubah Tanggal</a>
					<?php
						}else{
						}
					}else{
					?>
					<a href="booking_detail.php?kode=<?php echo $result['id_trx'];?>" class="btn btn-warning btn-xs">Detail</a>
					<a href="booking_edit.php?kode=<?php echo $result['id_trx'];?>" class="btn btn-primary btn-xs">Upload Bukti</a>
					<?php }?>
				</td>
			</tr>
		<?php } ?>
		
	<?php
	}else{
	?>
		<tr>
			<td colspan="11" align="center"><b>Belum ada riwayat booking.</b></td>
		</tr>
<?php }?>
	</table>
	</div>
</div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>