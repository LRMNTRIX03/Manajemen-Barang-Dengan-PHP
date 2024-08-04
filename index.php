<?php
session_start();
if(!isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
}
include 'koneksi.php';
$sql = "SELECT count(*) as hitung from barang";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <!--Navbar and Sidebar Start-->
    <section class="nav-container">
        <h1>Web Inventory Lutfi</h1>
    </section>
    <section class="main-content">
        <nav class="nav-side">
            <ul>
                <a href="index.php" class="side-item"><li >Dashboard</li></a>
                <a href="Barang/barang.php" class="side-item"><li >Barang</li></a>
                <a href="Merek/merek.php" class="side-item"><li >Merek</li></a>
                <a href="Kategori/kategori.php" class="side-item"><li >Kategori</li></a>
            </ul>
            <form action="logout.php" method="post">
            <div class="logout-container">
                <input type="submit" class="logout-button" name="logout" value="Logout">
            </div>
            </form>
        </nav>

        <div class="content-container">
            <div class="dashboard">
                <?php while($result = mysqli_fetch_assoc($hasil)) : ?>
                <p>Jumlah Barang:</p>
                <div class="jml-barang"><?php echo $result['hitung']?></div>
                <p>Stok Barang:</p>
                <div class="jml-stokbarang">0</div>
            <?php endwhile ?>
            </div>
        </div>
    </section>
    <!--Navbar and Sidebar End-->
</body>
</html>
