<?php
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="rental mobil">
	<meta name="author" content="">

	<title>Cetak Detail Booking</title>

	<link href="admin/img/fav.png" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="assets/new/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="assets/new/offline-font.css" rel="stylesheet">
	<link href="assets/new/custom-report.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="assets/new/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery -->
	<script src="assets/new/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td rowspan="3" width="16%" class="text-center">
							<img src="admin/img/logo-new.png" alt="logo-dkm" width="80" />
						</td>
						<td class="text-center"><h3>KursusMobil.com</h3></td>
						<td rowspan="3" width="16%">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center">Phone : +62 823-2275-3411 | E-mail : ask@kursus-mobil.com</td>
					</tr>
					<tr>
						<td class="text-center">Bekasi</td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h4 class="text-center">Detail Booking</h4>
			<br />
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td width="23%">Kode Booking</td>
						<td width="2%">:</td>
						<td><?php echo $result['id_trx'];?></td>
					</tr>
					<tr>
						<td>Member</td>
						<td>:</td>
						<td><?php echo $result['nama_user'] ?></td>
					</tr>
					<tr>
						<td>Paket</td>
						<td>:</td>
						<td><?php echo $result['nama_paket'];?></td>
					</tr>
					<tr>
						<td>Jumlah Pertemuan</td>
						<td>:</td>
						<td><?php echo $result['jml_latihan'];?></td>
					</tr>
					<tr>
						<td>Tanggal Mulai</td>
						<td>:</td>
						<td><?php echo IndonesiaTgl($result['tgl_mulai']);?></td>
					</tr>
					<tr>
						<td>Tanggal Selesai</td>
						<td>:</td>
						<td><?php echo IndonesiaTgl($result['tgl_selesai']);?></td>
					</tr>
					<tr>
						<td>Jam</td>
						<td>:</td>
						<td><?php echo $result['jam'];?></td>
					</tr>
					<tr>
						<td>Biaya</td>
						<td>:</td>
						<td><?php echo format_rupiah($result['harga']);?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><?php echo $result['stt_trx'];?></td>
					</tr>
					<tr>
						<td>Catatan</td>
						<td>:</td>
						<td><?php echo $result['catatan'];?></td>
					</tr>
					<?php
						if($result['stt_trx']=="Menunggu Pembayaran"){
							$sqlrek 	= "SELECT * FROM tblpages WHERE id='5'";
							$queryrek = mysqli_query($koneksidb,$sqlrek);
							$resultrek = mysqli_fetch_array($queryrek);

							echo "
						<tr>
							<td colspan='3'>
								<b>*Silahkan transfer total biaya ke ".$resultrek['detail']." maksimal tanggal "?> <?php echo IndonesiaTgl($tglhasil);?> <?php echo ".
							</td>
						</tr>
							";
						}else{
							
						}?>
				</tbody>
			</table>
		</div><!-- /.container -->
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#jumlah').terbilang({
				'style'			: 3, 
				'output_div' 	: "jumlah2",
				'akhiran'		: "Rupiah",
			});

			window.print();
		});
	</script>

	<!-- Bootstrap Core JavaScript -->
	<script src="assets/new/bootstrap.min.js"></script>
	<!-- jTebilang JavaScript -->
	<script src="assets/new/jTerbilang.js"></script>

</body>
</html>