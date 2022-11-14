<?php
session_start();
include "function.php";
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $status = $_POST["status"];
    
    $query = mysqli_query($conn, "UPDATE `transaksi` SET `status` = '$status' WHERE `id_transaksi` = $id;");
    if($query){
        echo "
            <script>
            alert('Berhasil mengubah data transaksi!');
            document.location.href='list_transaksi.php';
            </script>";
    }
}
$id = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM transaksi JOIN user ON transaksi.id_user = user.id_user WHERE `id_transaksi` = '$id'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-tambah.css">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="inp">
                <label for="id_transaksi">ID Transaksi</label>
                <input type="text" disabled name="id_transaksi" id="id_transaksi" value="<?= $data['id_transaksi'] ?>">
            </div>
            <div class="inp">
                <label for="total">Total Pembayaran</label>
                <input type="text" disabled name="total" id="total" value="<?= $data['total_pembayaran'] ?>">
            </div>
            <div class="inp">
                <label for="tanggal">Tanggal Pembayaran</label>
                <input type="text" disabled name="tanggal" id="tanggal" value="<?= $data['tanggal_pembayaran'] ?>">
            </div>
            <div class="inp">
                <label for="id_user">ID User</label>
                <input type="text" disabled name="id_user" id="id_user" value="<?= $data['id_user'] ?>">
            </div>
            <div class="inp">
                <label for="nm_user">Nama User</label>
                <input type="text" disabled name="nm_user" id="nm_user" value="<?= $data['nama'] ?>">
            </div>
            <div class="inp">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" value="<?= $data['status'] ?>">
            </div>
            <div class="btn">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" name="submit">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>