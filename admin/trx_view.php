<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if($_GET) {
	$Kode = $_GET['code'];
	$sqlsewa = "SELECT transaksi.*,paket.*,member.* FROM transaksi, paket, member WHERE transaksi.id_paket=paket.id_paket
				AND transaksi.email=member.email AND transaksi.id_trx='$Kode'";
	$querysewa = mysqli_query($koneksidb,$sqlsewa);
	$result = mysqli_fetch_array($querysewa);
	$bukti=$result['bukti_bayar'];
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
</head>
<body>
<div id="section-to-print">
<div id="only-on-print">
	<h2>Detail Booking</h2>
</div>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
	<h4 class="modal-title" id="myModalLabel">Detail Booking</h4>
</div>
<div><br/></div>
<table width="100%">
	<tr>
		<td width="20%"><b>Kode Booking</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['id_trx'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Member</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['nama_user'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Paket</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['nama_paket'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tanggal Mulai</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo IndonesiaTgl($result['tgl_mulai']);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tanggal Selesai</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo IndonesiaTgl($result['tgl_selesai']);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Jam</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['jam'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Biaya</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo format_rupiah($result['harga']);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Status</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['stt_trx'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tanggal Bayar</b></td>
		<td width="2%"><b>:</b></td>
		<?php
			if($result['tgl_bayar']=="0000-00-00"){
		?>
			<td width="78%"> - </td>
			<?php
			}else{
			?>
			<td width="78%"><?php echo IndonesiaTgl($result['tgl_bayar']);?></td>
			<?php
			}
			?>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Bukti Pembayaran</b></td>
		<td width="2%"><b>:</b></td>
		<?php
			if($bukti==""){
		?>
			<td width="78%">Belum ada bukti pembayaran.</td>
			<?php
			}else{
			?>
			<td width="78%"><img src="../image/bukti/<?php echo htmlentities($result['bukti_bayar']);?>" width="120" height="150"></td>
			<?php
			}
			?>
	</tr>
</table>
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>

</div>

</body>
</html>