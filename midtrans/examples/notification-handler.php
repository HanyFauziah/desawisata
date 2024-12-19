<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for sample HTTP notifications:
// https://docs.midtrans.com/en/after-payment/http-notification?id=sample-of-different-payment-channels

namespace Midtrans;

require_once dirname(__FILE__) . '/../Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-TS8-EroayHy1HOIeDBxPparh';

// non-relevant function only used for demo/example purpose
if (Config::$isProduction == false) {
    printExampleWarningMessage();
}

try {
    $notif = new Notification();
}
catch (\Exception $e) {
    exit($e->getMessage());
}

$notif = $notif->getResponse();
$transaction = $notif->transaction_status;
$transaction_id = $notif->transaction_id;

$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

if ($transaction == 'settlement') {
   include "../../includes/db.php";
   mysqli_query($conn, "UPDATE pemesanan_tiket_satuan SET status_pembayaran='1' WHERE id='$order_id'");
   exit();
} else if ($transaction == 'pending') {
       include "../../includes/db.php";
       mysqli_query($conn, "UPDATE pemesanan_tiket_satuan SET status_pembayaran='2' WHERE id='$order_id'");
 
} else if ($transaction == 'deny') {
      include "../../includes/db.php";
   mysqli_query($conn, "UPDATE pemesanan_tiket_satuan SET status_pembayaran='3' WHERE id='$order_id'");
 
    
} else if ($transaction == 'expire') {
       include "../../includes/db.php";
       mysqli_query($conn, "UPDATE pemesanan_tiket_satuan SET status_pembayaran='4' WHERE id='$order_id'");
 
      
} else if ($transaction == 'cancel') {
     include "../../includes/db.php";
     mysqli_query($conn, "UPDATE pemesanan_tiket_satuan SET status_pembayaran='5' WHERE id='$order_id'");
}

function printExampleWarningMessage() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo "jsnskssjs";
        exit();
    }
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<Server Key>\';');
        die();
    }   
}
