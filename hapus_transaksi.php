<?php
session_start();
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
include "function.php";
$id = $_GET["id"];
$query = mysqli_query($conn, "DELETE FROM `transaksi` WHERE `id_transaksi` = $id;");
if($query){
    echo "
    <script>
        alert('Berhasil menghapus transaksi');
        document.location.href='list_transaksi.php';
    </script>";
}