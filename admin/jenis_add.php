<?php
include('includes/config.php');
$jenis	= $_POST['jenis'];
$sql 	= "INSERT INTO jenis (nama_jenis) VALUES ('$jenis')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'jenis.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'jenis_tambah.php'; 
		</script>";

}
?>