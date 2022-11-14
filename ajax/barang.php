<?php
require "../function.php";
$keyword = $_GET["keyword"];
$query = mysqli_query($conn, "SELECT * FROM barang WHERE `nama_barang` LIKE '%$keyword%' OR `harga_barang` LIKE '%$keyword%' OR `deskripsi` LIKE '%$keyword%' OR `ukuran_barang` LIKE '%$keyword%';");
?>
<section class="section-card">
    <?php
    while ($data = mysqli_fetch_array($query)) :
    ?>
    <div class="card">
        <img src="img/data/<?=$data['foto_barang']?>" alt="" class="card__img">
        <div class="card__details">
            <h3><?= $data["nama_barang"] ?></h3>
            <p><?= $data["deskripsi"] ?></p>
            <p>Ukuran : <?= $data["ukuran_barang"] ?></p>
            <p>Rp.<?= $data["harga_barang"] ?></p>
            <a href="ubah.php?id=<?= $data['id_barang'] ?>">Ubah Data</a> |
            <a href="hapus.php?id=<?= $data['id_barang'] ?>"
                onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus Data</a>
        </div>
    </div>
    <?php
    endwhile
    ?>
</section>