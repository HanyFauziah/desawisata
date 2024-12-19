<?php


// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

//GET DATA
$id_pemesanan = isset($_GET['id']) ? $_GET['id'] : null;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-TS8-EroayHy1HOIeDBxPparh';
Config::$clientKey = 'SB-Mid-client-NuefehYwTODRuB8s';
include '../../../includes/config.php';
include '../../../includes/db.php';
include '../../../includes/header.php';
$id_pemesanan = isset($_GET['id']) ? $_GET['id'] : null;
// Fetch pemesanan details

    // Simple query to fetch data from the database
    $query_pemesanan = "SELECT id_pengunjung, tgl_wisata, total_harga FROM pemesanan_tiket_satuan WHERE id = '$id_pemesanan'";
    // Execute the query
    $sql_pemesanan = mysqli_query($conn, $query_pemesanan);
    $data_pemesanan = mysqli_fetch_array($sql_pemesanan);
    $total_harga = $data_pemesanan['total_harga'];
    $id_pengunjung = $data_pemesanan['id_pengunjung'];

    $query_pengunjung = "SELECT nama, email, no_telp FROM pengunjung WHERE id = '$id_pengunjung'";
    $sql_pengunjung = mysqli_query($conn, $query_pengunjung);
    $data_pengunjung = mysqli_fetch_array($sql_pengunjung);
    $nama = $data_pengunjung['nama'];
    $email = $data_pengunjung['email'];
    $no_telp = $data_pengunjung['no_telp'];

// Proceed with the rest of your logic



printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
    'order_id' => $id_pemesanan,
    'gross_amount' => $total_harga, // This should be the correct value from the database
);// no decimal allowed for creditcard

// Optional
// $item_details = array (
//     array(
//         'id' => $id_pemesanan,
//         'price' => 94000,
//         'quantity' => 1,
//         'name' => "Apple"
//     ),
//   );
// Optional
$customer_details = array(
    'first_name'    => "$nama",
    'last_name'     => "",
    'email'         => "$email",
    'phone'         => "$no_telp",
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
// echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
}

?>

<!DOCTYPE html>
<html>
<body>
    <div class="container mt-5">
        <h2>Checkout</h2>
        <p>Anda akan melakukan pembayaran sebesar : <?php echo number_format($total_harga, 0, ',', '.'); ?></p>

        <!-- Stylish blue button with Font Awesome icon -->
        <button id="pay-button" class="btn btn-primary btn-lg w-100">
            <i class="fa fa-ticket"></i> Bayar
        </button>
        
        <!-- TODO: Remove ".sandbox" from script src URL for production environment -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey ?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token; ?>');
            };
        </script>
    </div>
</body>
</html>
