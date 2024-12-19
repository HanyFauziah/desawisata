<?php 
include '../includes/db.php';
$id = $_GET["id"];
$pen = $_GET["pen"];

unset($_SESSION["cart"][$id]);
header("Location: ../tiket/tiket_keranjang.php?id=" . urlencode($pen));

?>