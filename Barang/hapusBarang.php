<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

if(isset($_GET['kodebrg'])){
    $kodebrg = $_GET['kodebrg'];
    $sql = "DELETE FROM barang WHERE kdbarang = '$kodebrg'";
    $result = mysqli_query($koneksi, $sql);
    if($result){
        header("Location: barang.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
