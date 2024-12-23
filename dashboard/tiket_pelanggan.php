<?php
include '../includes/header.php';
include '../includes/config.php';
include '../includes/db.php';

// Get the order_id from the URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

// Initialize variables
$ticket_details = [];

// Fetch the ticket details for the given order_id from tiket_satuan_dibeli table and join with tipe_tiket_satuan
if ($order_id) {
    $query = "SELECT t.nama_tiket, td.kode_tiket
              FROM tiket_satuan_dibeli td
              JOIN tipe_tiket_satuan t ON td.id_tipe_tiket = t.id
              WHERE td.id_pemesanan_satuan = '$order_id'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($ticket = mysqli_fetch_assoc($result)) {
            $ticket_details[] = $ticket;
        }
    }
}

?>

<main>
    <div class="container mt-5">
        <h1 class="mb-4">Tiket Anda</h1>

        <?php if (!empty($ticket_details)): ?>
            <div class="row">
                <?php foreach ($ticket_details as $ticket): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title text-center"><?php echo htmlspecialchars($ticket['nama_tiket']); ?></h5>
                            </div>
                            <div class="card-body text-center">
                                <h6 class="fw-bold"><?php echo htmlspecialchars($ticket['kode_tiket']); ?></h6>
                                <p class="text-muted">Kode Tiket</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> No tickets found for this order.
            </div>
        <?php endif; ?>

        <a href="index.php" class="btn btn-primary mt-4">Kembali ke Beranda</a>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
