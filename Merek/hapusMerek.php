<?php
session_start();
if(!isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
}
include '../koneksi.php';
if(isset($_GET['kodemrk'])){
	$kodemrk = $_GET['kodemrk'];
	$sql = "DELETE FROM merek where kdmerek = '$kodemrk'";
	$result = mysqli_query($koneksi, $sql);

	if($result){
		echo "<script>alert('Data Sudah Dihapus');</script>";
		header("Location: merek.php");
	}
	else{
		echo "Error : ". mysqli_error($koneksi);
	}
}
?>