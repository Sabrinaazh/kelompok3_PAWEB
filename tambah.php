<?php
session_start();
include "function.php";
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
if(isset($_POST["submit"])){
    $nama = $_POST["nm_barang"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $ukuran = $_POST["ukuran"];
    $gambar = $_FILES["gambar"]["name"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    $ekstensigmbrvalid = ["jpg", "jpeg", "png"];
    $ekstensigmbr = explode(".", $gambar);
    $ekstensigmbr = strtolower(end($ekstensigmbr));
    if(!in_array($ekstensigmbr, $ekstensigmbrvalid)){
        echo "
            <script>
            alert('Yang anda upload bukan gambar!');
            document.location.href='tambah.php';
            </script>";
    }

    $nm_gambar = uniqid();
    $nm_gambar .= ".";
    $nm_gambar .= $ekstensigmbr;
    move_uploaded_file($tmpName, 'img/data/' . $nm_gambar);

    $query = mysqli_query($conn, "INSERT INTO barang (id_barang, nama_barang, harga_barang, deskripsi, ukuran_barang, foto_barang) VALUES ('', '$nama', '$harga', '$deskripsi', '$ukuran', '$nm_gambar');");
    if($query){
        echo "
            <script>
            alert('Berhasil menambahkan barang!');
            document.location.href='index.php';
            </script>";
    }
}
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
                <input type="text" name="nm_barang" id="nm_barang" required>
            </div>
            <div class="inp">
                <label for="harga">Harga Barang (Rp.)</label>
                <input type="text" name="harga" id="harga" required>
            </div>
            <div class="inp">
                <label for="deskripsi">Deskripsi Barang</label>
                <input type="" name="deskripsi" id="deskripsi" placeholder="Opsional">
            </div>
            <div class="inp">
                <label for="ukuran">Ukuran Barang</label>
                <input type="text" name="ukuran" id="ukuran" required>
            </div>
            <div class="inp">
                <label for="gambar">Foto Barang</label>
                <input type="file" name="gambar" id="gambar" required>
            </div>
            <div class="btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>