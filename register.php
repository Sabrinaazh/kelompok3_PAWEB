<?php
session_start();
require "function.php";
if(isset($_SESSION["akses"])){
    if($_SESSION["akses"] === "admin"){
        header("Location:index.php");
    } else if ($_SESSION["akses"] === "user"){
        header("Location:transaksi.php");
    }
}

if(isset($_POST["submit"])){
    $nama = $_POST["nama"];
    $username = strtolower(htmlspecialchars($_POST["username"]));
    $password = htmlspecialchars($_POST["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $role = $_POST["role"];
    $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username` = '$username';");
    $result2 = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` = '$username';");
    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0){
        echo "
        <script>
            alert('Username sudah ada!');
        </script>";
        exit;
    }
    if($role === "1"){
        $query = mysqli_query($conn, "INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`) VALUES ('', '$username', '$password', '$nama');");
        if($query){
            echo "
            <script>
                alert('Berhasil registrasi akun admin!');
                document.location.href='login.php';
            </script>";
        } else {
            mysqli_error($conn);
        }
    } else if($role === "2"){
        $query = mysqli_query($conn, "INSERT INTO `user` (`id_user`, `username`, `password`, `nama`) VALUES ('', '$username', '$password', '$nama');");
        if($query){
            echo "
            <script>
                alert('Berhasil registrasi akun user!');
                document.location.href='login.php';
            </script>";
        } else {
            mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-register.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <div class="inp">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="inp">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="inp">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="inp">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
            </div>
            <div class="btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </div>
    </form>
</body>
</html>