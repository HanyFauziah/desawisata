<?php
include "../includes/db.php"; // Ensure session_start() is in db.php
include "../includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
// Get form inputs
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_telp = $_POST['no_telp'];

// SQL query to find the maximum numeric part 
$query = "SELECT MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)) AS last_id FROM pengunjung";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $last_id = $row['last_id'] ?? 0; // Default to 0 if no rows exist
    $new_id = 'PE' . str_pad($last_id + 1, 6, '0', STR_PAD_LEFT); // Generate new ID

    // Prepare the SQL statement for inserting data
    $sql = "INSERT INTO pengunjung (id, nama, email, no_telp) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $new_id, $nama, $email, $no_telp);

    // Execute and check success
    if ($stmt->execute()) {
        header("Location: pesan_tiket_satuan.php?id=" . urlencode($new_id));
        exit(); 
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error fetching last ID: " . $conn->error;
}

$conn->close();

}
?>
<main>
<div class="container mt-5 p-4 ">
    <!-- Heading -->
    <div class="text-center mb-5">
        <h2 class="custom-heading">Pesan Tiket</h2>
        <p class="text-muted">Isi data diri Anda dengan lengkap untuk melanjutkan pemesanan.</p>
    </div>

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="custom-container">
                <form method="POST" class="custom-form">
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="nama" 
                            name="nama" 
                            placeholder="Masukkan nama lengkap Anda" 
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email" 
                            name="email" 
                            placeholder="Masukkan email aktif Anda" 
                            required
                        >
                    </div>

                    <!-- No Telepon -->
                    <div class="mb-4">
                        <label for="no_telp" class="form-label">No Telepon</label>
                        <input 
                            type="tel" 
                            class="form-control" 
                            id="no_telp" 
                            name="no_telp" 
                            placeholder="Contoh: 081234567890" 
                            pattern="^\d{10,15}$" 
                            title="Masukkan nomor telepon yang valid (10-15 angka)" 
                            required
                        >
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="custom-submit-btn">
                            Lanjut ke Pemesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>


<style>
    .custom-container {
        background-color:rgb(255, 255, 255);
        border-radius: 12px;
    }

    .custom-heading {
        color: #6c63ff;
        font-weight: bold;
        font-size: 2rem;
    }

    .custom-form {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }

    .custom-form label {
        font-weight: 600;
        color: #4a4a4a;
    }

    .custom-form input {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem;
    }

    .custom-form input:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
    }

    .custom-submit-btn {
        background-color: #6c63ff;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1.25rem;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .custom-submit-btn:hover {
        background-color: #5754d8;
    }
</style>


<?php
	include '../includes/footer.php';
?>