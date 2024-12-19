<?php 
    include "../includes/db.php"; // Ensure session_start() is in db.php
    include "../includes/header.php";
?>

<main>
    <div class="container px-5 mt-4">
        <!-- Header Section -->
        <div class="mb-4  p-3">
            <div class="d-flex align-items-center gap-3">
                <a href="pesan_tiket_satuan.php?id=<?php echo $_GET['id'] ?>" class="text-decoration-none text-dark">
                    <i class="fs-4 fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="m-0 custom-heading">Tiket yang Dipesan</h2>
            </div>
        </div>

        <!-- Date Input Section -->
        <div class="mb-3 border rounded-3 p-3">
            <label for="tgl_wisata" class="form-label">Pilih Tanggal Wisata</label>
            <input 
                type="date" 
                class="form-control" 
                id="tgl_wisata" 
                name="tgl_wisata" 
                min="<?php echo date('Y-m-d'); ?>" 
                required
            >
        </div>

        <!-- Cart Items -->
        <?php 
        if (!empty($_SESSION["cart"])) {
            $grandtotal = 0;
            foreach ($_SESSION["cart"] as $cart => $val) {
                $subtotal = $val["harga"] * $val["jumlah"];
        ?>
            <div class="mb-3 border rounded-3 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 fw-bold"><?php echo htmlspecialchars($val["nama"]); ?></p>
                        <p class="mb-0">Rp. <?php echo number_format($val["harga"], 0, ',', '.'); ?></p>
                        <small><?php echo intval($val["jumlah"]); ?> Tiket</small>
                    </div>
                    <a href="../proses/do_hapus_cart.php?id=<?php echo $cart ?>&pen=<?php echo $_GET['id'] ?>" 
                       class="btn btn-sm btn-danger">Hapus</a>
                </div>
            </div>
        <?php 
                $grandtotal += $subtotal;
            } 
        ?>
        <!-- Grand Total Section -->
        <div class="mb-3 border rounded-3 p-3">
            <h4 class="m-0">Total: Rp. <?php echo number_format($grandtotal, 0, ',', '.'); ?></h4>
        </div>

        <!-- Button for Transaction -->
        <a href="../proses/do_tambah_transaksi.php?pen=<?php echo $_GET['id'] ?>&total=<?php echo $grandtotal ?>" 
           id="beli-button" 
           class="btn custom-submit-btn w-100">Pesan Tiket</a>

        <?php 
        } else { 
            echo '<div class="text-center border rounded-3 p-3">Belum ada tiket <br> <a href="pesan_tiket_satuan.php?id=' . $_GET['id'] . '">Pilih Tiket</a></div>';
            
        } 
        ?>
    </div>
</main>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the date input and the 'Beli' button
        const tglInput = document.getElementById('tgl_wisata');
        const beliButton = document.getElementById('beli-button');
        
        // Add event listener to 'Beli' button
        beliButton.addEventListener('click', function(event) {
            // Get the value of the date input field
            const tglValue = tglInput.value;
            
            if (tglValue) {
                // Append the selected date to the 'href' of the button
                const currentHref = beliButton.getAttribute('href');
                const newHref = currentHref + "&tgl=" + tglValue;
                
                // Update the button's 'href' attribute
                beliButton.setAttribute('href', newHref);
            } else {
                alert("Pilih tanggal kunjungan.");
                event.preventDefault(); // Prevent the link from navigating if no date is selected
            }
        });
    });
</script>


<?php 
    include "../includes/footer.php"
?>
