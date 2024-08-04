<?php
session_start();
require 'koneksi.php';
$success = false; 
$warnings = "";

if(isset($_POST['login-btn'])){
    if(empty($_POST['username']) || empty($_POST['password'])){
       $warnings .= "<div class='peringatan'>
        <p>Username atau Password Tidak Boleh Kosong</p>
        </div>";
    } else {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($koneksi, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password']))
            {
            $_SESSION['login'] = true;
            header("Location: index.php");
            $success = true;
            exit;
            }
            
        } else {
           $warnings .= "<div class='peringatan'>
        <p>User Tidak ditemukan</p>
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
    <link rel="stylesheet" href="style/style.css">
    <script>
        function clearForm() {
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }
    </script>
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
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <div class="input-content">
            <form action="login.php" method="post" onsubmit="if (<?php echo $success ? 'true' : 'false'; ?>) { clearForm(); }">
                <label for="username" style="padding: 15px;">Username</label>
                <input type="text" name="username" placeholder="Masukan username" class="username-input" id="username">
                <label for="password" style="padding: 15px;">Password</label>
                <input type="password" name="password" placeholder="Password" class="password-input" id="password">
                <button type="submit" value="Login" name="login-btn" class="login-btn">Login</button>
                <button type="button" class="regis-btn"><a href="Register.php">Daftar</a></button>
            </form>
        </div>
    </div>
</body>
</html>
