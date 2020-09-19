<?php
include('includes/config.php');
$id		= $_POST['id'];
$jenis	= $_POST['jenis'];
$sql 	= "UPDATE jenis SET nama_jenis='$jenis' WHERE id_jenis='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil edit data.'); 
			document.location = 'jenis.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'jenis_edit.php?id=$id'; 
		</script>";

}
?>