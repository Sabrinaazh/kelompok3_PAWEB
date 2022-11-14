<?php
session_start();
include "function.php";
if(!isset($_SESSION["akses"])){
    header("Location:login.php");
}
$query = mysqli_query($conn, "SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-index.css">
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/function.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="isi">
        <div class="header">
            <img src="img/raw/logo.png" alt="">
            <div class="link">
                <a href="index.php">HOME</a> <a href="tambah.php">TAMBAH DATA</a> <a href="list_transaksi.php">LIST TRANSAKSI</a> <a href="logout.php">LOGOUT</a>
                <form action="" method="post">
                    <input type="search" class="keyword" name="keyword" id="keyword" size="30px" placeholder="Masukkan pencarian anda..." autocomplete="off">
                    <button type="submit" id="tombol-cari" name="cari">Cari!</button>
                </form>
            </div>
        </div>

        <div class="slider">
            <div class="content-slide">
                <div class="imgslide fade">
                    <img src="img/raw/iklan1.jpg" alt="" />
                </div>

                <div class="imgslide fade">
                    <img src="img/raw/iklan2.jpg" alt="" />
                </div>

                <div class="imgslide fade">
                    <img src="img/raw/iklan3.jpg" alt="" />
                </div>

                <a class="prev" onClick="nextslide(-1)">&#10094;</a>
                <a class="next" onClick="nextslide(1)">&#10095;</a>
            </div>

            <div class="page">
                <span class="dot" onClick="dotslide(1)"></span>
                <span class="dot" onClick="dotslide(2)"></span>
                <span class="dot" onClick="dotslide(3)"></span>
            </div>
            <script>
                var slideIndex = 1;
                showSlide(slideIndex);
            </script>
        </div>

        <div class="body">
            <div id="container">
                <section class="section-card">
                    <?php
                    while ($data = mysqli_fetch_array($query)) :
                    ?>
                        <div class="card">
                            <img src="img/data/<?= $data['foto_barang'] ?>" alt="" class="card__img">
                            <div class="card__details">
                                <h3><?= $data["nama_barang"] ?></h3>
                                <p><?= $data["deskripsi"] ?></p>
                                <p>Ukuran : <?= $data["ukuran_barang"] ?></p>
                                <p>Rp.<?= $data["harga_barang"] ?></p>
                                <a href="ubah.php?id=<?= $data['id_barang'] ?>">Ubah Data</a> |
                                <a href="hapus.php?id=<?= $data['id_barang'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus Data</a>
                            </div>
                        </div>
                    <?php
                    endwhile
                    ?>
                </section>
            </div>
        </div>

        <div class="foot-container">
            <div class="footer">
                <div class="foot-gambar">
                    <a href="http://www.instagram.com"><img src="img/raw/instagram.png" alt=""></a>
                    <a href="http://www.twitter.com"><img src="img/raw/twitter.png" alt=""></a>
                    <a href="http://www.facebook.com"><img src="img/raw/facebook.png" alt=""></a>
                    <a href="http://www.youtube.com"><img src="img/raw/youtube.png" alt=""></a>
                </div>
                <div class="teks">
                    <p>Home</p>
                    <p>Services</p>
                    <p>About</p>
                    <p>Terms</p>
                    <p>Privacy Policy</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>