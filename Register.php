<?php
require 'koneksi.php';
$success = false; 
$warnings = "";

if(isset($_POST["regis-btn"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conPass = $_POST['passwordCon'];

    if(empty($username) || empty($password)){
        $warnings .= "<div class='peringatan'>
        <p>Username atau Password Tidak Boleh Kosong</p>
        </div>";
    } elseif(strlen($password) <= 6) {
        $warnings .= "<div class='peringatan'>
        <p>Password Terlalu Singkat, Harus lebih dari 7 Karakater</p>
        </div>";
    } elseif($password != $conPass){
        $warnings .= "<div class='peringatan'>
        <p>Password tidak sama dengan Konfirmasi Password</p>
        </div>";
    }

    if(empty($warnings)){
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')";
        $result = mysqli_query($koneksi, $sql);
        if($result){
            echo "<script>
            alert('Selamat Anda Sudah Terdaftar')
            </script>";
            $success = true;
        } else {
            $warnings .= "<div class='peringatan'>
            <p>Terjadi kesalahan saat mendaftar, silahkan coba lagi</p>
            </div>";
        }
    }
    echo $warnings;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="style/register.css">
    <style>
        .peringatan {
            color: red;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <script>
        function clearForm() {
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
            document.getElementById('passwordCon').value = '';
        }
    </script>
</head>
<body>
    <div class="Register-container">
        <h1>Daftar</h1>
        <div class="input-content">
            <form action="Register.php" method="post" onsubmit="if (<?php echo $success ? 'true' : 'false'; ?>) { clearForm(); }">
                <label for="username" style="padding: 15px;">Username</label>
                <input type="text" name="username" placeholder="Masukan username" class="username-input" id="username">
                <label for="password" style="padding: 15px;">Password</label>
                <input type="password" name="password" placeholder="Password" class="password-input" id="password">
                <label for="passwordCon" style="padding: 15px;">Konfirmasi Password</label>
                <input type="password" name="passwordCon" placeholder="Konfirmasi Password" class="password-input" id="passwordCon">
                <button type="submit" value="Regis" name="regis-btn" class="regis-btn">Register</button>
                <button class="login-btn"><a href="login.php">Login</a></button>
            </form>
            <?php if(!empty($warnings)) echo $warnings; ?>
        </div>
    </div>
</body>
</html>
