<?php
// Start output buffering
ob_start();

include '../../includes/header.php';
include '../../includes/db.php';

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Get the order_id from the URL
$order_id = 'PS627194';

// Initialize variables
$ticket_details = [];

// Fetch the ticket details for the given order_id from tiket_satuan_dibeli table and join with tipe_tiket_satuan
if ($order_id) {
    $query = "SELECT t.nama_tiket, td.kode_tiket, t.harga_tiket
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

// Generate the HTML content for the PDF
$html = '<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        padding: 20px;
        margin: 0 auto;
        width: 90%;
        max-width: 800px;
    }
    .ticket {
        border: 1px solid #007bff;
        border-radius: 5px;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .ticket-header {
        background-color: #007bff;
        color: #ffffff;
        padding: 15px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }
    .ticket-body {
        background-color: #ffffff;
        color: #007bff;
        padding: 15px;
        text-align: center;
    }
    .ticket-body p {
        margin: 5px 0;
        font-size: 14px;
    }
    .website-footer {
        text-align: center;
        margin-top: 5px;
        margin-bottom: 15px;
        font-size: 12px;
        color: #007bff;
    }
</style>';

$html .= '<div class="container" style="">';

if (!empty($ticket_details)) {
    foreach ($ticket_details as $ticket) {
        $html .= '<div class="ticket">';
        $html .= '<div class="ticket-header">' . htmlspecialchars($ticket['nama_tiket']) . '</div>';
        $html .= '<div class="ticket-body">';
        $html .= '<p><strong>Kode Tiket:</strong> ' . htmlspecialchars($ticket['kode_tiket']) . '</p>';
        $html .= '<p><strong>Harga Tiket:</strong> Rp ' . number_format($ticket['harga_tiket'], 0, ',', '.') . '</p>';
        $html .= '</div>';
        $html .= '<div class="website-footer">www.wisatasindangkasih.my.id</div>';
        $html .= '</div>';
    }
} else {
    $html .= '<p style="text-align: center; color: red;">No tickets found for this order.</p>';
}

$html .= '</div>';

// Initialize Dompdf
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsHtml5ParserEnabled(true); // Enable HTML5 support

$dompdf = new Dompdf($options);
$dompdf->setPaper("A4", "portrait");

$dompdf->loadHtml($html);
$dompdf->render();

// Clear output buffering
ob_clean();

// Stream the PDF to the browser
header('Content-Type: application/pdf');
$dompdf->stream("tiket.pdf", ["Attachment" => 0]);
?>
