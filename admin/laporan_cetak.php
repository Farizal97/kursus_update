<?php
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
$stt	 = "Sudah Dibayar";
$stt1	 = "Selesai";
$sqlsewa = "SELECT * FROM transaksi WHERE stt_trx='$stt' OR stt_trx='$stt1' AND tgl_bayar BETWEEN '$awal' AND '$akhir'";
$querysewa = mysqli_query($koneksidb, $sqlsewa);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="rental mobil">
	<meta name="author" content="">

	<title><?php echo $pagedesc; ?></title>

	<link href="img/fav.png" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="../assets/new/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../assets/new/offline-font.css" rel="stylesheet">
	<link href="../assets/new/custom-report.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../assets/new/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- jQuery -->
	<script src="../assets/new/jquery.min.js"></script>

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
							<img src="img/Citycons_car_icon-icons.com_67916.png" alt="logo-dkm" width="80" />
						</td>
						<td class="text-center">
							<h3>Kursus-mobilku.com</h3>
						</td>
						<td rowspan="3" width="16%">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center">Phone : +62 823-2275-3411 | E-mail : ask@kursus-mobilku.com</td>
					</tr>
					<tr>
						<td class="text-center">Jakarta</td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h4 class="text-center">Detail Laporan</h4>
			<h5 class="text-center">Tanggal <?php echo IndonesiaTgl($awal) . " s/d " . IndonesiaTgl($akhir); ?></h5>
			<br />
			<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Booking</th>
						<th>Tanggal Booking</th>
						<th>Tanggal Bayar</th>
						<th>Total Bayar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$pemasukan = 0;
					while ($result = mysqli_fetch_array($querysewa)) {
						$paket = $result['id_paket'];
						$sqlpaket = "SELECT * FROM paket WHERE id_paket='$paket'";
						$querypaket = mysqli_query($koneksidb, $sqlpaket);
						$res = mysqli_fetch_array($querypaket);
						$pemasukan += $res['harga'];
						$no++;
						?>
						<tr align="center">
							<td><?php echo $no; ?></td>
							<td><?php echo htmlentities($result['id_trx']); ?></td>
							<td><?php echo IndonesiaTgl(htmlentities($result['tgl_trx'])); ?></td>
							<td><?php echo IndonesiaTgl(htmlentities($result['tgl_bayar'])); ?></td>
							<td><?php echo format_rupiah($res['harga']); ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<?php
					echo '<tr>';
					echo '<th colspan="4" class="text-center">Total Pemasukan</th>';
					echo '<th class="text-center">' . format_rupiah($pemasukan) . '</th>';
					echo '</tr>';
					?>
				</tfoot>
			</table>


		</div><!-- /.container -->
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#jumlah').terbilang({
				'style': 3,
				'output_div': "jumlah2",
				'akhiran': "Rupiah",
			});

			window.print();
		});
	</script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../assets/new/bootstrap.min.js"></script>
	<!-- jTebilang JavaScript -->
	<script src="../assets/new/jTerbilang.js"></script>

</body>

</html>