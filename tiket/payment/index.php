<?php
include "../../includes/header.php";
include "../../includes/db.php";

// Get the parameters from the URL query string
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
$status_code = isset($_GET['status_code']) ? $_GET['status_code'] : '';
$transaction_status = isset($_GET['transaction_status']) ? $_GET['transaction_status'] : '';

// Initialize variables
$order_details = false;
$visitor_name = '';
$visitor_email = '';
$ticket_details = [];

// Check if the transaction status is "settlement"
if ($transaction_status === 'settlement') {
    // Query the database for order details from pemesanan_tiket_satuan table
    $query = "SELECT id, tgl_wisata, total_harga, id_pengunjung
              FROM pemesanan_tiket_satuan
              WHERE id = '$order_id'";

    $result = mysqli_query($conn, $query);

    // Check if the query returned a valid result
    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
        
        // Fetch visitor details using id_pengunjung
        $id_pengunjung = $order['id_pengunjung'];
        $visitor_query = "SELECT nama, email FROM pengunjung WHERE id = '$id_pengunjung'";
        $visitor_result = mysqli_query($conn, $visitor_query);

        if ($visitor_result && mysqli_num_rows($visitor_result) > 0) {
            $visitor = mysqli_fetch_assoc($visitor_result);
            $visitor_name = $visitor['nama'];
            $visitor_email = $visitor['email'];
        }

        // Fetch ticket details from detail_pemesanan_tiket_satuan table
        // Join with tipe_tiket_satuan to get the nama_tiket
        $ticket_query = "SELECT d.id_tiket_satuan, d.jumlah_tiket, t.nama_tiket
                         FROM detail_pemesanan_tiket_satuan d
                         JOIN tipe_tiket_satuan t ON d.id_tiket_satuan = t.id
                         WHERE d.id_pemesanan_satuan = '$order_id'";

        $ticket_result = mysqli_query($conn, $ticket_query);

        if ($ticket_result && mysqli_num_rows($ticket_result) > 0) {
            while ($ticket = mysqli_fetch_assoc($ticket_result)) {
                $ticket_details[] = $ticket;
            }
        }

        // Order details found
        $order_details = true;
    } else {
        $order_details = false;
    }
} else {
    $order_details = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Pemesanan Tiket Berhasil</h1>

    <?php if ($order_details): ?>
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h5 class="card-title">Nomor Pesanan: <?php echo $order['id']; ?></h5>
                <p><?php echo $visitor_name; ?> | <strong>Email:</strong> <?php echo $visitor_email; ?></p>
            </div>
            <div class="card-body">
                <h5 class="card-title">Detail Pesanan</h5>
                <p><strong>Tanggal Wisata:</strong> <?php echo $order['tgl_wisata']; ?></p>

                <!-- Display ticket details in a stylish table without borders or headings -->
                <h6>Detail Tiket:</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-sm shadow-sm p-3 mb-4 rounded">
                        <tbody>
                            <?php foreach ($ticket_details as $ticket): ?>
                                <tr>
                                    <td class="fw-bold text-primary"><?php echo htmlspecialchars($ticket['nama_tiket']); ?></td>
                                    <td class="text-end text-muted"><?php echo htmlspecialchars($ticket['jumlah_tiket']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <p class="card-text"><strong>Total Harga:</strong> Rp <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></p>
                <p>Tiket akan dikirimkan melalui email</p>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> Order not found or the payment status is not settled.
        </div>
    <?php endif; ?>



    <!-- Back Button -->
    <a href="../../index.php" class="btn btn-primary mt-4">Kembali</a>
</div>

    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
