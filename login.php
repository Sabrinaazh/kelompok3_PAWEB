<?php
session_start();
include 'function.php';
if(isset($_SESSION["akses"])){
    if($_SESSION["akses"] === "admin"){
        header("Location:index.php");
    } else if ($_SESSION["akses"] === "user"){
        header("Location:transaksi.php");
    }
}

if(isset($_POST["login"])){
    $username = htmlspecialchars(strtolower($_POST["username"]));
    $password = htmlspecialchars($_POST["password"]);

    $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username';");
    $result2 = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$username';");

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $nama = $row["nama"];
        $_SESSION["id"] = $row["id_admin"];
        $_SESSION["akses"] = "admin";
        if (password_verify($password, $row["password"])){
            echo "
            <script>
            alert('Selamat Datang $nama');
                document.location.href='index.php';
                </script>
                ";
            }
        } else if(mysqli_num_rows($result2) > 0){
        $row = mysqli_fetch_assoc($result2);
        $nama = $row["nama"];
        $_SESSION["id"] = $row["id_user"];
        $_SESSION["akses"] = "user";
        if (password_verify($password, $row["password"])){
            echo "
            <script>
                alert('Selamat Datang $nama');
                document.location.href='transaksi.php';
            </script>
            ";
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
    <title>Document</title>
    <link rel="stylesheet" href="css/style-login.css">
</head>

<body>
    <div class="wadah">
        <img src="img/raw/logo-login.png" alt="">
        <div class="container">
            <h1>LOGIN</h1>
            <hr>
            <form action="" method="post">
                <div class="inputan">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="username" id="username" required>
                </div>
                <div class="inputan">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="btn" name="login">Login</button>
            </form>
            <hr>
            <p>Belum punya akun?</p>
            <a href="register.php">Register</a>
        </div>
    </div>
</body>

</html>