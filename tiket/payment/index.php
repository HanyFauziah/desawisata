<?php
include "../includes/db.php"; // Ensure session_start() is in db.php
include "../includes/header.php";
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
$status_code = isset($_GET['status_code']) ? $_GET['status_code'] : '';
$transaction_status = isset($_GET['transaction_status']) ? $_GET['transaction_status'] : '';

$order_details = false;
$visitor_name = '';
$visitor_email = '';
$ticket_details = [];

// QR Code generation logic
require "vendor/autoload.php";

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;



$qrCodeImage = null;

// Automatically generate the QR code using $order_id (no POST required)
if ($order_id) {
    // Create a QR Code
    $qrCode = new QrCode(
        data: "https://desawisatasindangkasih.my.id/tiket/tiket_kamu.php?order_id=$order_id",
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::Low,
        size: 300,
        margin: 10,
        roundBlockSizeMode: RoundBlockSizeMode::Margin,
        foregroundColor: new Color(0, 0, 0), // Black foreground
        backgroundColor: new Color(255, 255, 255) // White background
    );
    
    // Create a writer instance to render the QR code as an image
    $writer = new PngWriter();
    
    // Write the QR code with the label
    $result = $writer->write(qrCode: $qrCode);
    $qrCodeImage = $result->getString(); // Store the QR code image string to display it
}

// Check transaction status
if ($transaction_status === 'settlement') {
    // Query the database for order details
    $query = "SELECT id, tgl_wisata, total_harga, id_pengunjung
              FROM pemesanan_tiket_satuan
              WHERE id = '$order_id'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
        
        // Fetch visitor details
        $id_pengunjung = $order['id_pengunjung'];
        $visitor_query = "SELECT nama, email FROM pengunjung WHERE id = '$id_pengunjung'";
        $visitor_result = mysqli_query($conn, $visitor_query);

        if ($visitor_result && mysqli_num_rows($visitor_result) > 0) {
            $visitor = mysqli_fetch_assoc($visitor_result);
            $visitor_name = $visitor['nama'];
            $visitor_email = $visitor['email'];
        }

        // Fetch ticket details from detail_pemesanan_tiket_satuan table
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

        // Insert tickets into tiket_satuan_dibeli if not already inserted
        foreach ($ticket_details as $ticket) {
            $jumlah_tiket = $ticket['jumlah_tiket'];
            $id_tiket_satuan = $ticket['id_tiket_satuan'];

            $check_ticket_query = "SELECT COUNT(*) as count FROM tiket_satuan_dibeli 
                                   WHERE id_pemesanan_satuan = '$order_id' AND id_tipe_tiket = '$id_tiket_satuan'";
            $check_ticket_result = mysqli_query($conn, $check_ticket_query);
            $check_ticket = mysqli_fetch_assoc($check_ticket_result);

            if ($check_ticket['count'] == 0) {
                // Insert tickets into tiket_satuan_dibeli if not already inserted
                for ($i = 0; $i < $jumlah_tiket; $i++) {
                    $kode_tiket = 'TKS-' . $order['tgl_wisata'] . '-' . rand(10000, 99999); // Generate a random ticket code
                    $insert_query = "INSERT INTO tiket_satuan_dibeli (id_pemesanan_satuan, id_tipe_tiket, kode_tiket, tgl_dibuat)
                                     VALUES ('$order_id', '$id_tiket_satuan', '$kode_tiket', NOW())";

                    mysqli_query($conn, $insert_query);
                }
            }
        }

        // Refetch ticket details after insertion to show updated data
        $ticket_query = "SELECT d.id_tiket_satuan, d.jumlah_tiket, t.nama_tiket
                         FROM detail_pemesanan_tiket_satuan d
                         JOIN tipe_tiket_satuan t ON d.id_tiket_satuan = t.id
                         WHERE d.id_pemesanan_satuan = '$order_id'";

        $ticket_result = mysqli_query($conn, $ticket_query);
        $ticket_details = []; // Clear previous ticket details
        while ($ticket = mysqli_fetch_assoc($ticket_result)) {
            $ticket_details[] = $ticket;
        }

    } else {
        $order_details = false;
    }
} else {
    if ($transaction_status === 'pending') {
        $order_details = 'Pemesanan Tiket Belum Berhasil';
    } elseif ($transaction_status === 'cancel') {
        $order_details = 'Pembayaran Gagal';
    } else {
        $order_details = false;
    }
}
?>

<main>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary custom-heading">
        <?php
            if ($transaction_status === 'settlement') {
                echo 'Pemesanan Tt Berhasil';
            } elseif ($transaction_status === 'pending') {
                echo 'Pemesanan Tiket Berhasil Pembayaran Belum Berhasil';
            } elseif ($transaction_status === 'cancel') {
                echo 'Pembayaran Gagal';
            } else {
                echo 'Status Pemesanan Tidak Ditemukan';
            }
        ?>
    </h1>

    <?php if ($order_details && $transaction_status === 'settlement'): ?>
        <div class="custom-card">
            <div class="custom-card-header">
                <h5>Nomor Pesanan : <?php echo htmlspecialchars($order['id']); ?></h5>
                <p><?php echo htmlspecialchars($visitor_name); ?> | <strong></strong> <?php echo htmlspecialchars($visitor_email); ?></p>
            </div>

            <?php if ($qrCodeImage): ?>
                <div class="qr-code">
                    <div class="d-flex flex-column">
                        <p>Silahkan tunjukkan kode QR ini ke petugas:</p>
                        <img id="qr-code-img" src="data:image/png;base64,<?php echo base64_encode($qrCodeImage); ?>" alt="QR Code"/>
                        <button id="save-qr-btn" class="btn btn-primary mt-3">Download QR</button>
                    </div>
                </div>
            <?php endif; ?>

            <div class="custom-card-body">
                <p><strong>Tanggal Berlaku Tiket :</strong> <?php echo htmlspecialchars($order['tgl_wisata']); ?></p>

                <!-- Ticket Details -->
                <h6 class="mt-4">Detail Tiket:</h6>
                <table class="table custom-table">
                    <tbody>
                        <?php foreach ($ticket_details as $ticket): ?>
                            <tr>
                                <td class="name"><?php echo htmlspecialchars($ticket['nama_tiket']); ?></td>
                                <td class="amount"><?php echo htmlspecialchars($ticket['jumlah_tiket']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Total Price -->
                <p class="mt-3"><strong>Total Harga :</strong> Rp <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></p>
                <p>Tiket akan dikirimkan melalui email.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger mt-4" role="alert">
            <strong>Error!</strong> <?php echo $order_details; ?>
        </div>
    <?php endif; ?>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="../../index.php" class="btn btn-back text-white px-4 py-2">Kembali</a>
    </div>
</div>
</main>

<style>
    .custom-card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: #ffffff;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6c63ff, #9b89ff);
        color: white;
        padding: 20px;
    }

    .custom-card-body {
        padding: 20px;
    }

    .custom-table td {
        padding: 8px;
        font-size: 14px;
    }

    .qr-code img {
        max-width: 250px;
        max-height: 250px;
    }

    .btn-back {
        background-color: #007bff;
        border-radius: 4px;
    }
</style>

<!-- QR Code save function -->
<script>
document.getElementById('save-qr-btn').addEventListener('click', function () {
    const qrCodeImage = document.getElementById('qr-code-img');
    const imageURL = qrCodeImage.src;

    const a = document.createElement('a');
    a.href = imageURL;
    a.download = 'qr_code.png';
    a.click();
});
</script>

<?php
    include '../includes/footer.php';
?>
