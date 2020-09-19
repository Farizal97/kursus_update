<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
if($_GET) {
	$Kode = $_GET['code'];
	$mySql ="SELECT * FROM paket WHERE id_paket ='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$result = mysqli_fetch_array($myQry);
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
	<h2>Detail Paket</h2>
</div>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
	<h4 class="modal-title" id="myModalLabel">Detail Paket</h4>
</div>
<div><br/></div>
<form id="theform" data-parsley-validate class="form-horizontal form-label-left" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Paket</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['nama_paket'];?>" readonly>
			</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Harga</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo format_rupiah($result['harga']);?>" readonly>
			</div>
	</div>	
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Jumlah Pertemuan</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['jml_latihan'];?>" readonly>
			</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Keterangan Paket</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<textarea required="required" class="form-control col-md-7 col-xs-12" cols="5" name="alamat" data-parsley-error-message="Field ini harus diisi" readonly><?php echo $result['ket_paket'];?></textarea>
			</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Foto Paket</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<img src="gallery/<?php echo $result['foto_paket'];?>" width="150px">
			</div>
	</div>
	</form>
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>

</div>

</body>
</html>