<?php
    include "../includes/db.php";

    $id_pemesanan = $_GET["id"];

    $sql = "SELECT * FROM `tipe_tiket_satuan` WHERE `id` = " . intval($id_pemesanan);
    $query = mysqli_query($conn,$sql);
    $hasil = mysqli_fetch_object($query);

    
    $_SESSION["cat"][$id_pemesanan] = [
        "nama" => $hasil->nama_tiket,
        "harga" => $hasil->harga_tiket,
        "jumlah" => 1
    ];

    header("Location: ../tiket_keranjang.php");
?>