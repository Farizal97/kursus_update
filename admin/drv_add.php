<?php
include('includes/config.php');
error_reporting(0);
$nama = $_POST["nama"];
$telp = $_POST["telp"];
$alamat = $_POST["alamat"];

$sql 	= "INSERT INTO driver (nama_driver,telp_driver,alamat_driver)VALUES ('$nama','$telp','$alamat')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'driver.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'drv_tambah.php'; 
		</script>";
}
?>