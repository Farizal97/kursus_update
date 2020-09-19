<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/library.php');

		$kode = $_POST['kode'];
		$tgl = $_POST['tglbaru'];
		$jam = $_POST['jam'];
		$stt = $_POST['stt'];
		$tm = $_POST['tm'];
		$newtm = $tm-1;
		$no ="1";
		$cek=0;

		$mulai = strtotime($tgl);
		$hari  = 86400*$newtm;
		$plus  = $mulai+$hari;
		$selesai = date("Y-m-d",$plus);
		
		$sql="UPDATE transaksi SET tgl_mulai='$tgl', tgl_selesai='$selesai', jam='$jam', ubah_tgl='$no' WHERE id_trx='$kode'";
		$lastInsertId = mysqli_query($koneksidb, $sql);
		if($lastInsertId){
			$sqldel	="DELETE FROM tmp_trx WHERE id_trx='$kode'";
			$querydel = mysqli_query($koneksidb,$sqldel);
			
			for($cek;$cek<$tm;$cek++){
				$start = strtotime($tgl);
				$jmlhari  = 86400*$cek;
				$tglnew	  = $start+$jmlhari;
				$reslt = date("Y-m-d",$tglnew);
				$sql1	="INSERT INTO tmp_trx (id_trx,tanggal,status)VALUES('$kode','$reslt','$stt')";
				$query1 = mysqli_query($koneksidb,$sql1);
			}
			echo "<script>alert('Ubah tanggal berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
		}else {
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'booking_tgl.php?kode'".$kode."'; </script>";
		}
?>