<?php
session_start();
require "function.php";
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
$id = $_SESSION["id"];
$query = mysqli_query($conn, "SELECT * FROM `transaksi` WHERE `id_user` = $id");
if($_SESSION["akses"] == "admin"){
    $query = mysqli_query($conn, "SELECT * FROM `transaksi`");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style-listTransaksi.css">
</head>

<body>
    <div class="container">
        <a href="
        <?php
        if($_SESSION["akses"] == "admin"){
        ?>
        index.php
        <?php } else if($_SESSION["akses"] == "user") { ?>
            transaksi.php
            <?php } ?>
        ">Kembali</a>
        <table border="1" width="100%">
            <thead>
                <th>No.</th>
                <th>Total Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Status</th>
                <?php
                    if($_SESSION["akses"]=="admin"):
                    ?>
                <th>Aksi</th>
                <?php
                    endif
                    ?>
            </thead>
            <tbody>
                <?php
            $nomor = 1;
            while($data = mysqli_fetch_array($query)):
            ?>
                <tr>
                    <td class="nomor"><?= $nomor ?>.</td>
                    <td><?= $data["total_pembayaran"] ?></td>
                    <td><?= $data["tanggal_pembayaran"] ?></td>
                    <td><?= $data["status"] ?></td>
                    <?php
                    if($_SESSION["akses"]=="admin"):
                    ?>
                    <td class="aksi"><a href="ubah_transaksi.php?id=<?= $data['id_transaksi'] ?>">Ubah</a> | <a
                            href="hapus_transaksi.php?id=<?= $data['id_transaksi'] ?>">Hapus</a>
                    </td>
                    <?php
                    endif
                    ?>
                </tr>
                <?php
            $nomor++;
            endwhile
            ?>
            </tbody>
        </table>
    </div>
</body>

</html>