<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$sql = "SELECT * FROM merek";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="merek.css">
    <style>
    .btn-edit{
        padding: 10px;
        color: black;
        border: none;
        background: #00FF00;
        border-radius: 0.325em;
        font-size: 20px;
        cursor: pointer;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    .btn-hapus{
        padding: 10px;
        color: black;
        border: none;
        background: #FF0000;
        border-radius: 0.325em;
        font-size: 20px;
        cursor: pointer;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    .btn-edit:hover{
        opacity: 30%;
        transition: 0.5s;
    }
    .btn-hapus:hover{
        opacity: 30%;
        transition: 0.5s;
    }
    </style>
    <script>
    function confirmDeletion(kodemrk) {
        if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
            window.location.href = 'hapusMerek.php?kodemrk=' + kodemrk;
        }
    }
    </script>
</head>
<body>
    <!--Navbar and Sidebar Start-->
    <section class="nav-container">
        <h1>Web Inventory Lutfi</h1>
    </section>
    <section class="main-content">
        <nav class="nav-side">
            <ul>
                <a href="../index.php" class="side-item"><li>Dashboard</li></a>
                <a href="../Barang/barang.php" class="side-item"><li>Barang</li></a>
                <a href="../Merek/merek.php" class="side-item"><li>Merek</li></a>
                <a href="../Kategori/kategori.php" class="side-item"><li>Kategori</li></a>
            </ul>
            <form action="../logout.php" method="post">
                <div class="logout-container">
                    <input type="submit" class="logout-button" name="logout" value="Logout">
                </div>
            </form>
        </nav>
        <div class="content-container">
            <h2>Daftar Merek</h2>
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Kode Merek</th>
                        <th>Nama Merek</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($hasil = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $hasil['kdmerek']; ?></td>
                        <td><?php echo $hasil['nmmerek']; ?></td>
                        <td>
                            <a href="edit_merek.php?kodemrk=<?php echo $hasil['kdmerek']; ?>"><button class="btn-edit">Edit</button></a> /
                            <button class="btn-hapus" onclick="confirmDeletion('<?php echo $hasil['kdmerek']; ?>')">Hapus</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="tambah_merek.php"><button>Tambah Merek</button></a>
        </div>
    </section>
</body>
</html>
