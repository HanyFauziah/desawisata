<?php
include "../includes/db.php"; // Ensure session_start() is in db.php
include "../includes/header.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Capture form data
    $id_pengunjung = isset($_GET['id']) ? $_GET['id'] : null; // Replace this with the logged-in user's ID
    $tgl_wisata = $_POST['tgl_wisata'];
    $id_tiket_satuan = $_POST['id_tiket_satuan'];
    $jumlah_tiket = (int)$_POST['jumlah_tiket'];
    $total_harga = (int)$_POST['total_harga'];
    $status_pembayaran = 'belum_bayar';

    // Generate unique ID for the transaction
    $id_pemesanan_satuan = 'PS' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);

    // Insert into pemesanan_tiket_satuan
    $query_pemesanan = "INSERT INTO pemesanan_tiket_satuan (id, id_pengunjung, tgl_wisata, tgl_pemesanan, total_harga, status_pembayaran) 
                         VALUES ('$id_pemesanan_satuan', '$id_pengunjung', '$tgl_wisata', NOW(), '$total_harga', '$status_pembayaran')";
    
    if ($conn->query($query_pemesanan)) {
        // Insert into detail_pemesanan_tiket_satuan
        $query_detail = "INSERT INTO detail_pemesanan_tiket_satuan (id_pemesanan_satuan, id_tiket_satuan, jumlah_tiket, total_harga) 
                         VALUES ('$id_pemesanan_satuan', '$id_tiket_satuan', '$jumlah_tiket', '$total_harga')";
        
        if ($conn->query($query_detail)) {
            echo "<script>alert('Pesanan berhasil dibuat!');</script>";
            header("Location: detail_satuan.php?id=" . urlencode($id_pemesanan_satuan));
        } else {
            echo "<script>alert('Gagal menyimpan detail pesanan: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Gagal menyimpan pesanan: " . $conn->error . "');</script>";
    }

}

// Fetch the ticket types from the database
$query_tipe_tiket = "SELECT * FROM tipe_tiket_satuan";
$result_tipe_tiket = $conn->query($query_tipe_tiket);
?>
    <main>
    <div class="container mt-5 px-4 px-md-5 mb-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h2 class="fw-bold custom-heading">Pilih Tiket</h2>
            <p class="text-muted">Pilih tiket sesuai kebutuhan Anda dan atur jumlahnya.</p>
        </div>

        <!-- Success Message -->
        <?php if (isset($_GET['success']) && $_GET['success'] === 'true') : ?>
            <div id="success-message" class="bg-primary w-100 text-white p-3">
                Berhasil menambahkan tiket
            </div>
        <?php endif; ?>


        <!-- Form Section -->
        <div class="bg-white border rounded shadow-sm p-4">
            <form method="POST">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Tiket Tersedia</h4>
                    <a 
                        href="tiket_keranjang.php?id=<?php echo $_GET['id']; ?>" 
                        class="btn btn-outline-primary"
                    >
                        <i class="fas fa-ticket me-2"></i>Lihat Tiket
                    </a>
                </div>

                <?php while ($row_tipe_tiket = $result_tipe_tiket->fetch_assoc()) { ?>
                    <div class="border rounded p-3 mb-4" style="background-color: rgba(97, 186, 255, 0.1)">
                        <!-- Ticket Details -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="w-75">
                                <h5 class="fw-bold mb-2">
                                    <?php echo htmlspecialchars($row_tipe_tiket['nama_tiket']); ?>
                                </h5>
                                <p class="text-muted mb-1">
                                    <?php echo htmlspecialchars($row_tipe_tiket['deskripsi_tiket']); ?>
                                </p>
                                <small class="text-muted">Minimal Order: <?php echo htmlspecialchars($row_tipe_tiket['minimum_order']); ?></small>
                            </div>

                            <div class="text-end">
                                <p class="fw-bold fs-5 text-primary mb-0">
                                    Rp. <?php echo number_format($row_tipe_tiket['harga_tiket'], 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                        <hr>

                        <!-- Controls -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <!-- Decrement Button -->
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-secondary decrement-btn" 
                                    onclick="decrementValue('jumlah_<?php echo $row_tipe_tiket['id']; ?>')"
                                >
                                    <i class="fa fa-minus"></i>
                                </button>

                                <!-- Input -->
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    id="jumlah_<?php echo $row_tipe_tiket['id']; ?>" 
                                    value="<?php echo $row_tipe_tiket['minimum_order']; ?>" 
                                    min="<?php echo $row_tipe_tiket['minimum_order']; ?>" 
                                    class="form-control text-center" 
                                    style="width: 60px;"
                                >

                                <!-- Increment Button -->
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-secondary increment-btn" 
                                    onclick="incrementValue('jumlah_<?php echo $row_tipe_tiket['id']; ?>')"
                                >
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            <!-- Add to Cart -->
                            <a 
                                href="#" 
                                data-id="<?php echo $row_tipe_tiket['id']; ?>" 
                                class="btn btn-sm btn-success add-to-cart"
                            >
                                <i class="fa-solid fa-plus me-2"></i>Tambah
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </form>
            <a 
                        href="tiket_keranjang.php?id=<?php echo $_GET['id']; ?>" 
                        class="btn custom-submit-btn"
                    >
                        <i class="fas fa-ticket me-2"></i>Lanjutkan Pemesanan
                    </a>
        </div>
    </div>
</main>

<!-- Style and Script -->

<style>
    #success-message {
        transition: opacity 1s ease-out; /* Smooth fade-out effect */
    }
</style>

<script>
    function incrementValue(id) {
        const input = document.getElementById(id);
        input.value = parseInt(input.value) + 1;
    }

    function decrementValue(id) {
        const input = document.getElementById(id);
        const minValue = parseInt(input.min);
        if (parseInt(input.value) > minValue) {
            input.value = parseInt(input.value) - 1;
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const addToCartLinks = document.querySelectorAll(".add-to-cart");

        addToCartLinks.forEach((link) => {
            link.addEventListener("click", (event) => {
                event.preventDefault();
                const ticketId = link.dataset.id;
                const jumlahInput = document.getElementById(`jumlah_${ticketId}`);
                const jumlahValue = jumlahInput.value || 1;

                const baseUrl = "../proses/do_tambah_cart.php";
                const urlParams = new URLSearchParams({
                    id: ticketId,
                    pen: "<?php echo $_GET['id']; ?>",
                    jml: jumlahValue
                });

                window.location.href = `${baseUrl}?${urlParams}`;
            });
        });
    });


    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.opacity = '0'; // Start the fade-out effect
            setTimeout(() => {
                successMessage.style.display = 'none'; // Completely hide the element after fading
            }, 1000); // Wait for the fade-out transition to complete
        }
    }, 3000); 
</script>

<?php 
    include "../includes/footer.php"
?>
