<?php
session_start();
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
$_SESSION = [];
session_destroy();
header("Location:login.php");