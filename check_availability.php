<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : You did not enter a valid email.";
	}
	else {
	$sql = "SELECT email FROM member WHERE email='$email'";
	$query = mysqli_query($koneksidb,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<span style='color:red'> Email sudah terdaftar.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> Email bisa untuk mendaftar.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
	}
}

?>
