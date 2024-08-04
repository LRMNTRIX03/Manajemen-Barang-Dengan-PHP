<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';


$sql = "SELECT kdmerek FROM merek ORDER BY kdmerek DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_code = $row['kdmerek'];
    $last_number = intval(substr($last_code, 3)); 
    $new_number = $last_number + 1;
    $new_code = "MRK" . str_pad($new_number, 3, "0", STR_PAD_LEFT); 
} else {
    $new_code = "MRK001"; 
}
if(isset($_POST['btn-simpan-merek'])){
    $kdmerek = $_POST['kodemrk'];
    $namamerek = $_POST['namamrk'];

    if(empty($kdmerek) || empty($namamerek)){

    } else {
        $sql = "INSERT INTO merek(kdmerek, nmmerek) VALUES('$kdmerek', '$namamerek')";
        $result1 = mysqli_query($koneksi, $sql);    

        if($result1 > 0){
            echo "
            <script>
            alert('Data Merek Sudah Ditambahkan');
            </script>";
            header("Location: merek.php");
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
    <link rel="stylesheet" href="tambah_merek.css">
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
                <h1>Input Merek</h1>
                <form action="tambah_merek.php" method="post" onsubmit="return validateForm(event)">
                <div class="input-group">
                    <label for="kodemrk" class="label-item">Kode Merek : </label>
                    <input type="text" name="kodemrk" id="kodemrk" class="input-item" value="<?php echo $new_code; ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="namamrk" class="label-item">Nama Merek : </label>
                    <input type="text" name="namamrk" id="namamrk" class="input-item" placeholder="Masukan Nama Merek">
                </div>
                <h4 id="peringatan">*Tolong Diisi Semua Form</h4>
                <input type="submit" value="Simpan" name="btn-simpan-merek" class="btn-simpan-merek">
                </form>
                <a href="merek.php"><button>Lihat Merek</button></a>
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
