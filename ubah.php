<?php
session_start();
include "function.php";
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $nama = $_POST["nm_barang"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $ukuran = $_POST["ukuran"];
    $gambar = $_FILES["gambar"]["name"];
    $tmpName = $_FILES["gambar"]["tmp_name"];
    
    if((strlen($gambar) < 1)){
        $query = mysqli_query($conn, "UPDATE `barang` SET `nama_barang` = '$nama', `harga_barang` = '$harga', `deskripsi` = '$deskripsi', `ukuran_barang` = '$ukuran' WHERE `id_barang` = $id;");
        if($query){
            echo "
                <script>
                alert('Berhasil mengubah data barang!');
                document.location.href='index.php';
                </script>";
            exit;
        }
    }

    $ekstensigmbrvalid = ["jpg", "jpeg", "png"];
    $ekstensigmbr = explode(".", $gambar);
    $ekstensigmbr = strtolower(end($ekstensigmbr));
    if(!in_array($ekstensigmbr, $ekstensigmbrvalid)){
        echo "
            <script>
            alert('Yang anda upload bukan gambar!');
            document.location.href='ubah.php';
            </script>";
    }

    $nm_gambar = uniqid();
    $nm_gambar .= ".";
    $nm_gambar .= $ekstensigmbr;
    move_uploaded_file($tmpName, 'img/data/' . $nm_gambar);

    $query = mysqli_query($conn, "UPDATE `barang` SET `nama_barang` = '$nama', `harga_barang` = '$harga', `deskripsi` = '$deskripsi', `ukuran_barang` = '$ukuran', `foto_barang` = '$nm_gambar' WHERE `id_barang` = $id;");
    if($query){
        echo "
            <script>
            alert('Berhasil mengubah data barang!');
            document.location.href='index.php';
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
    <link rel="stylesheet" href="css/style-tambah.css">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="inp">
                <label for="nm_barang">Nama Barang</label>
                <input type="text" name="nm_barang" id="nm_barang" value="<?= $data['nama_barang'] ?>">
            </div>
            <div class="inp">
                <label for="harga">Harga Barang (Rp.)</label>
                <input type="text" name="harga" id="harga" value="<?= $data['harga_barang'] ?>">
            </div>
            <div class="inp">
                <label for="deskripsi">Deskripsi Barang</label>
                <input type="text" name="deskripsi" id="deskripsi" value="<?= $data['deskripsi'] ?>">
            </div>
            <div class="inp">
                <label for="ukuran">Ukuran Barang</label>
                <input type="text" name="ukuran" id="ukuran" value="<?= $data['ukuran_barang'] ?>">
            </div>
            <div class="inp">
                <label for="gambar">Foto Barang</label>
                <input type="file" name="gambar" id="gambar" value="<?= $data['foto_barang'] ?>">
                <input type="hidden" name="id" value="<?= $id ?>">
            </div>
            <div class="btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>