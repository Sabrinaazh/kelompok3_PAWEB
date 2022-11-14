<?php
session_start();
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
include "function.php";
$id = $_GET["id"];
$query = mysqli_query($conn, "DELETE FROM `barang` WHERE `id_barang` = $id;");
if($query){
    echo "
    <script>
        alert('Berhasil menghapus data');
        document.location.href='index.php';
    </script>";
}