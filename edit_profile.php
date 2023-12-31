<?php
session_start();

// Koneksi ke database (gantilah nilai sesuai dengan konfigurasi database Anda)
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil informasi profil pengguna dari database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $informasiProfil = $row;
} else {
    echo "Informasi profil tidak ditemukan.";
}

// Proses formulir jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBaru = $_POST['nama'];
    $noTelpBaru = $_POST['no_telp'];
    $usiaBaru = $_POST['usia'];
    $emailBaru = $_POST['alamat_email'];

    // Simpan perubahan pada profil
    $sqlUpdate = "UPDATE users SET nama = '$namaBaru', no_telp = '$noTelpBaru', usia = $usiaBaru, alamat_email = '$emailBaru' WHERE username = '$username'";
    
    if ($conn->query($sqlUpdate) === TRUE) {
        // Simpan nama baru ke dalam session
        $_SESSION['nama'] = $namaBaru;

        // Redirect ke halaman profil setelah menyimpan perubahan
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Pengguna</title>
</head>
<body>

<h1>Edit Profil Pengguna</h1>

<!-- Formulir untuk mengedit profil -->
<form method="post" action="edit_profile.php">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" value="<?php echo $informasiProfil['nama']; ?>" required><br>

    <label for="no_telp">No Telepon:</label>
    <input type="tel" name="no_telp" value="<?php echo $informasiProfil['no_telp']; ?>" required><br>

    <label for="usia">Usia:</label>
    <input type="number" name="usia" value="<?php echo $informasiProfil['usia']; ?>" required><br>

    <label for="alamat_email">Email:</label>
    <input type="email" name="alamat_email" value="<?php echo $informasiProfil['alamat_email']; ?>" required><br>

    <input type="submit" value="Simpan Perubahan">
</form>

</body>
</html>
