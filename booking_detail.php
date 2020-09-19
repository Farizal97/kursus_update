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
$kode=$_GET['kode'];
$sql1 	= "SELECT transaksi.*,member.*,paket.* FROM transaksi, member, paket WHERE transaksi.email=member.email
		   AND transaksi.id_paket=paket.id_paket AND transaksi.id_trx='$kode'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$tglmulai = strtotime($result['tgl_mulai']);
$jmlhari  = 86400*1;
$tgl	  = $tglmulai-$jmlhari;
$tglhasil = date("Y-m-d",$tgl);
?>
<section class="user_profile inner_pages">
			<center><h3>Detail Booking</h3></center>
	<div class="container">
	<div class="user_profile_info">	
		<div class="col-md-12 col-sm-10">
        <form method="post" name="sewa" onSubmit="return valid();"> 
            <div class="form-group">
			<label>Kode Booking</label>
				<input type="text" class="form-control" name="id" value="<?php echo $result['id_trx'];?>"readonly>
            </div>
            <div class="form-group">
			<label>Paket</label>
				<input type="text" class="form-control" name="mobil" value="<?php echo $result['nama_paket'];?>"readonly>
            </div>
            <div class="form-group">
			<label>Jumlah Pertemuan</label>
				<input type="text" class="form-control" name="mobil" value="<?php echo $result['jml_latihan'];?>"readonly>
            </div>
            <div class="form-group">
			<label>Tanggal Mulai</label>
				<input type="text" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" value="<?php echo IndonesiaTgl($result['tgl_mulai']);?>"readonly>
            </div>
            <div class="form-group">
			<label>Tanggal Selesai</label>
				<input type="text" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" value="<?php echo IndonesiaTgl($result['tgl_selesai']);?>"readonly>
            </div>
            <div class="form-group">
			<label>Jam</label>
				<input type="text" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" value="<?php echo $result['jam'];?>"readonly>
            </div>
            <div class="form-group">
			<label>Biaya</label><br/>
				<input type="text" class="form-control" name="total" value="<?php echo format_rupiah($result['harga']);?>"readonly>
            </div>
            <div class="form-group">
			<label>Catatan</label><br/>
				<textarea class="form-control" readonly><?php echo $result['catatan'];?></textarea>
            </div>
			<?php if($result['stt_trx']=="Menunggu Pembayaran"){
				$sqlrek 	= "SELECT * FROM tblpages WHERE id='5'";
				$queryrek = mysqli_query($koneksidb,$sqlrek);
				$resultrek = mysqli_fetch_array($queryrek);
				?>
			<b>*Silahkan transfer total pembayaran ke <?php echo $resultrek['detail'];?> maksimal tanggal <?php echo IndonesiaTgl($tglhasil);?>.
			<?php
			}else{
				
			}?>
			</b>
			<br/><br/>			
			<div class="form-group">
				<a href="detail_cetak.php?kode=<?php echo $kode;?>" target="_blank" class="btn btn-primary btn-xs">Cetak</a>
			</div>
        </form>
		</div>
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