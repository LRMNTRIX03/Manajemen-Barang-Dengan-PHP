<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';

$kodeUpdate = $_GET['kodemrk'];

if (!empty($kodeUpdate)) {
    $sql = "SELECT * FROM merek WHERE kdmerek = '$kodeUpdate'";
    $result = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_assoc($result);
}

if (isset($_POST['simpan'])) {
    $kodemrk= $_POST['kodemrk'];
    $namamrk = $_POST['namamrk'];

    $sql_update = "UPDATE merek SET nmmerek='$namamrk' WHERE kdmerek='$kodemrk'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: merek.php");
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
    <link rel="stylesheet" href="edit_merek.css">
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
                <form action="edit_merek.php?kodemrk=<?php echo $kodeUpdate; ?>" method="post">
                <div class="input-group">
                    <label for="kodemrk" class="label-item">Kode kategori : </label>
                    <input type="text" name="kodemrk" id="kodemrk" class="input-item" value="<?php echo $hasil['kdmerek']; ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="namamrk" class="label-item">Nama Barang : </label>
                    <input type="text" name="namamrk" id="namamrk" class="input-item" value="<?php echo $hasil['nmmerek']; ?>">
                </div>
                <input type="submit" value="Simpan" name="simpan" id="btn-simpan">
                </form>
                <a href="merek.php"><button>Lihat Merek</button></a>
            </div>
        </div>
    </section>
    <!--Navbar and Sidebar End-->
</body>
</html>
