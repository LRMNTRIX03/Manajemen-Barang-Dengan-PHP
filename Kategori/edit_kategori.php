<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';

$kodeUpdate = $_GET['kodektg'];

if (!empty($kodeUpdate)) {
    $sql = "SELECT * FROM kategori WHERE kdkategori = '$kodeUpdate'";
    $result = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_assoc($result);
}

if (isset($_POST['simpan'])) {
    $kodektg= $_POST['kodektg'];
    $namaktg = $_POST['namaktg'];

    $sql_update = "UPDATE kategori SET nmkategori='$namaktg' WHERE kdkategori='$kodektg'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: kategori.php");
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
    <link rel="stylesheet" href="edit_kategori.css">
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
                <form action="edit_kategori.php?kodektg=<?php echo $kodeUpdate; ?>" method="post">
                <div class="input-group">
                    <label for="kodektg" class="label-item">Kode kategori : </label>
                    <input type="text" name="kodektg" id="kodektg" class="input-item" value="<?php echo $hasil['kdkategori']; ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="namaktg" class="label-item">Nama Barang : </label>
                    <input type="text" name="namaktg" id="namaktg" class="input-item" value="<?php echo $hasil['nmkategori']; ?>">
                </div>
                <input type="submit" value="Simpan" name="simpan" id="btn-simpan">
                </form>
                <a href="kategori.php"><button>Lihat Kategori</button></a>
            </div>
        </div>
    </section>
    <!--Navbar and Sidebar End-->
</body>
</html>
