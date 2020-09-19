<?php
include('includes/config.php');
error_reporting(0);
$adm = $_POST['adm'];
$nama=$_POST['nama'];
$ket=$_POST['keterangan'];
$harga=$_POST['harga'];
$temu=$_POST['ketemu'];
$jam=$_POST['jam'];
$jns=$_POST['jns'];
$img1=$_FILES["img1"]["name"];
$str1 = substr($img1,-5);
$vimage1 = date('dmYHis').$str1;

$sql 	= "INSERT INTO paket (nama_paket,jns_mobil,harga,jml_latihan,jml_jam,ket_paket,foto_paket,id)VALUES ('$nama','$jns','$harga','$temu','$jam','$ket','$vimage1','$adm')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	move_uploaded_file($_FILES["img1"]["tmp_name"],"gallery/".$vimage1);
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'paket.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'paket_tambah.php'; 
		</script>";
}
?>