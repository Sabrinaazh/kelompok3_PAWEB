<?php
session_start();
include "function.php";
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
if(isset($_POST["submit"])){
    $harga = $_POST["harga"];
    $tanggal = $_POST["tanggal"];
    $id = $_SESSION["id"];

    $query = mysqli_query($conn, "INSERT INTO transaksi (`id_transaksi`, `total_pembayaran`, `id_user`, `tanggal_pembayaran`, `status`) VALUES ('', '$harga', '$id', '$tanggal', 'sudah dibayar');");
    if($query){
        echo "
            <script>
            alert('Berhasil membeli barang!');
            document.location.href='transaksi.php';
            </script>";
    }
}
$id = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM barang WHERE `id_barang` = '$id'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-pesan.css">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="inp">
                <label for="nm_barang">Nama Barang</label>
                <input type="text" disabled id="nm_barang" value="<?= $data['nama_barang'] ?>">
            </div>
            <div class="inp">
                <label for="harga">Harga Barang (Rp.)</label>
                <input type="text" disabled id="harga" value="<?= $data['harga_barang'] ?>">
                <input type="hidden" name="harga" value="<?= $data['harga_barang'] ?>">
            </div>
            <div class="inp">
                <label for="ukuran">Ukuran Barang</label>
                <input type="text" disabled name="ukuran" id="ukuran" value="<?= $data['ukuran_barang'] ?>">
            </div>
            <div class="inp">
                <label for="gambar">Foto Barang</label>
                <img src="img/data/<?= $data['foto_barang'] ?>" alt="">
                <input type="hidden" name="id" value="<?= $id ?>">
            </div>
            <div class="inp">
                <label for="tanggal">Tanggal Pembayaran Barang</label>
                <input type="date" name="tanggal" id="tanggal" max="<?= date('Y-m-d') ?>">
            </div>
            <div class="btn">
                <button type="submit" name="submit">Pesan </button>
            </div>
        </div>
    </form>
</body>

</html>