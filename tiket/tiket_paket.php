<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include necessary files
include 'includes/header.php';
include 'includes/config.php';
include 'includes/db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the form fields are not empty
    if (isset($_POST['nama'], $_POST['email'], $_POST['no_telp']) && !empty($_POST['nama']) && !empty($_POST['email']) && !empty($_POST['no_telp'])) {
        
        // Get form data
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $no_telp = $_POST['no_telp'];

        // Step 1: Generate a new id_pengunjung
        $query = "SELECT MAX(CAST(SUBSTRING(id, 2) AS UNSIGNED)) AS last_id FROM pengunjung";
        $result = $conn->query($query);

        // Check if query ran successfully
        if (!$result) {
            echo "Error executing query: " . $conn->error;
            exit;
        }

        $row = $result->fetch_assoc();
        $last_id = $row['last_id'] ?? 0;
        $new_id = 'PE' . str_pad($last_id + 1, 5, '0', STR_PAD_LEFT);

        // Prepare SQL query to insert data into the table
        $sql = "INSERT INTO pengunjung (id, nama, email, no_telp) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssss", $new_id, $nama, $email, $no_telp);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Data berhasil disimpan!";
            } else {
                echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Terjadi kesalahan dalam persiapan query: " . $conn->error;
        }
    } else {
        echo "Harap lengkapi semua kolom!";
    }
}
?>

<main>
    <div class="container mt-5 pb-5 px-5">
        <!-- Data Diri Form -->
        <h2 class="mb-4 fd-2">Pesan Tiket Satuan</h2>

        <form method="POST">
            <p class="text-fs-2">Isi Data Diri Terlebih Dahulu</p>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="nama" 
                    name="nama" 
                    placeholder="Masukkan nama Anda" 
                    required
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="Masukkan email Anda" 
                    required
                >
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon:</label>
                <input 
                    type="tel" 
                    class="form-control" 
                    id="no_telp" 
                    name="no_telp" 
                    placeholder="Masukkan nomor telepon Anda" 
                    pattern="^\d{10,15}$" 
                    title="Masukkan nomor telepon yang valid (10-15 angka)" 
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">Lanjut ke pemesanan</button>
        </form>
    </div>
</main>



<?php
	include 'includes/footer.php';
?>