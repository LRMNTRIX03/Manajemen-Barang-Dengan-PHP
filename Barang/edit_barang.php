<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';

$kodeUpdate = $_GET['kodebrg'];

if (!empty($kodeUpdate)) {
    $sql = "SELECT * FROM barang WHERE kdbarang = '$kodeUpdate'";
    $result = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_assoc($result);
}

if (isset($_POST['simpan'])) {
    $kodebrg = $_POST['kodebrg'];
    $namabrg = $_POST['namabrg'];
    $stokbrg = $_POST['stokbrg'];
    $merekbrg = $_POST['merekbrg'];
    $ktgbrg = $_POST['kategoribrg'];

    $sql_update = "UPDATE barang SET namabrg='$namabrg', stokbrg='$stokbrg', merekbrg='$merekbrg', kategoribrg='$ktgbrg' WHERE kdbarang='$kodebrg'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: barang.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="edit_barang.css">
    <style>
        .input-content a {
            padding: 15px;
        }
        .input-content button {
            padding: 10px;
            background: #ff6347;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 0.325em;
            font-size: 20px;
            cursor: pointer;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .input-content button:hover {
            opacity: 30%;
        }
    </style>
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
            <div class="input-content">
                <h1>Edit Barang</h1>
                <form action="edit_barang.php?kodebrg=<?php echo $kodeUpdate; ?>" method="post">
                <div class="input-group">
                    <label for="kodebrg" class="label-item">Kode Barang : </label>
                    <input type="text" name="kodebrg" id="kodebrg" class="input-item" value="<?php echo $hasil['kdbarang']; ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="namabrg" class="label-item">Nama Barang : </label>
                    <input type="text" name="namabrg" id="namabrg" class="input-item" value="<?php echo $hasil['nmbarang']; ?>">
                </div>
                <div class="input-group">
                    <label for="stokbrg" class="label-item">Stok Barang : </label>
                    <input type="text" name="stokbrg" id="stokbrg" class="input-item" value="<?php echo $hasil['stkBarang']; ?>">
                </div>
                <div class="input-group">
                    <label for="merekbrg" class="label-item">Merek Barang : </label>
                    <select name="merekbrg" id="merekbrg" class="input-item">
                        <option value="merekA" <?php if ($hasil['mrkBarang'] == 'merekA') echo 'selected'; ?>>Merek A</option>
                        <option value="merekB" <?php if ($hasil['mrkBarang'] == 'merekB') echo 'selected'; ?>>Merek B</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="kategoribrg" class="label-item">Kategori Barang : </label>
                    <select name="kategoribrg" id="kategoribrg" class="input-item">
                        <option value="kategoriA" <?php if ($hasil['ktgBarang'] == 'kategoriA') echo 'selected'; ?>>Kategori A</option>
                        <option value="kategoriB" <?php if ($hasil['ktgBarangg'] == 'kategoriB') echo 'selected'; ?>>Kategori B</option>
                    </select>
                </div>
                <input type="submit" value="Simpan" name="simpan" id="btn-simpan">
                </form>
                <a href="barang.php"><button>Lihat Barang</button></a>
            </div>
        </div>
    </section>
    <!--Navbar and Sidebar End-->
</body>
</html>
