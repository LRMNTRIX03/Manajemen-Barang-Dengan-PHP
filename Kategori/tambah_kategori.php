<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';


$sql = "SELECT kdkategori FROM kategori ORDER BY kdkategori DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_code = $row['kdkategori'];
    $last_number = intval(substr($last_code, 3)); 
    $new_number = $last_number + 1;
    $new_code = "KTG" . str_pad($new_number, 3, "0", STR_PAD_LEFT); 
} else {
    $new_code = "KTG001"; 
}
if(isset($_POST['btn-simpan-ktg'])){
    $kdktg = $_POST['kodektg'];
    $namaktg = $_POST['namaktg'];

    if(empty($kdktg)||empty($namaktg)){
        
    }
    else{
        $sql = "INSERT INTO kategori(kdkategori, nmkategori) Values('$kdktg', '$namaktg')";
        $result1 = mysqli_query($koneksi, $sql);    

        if($result1 > 0){
            echo "
            <script>
            alert('Data Kategori Sudah Ditambahkan');
            </script>";
            header("Location: kategori.php");
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
    <link rel="stylesheet" href="tambah_kategori.css">
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
                <form action="tambah_kategori.php" method="post" onsubmit="return validateForm(event)">
                <div class="input-group">
                    <label for="kodektg" class="label-item">Kode Kategori : </label>
                    <input type="text" name="kodektg" id="kodektg" class="input-item" value="<?php echo $new_code; ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="namaktg" class="label-item">Nama Kategori : </label>
                    <input type="text" name="namaktg" id="namaktg" class="input-item" placeholder="Masukan Nama Kategori">
                </div>
                <h4 id="peringatan">*Tolong Diisi Semua Form</h4>
                <input type="submit" value="Simpan" name="btn-simpan-ktg" class="btn-simpan-ktg">
                </form>
                <a href="kategori.php"><button>Lihat Kategori</button></a>
            </div>
        </div>
    </section>
    <!--Navbar and Sidebar End-->
    <script>
       function validateForm(event) {
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
            event.preventDefault();
            warning.style.visibility = 'visible';
        }
        
    }
       
    </script>
</body>
</html>
