<?php 
include "../includes/db.php";
session_start(); // Ensure the session is started

// Get parameters from the URL
$id_pengunjung = $_GET['pen'];
$total_harga = $_GET['total'];
$tgl_wisata = $_GET['tgl']; // Get the 'tgl' parameter from the URL

// Generate a new unique ID for pemesanan_satuan
$id_pemesanan_satuan = 'PS' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);

// Insert into pemesanan_tiket_satuan
$sql = "INSERT INTO pemesanan_tiket_satuan (id, id_pengunjung, tgl_wisata, tgl_pemesanan, total_harga) 
        VALUES ('$id_pemesanan_satuan', '$id_pengunjung', '$tgl_wisata', NOW(), $total_harga)";
$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Error: " . mysqli_error($conn));
}

// Insert into detail_pemesanan_tiket_satuan
foreach($_SESSION["cart"] as $cart => $val){
    $sql = "INSERT INTO detail_pemesanan_tiket_satuan (id_pemesanan_satuan, id_tiket_satuan, jumlah_tiket) 
            VALUES ('$id_pemesanan_satuan', '$cart', {$val['jumlah']})";
    
    $query = mysqli_query($conn, $sql);
    
    if (!$query) {
        die("Error: " . mysqli_error($conn));
    }
}

// Clear the cart
unset($_SESSION["cart"]);

// Redirect to checkout page
header("Location: ../midtrans/examples/snap/checkout-process-simple-version.php?id=" . urlencode($id_pemesanan_satuan));
exit; // Ensure the script ends here
?>
