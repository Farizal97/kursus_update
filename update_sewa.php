<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/library.php');

		$image1=$_FILES["img1"]["name"];
		$newimg1 = date('dmYHis').$image1;
		$kode = $_POST['kode'];
		$stt = "Menunggu Konfirmasi";
		$tgl = date('Y-m-d');

		move_uploaded_file($_FILES["img1"]["tmp_name"],"image/bukti/".$newimg1);

		$sql="UPDATE transaksi SET bukti_bayar='$newimg1', stt_trx='$stt', tgl_bayar='$tgl' WHERE id_trx='$kode'";
		$lastInsertId = mysqli_query($koneksidb, $sql);
		if($lastInsertId){
			$sql1="UPDATE tmp_trx SET status='$stt' WHERE id_trx='$kode'";
			$lastInsertId1 = mysqli_query($koneksidb, $sql1);
			echo "<script>alert('Upload Bukti Pembayaran Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
		}else {
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'bookingedit.php?kode'".$kode."'; </script>";
		}
?>