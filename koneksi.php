<?php
$db = "dbManagement";
$user = "root";
$host = "localhost";
$pw = "";
$koneksi = mysqli_connect("$host", "$user","$pw");
if(!$koneksi){
    die("Gagal Terhubung");
}

if(mysqli_select_db($koneksi, $db)){
} else{
    die ("Database Tidak ditemukan di server");
} ?>