<?php
include('includes/config.php');
error_reporting(0);
$id=$_GET['id'];
$stt="Selesai";

$sql 	= "UPDATE transaksi SET stt_trx='$stt' WHERE id_trx='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Transaksi berhasil diselesaikan.'); 
			document.location = 'jadwal.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'jadwal.php'; 
		</script>";
}
?>