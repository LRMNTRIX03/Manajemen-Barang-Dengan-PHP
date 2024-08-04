<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';


$sql = "SELECT kdbarang FROM barang ORDER BY kdbarang DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_code = $row['kdbarang'];
    $last_number = intval(substr($last_code, 3)); 
    $new_number = $last_number + 1;
    $new_code = "BRG" . str_pad($new_number, 3, "0", STR_PAD_LEFT); 
} else {
    $new_code = "BRG001"; 
}
if(isset($_POST['btn-simpan-brg'])){
    $kdbarang = $_POST['kodebrg'];
    $namabrg = $_POST['namabrg'];
    $stokbrg = $_POST['stokbrg'];
    $hrgbrg = $_POST['hrgbrg'];
    $merekbrg = $_POST['merekbrg'];
    $ktgbrg = $_POST['kategoribrg'];

    if(empty($kdbarang)||empty($namabrg)||empty($stokbrg)||empty($hrgbrg)||empty($merekbrg)||empty($ktgbrg)){
        
    }
    else{
        $sql = "INSERT INTO barang(kdbarang, nmbarang, hrgBarang,stkBarang, ktgBarang, mrkBarang) Values('$kdbarang', '$namabrg', '$stokbrg', '$hrgbrg', '$merekbrg', '$ktgbrg')";
        $result1 = mysqli_query($koneksi, $sql);    

        if($result1 > 0){
            echo "
            <script>
            alert('Data Barang Sudah Ditambahkan');
            </script>";
            header("Location: barang.php");
            exit;
        }

    }


   

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="tambah_barang.css">
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
        #peringatan{
            color: red;
            visibility: hidden;
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
                <h1>Input Barang</h1>
                <form action="tambah_barang.php" method="post" onsubmit="return validateForm()">
                <div class="input-group">
                    <label for="kodebrg" class="label-item">Kode Barang : </label>
                    <input type="text" name="kodebrg" id="kodebrg" class="input-item" value="<?php echo $new_code; ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="namabrg" class="label-item">Nama Barang : </label>
                    <input type="text" name="namabrg" id="namabrg" class="input-item" placeholder="Masukan Nama Barang">
                </div>
                <div class="input-group">
                    <label for="stokbrg" class="label-item">Stok Barang : </label>
                    <input type="number" name="stokbrg" id="stokbrg" class="input-item" placeholder="Masukan Nama Stok">
                </div>
                <div class="input-group">
                    <label for="hrgbrg" class="label-item">Harga Barang : </label>
                    <input type="number" name="hrgbrg" id="hrgbrg" class="input-item" placeholder="Masukan Harga Barang">
                </div>
                <div class="input-group">
                    <label for="merekbrg" class="label-item">Merek Barang : </label>
                    <select name="merekbrg" id="merekbrg" class="input-item">
                        <?php
                        $sql = "SELECT * from merek";
                        $mrk = mysqli_query($koneksi, $sql);
                        while($hasilMRK = mysqli_fetch_assoc($mrk)) :
                        ?>
                        <option value="<?php echo $hasilMRK['nmmerek']?>"><?php echo $hasilMRK['nmmerek']?></option>
                        <?php endwhile;?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="kategoribrg" class="label-item">Kategori Barang : </label>
                 
                    <select name="kategoribrg" id="kategoribrg" class="input-item">
                           <?php 
                    $sql = "SELECT * from kategori";
                    $ktg = mysqli_query($koneksi, $sql);
                    while($hasil = mysqli_fetch_assoc($ktg)):
                    ?>
                        <option value="<?php echo $hasil['nmkategori'];?>"> <?php echo $hasil['nmkategori']; ?></option>
                    <?php endwhile;?>
                    </select>
                </div>
                <h4 id="peringatan">*Tolong Diisi Semua Form</h3>
                <input type="submit" value="Simpan" name="btn-simpan-brg" class="btn-simpan-brg">
                </form>
                <a href="barang.php"><button>Lihat Barang</button></a>
            </div>
        </div>
    </section>
    <!--Navbar and Sidebar End-->
    <script>
        function validateForm() {
            let valid = true;
            const warning = document.getElementById('peringatan');
            warning.style.visibility = 'hidden';

            const fields = document.querySelectorAll('.input-item');
            fields.forEach(field => {
                if (!field.value) {
                    valid = false;
                }
            });

            if (!valid) {
                warning.style.visibility = 'visible';
            }
            if(valid){
            document.getElementByClass('namabrg').value = '';
            document.getElementByClass('stokbrg').value = '';
            document.getElementByClass('hrgbrg').value = '';}
            

            return valid;
        }
       
    </script>
</body>
</html>
