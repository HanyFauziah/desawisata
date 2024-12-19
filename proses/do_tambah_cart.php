<?php 
    include "../includes/db.php";

    $id = $_GET["id"];
    $id_pengunjung = $_GET["pen"];
    $jumlah = $_GET["jml"];
    $sql = "SELECT * FROM `tipe_tiket_satuan` WHERE `id` = '$id'";
    $query = mysqli_query($conn,$sql);
    $hasil = mysqli_fetch_object($query);




    $_SESSION["cart"][$id] = [
        "nama" => $hasil->nama_tiket,
        "harga" => $hasil->harga_tiket,
        "jumlah" => $jumlah
    ];

    header("Location: ../tiket/pesan_tiket_satuan.php?id=" . urlencode($id_pengunjung) . "&success=true");
    exit;
?>