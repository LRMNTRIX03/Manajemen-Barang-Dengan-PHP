<?php
session_start();
if(!isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
}
include '../koneksi.php';

if(isset($_GET['kodektg'])){
	$kodektg = $_GET['kodektg'];
	$sql = "DELETE FROM kategori WHERE kdkategori = '$kodektg'";
	$result = mysqli_query($koneksi, $sql);
	if($result){
		header("Location: kategori.php");
		exit;
	}
	else{
		echo "Tedapat Error : ". mysqli_error($koneksi);
	}
}

?>