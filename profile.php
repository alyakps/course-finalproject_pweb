<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Ganti nilai ini sesuai dengan konfigurasi database Anda
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';

// Koneksi ke database
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
    // Proses upload gambar disini (mungkin menggunakan library seperti move_uploaded_file)
    // Simpan nama file gambar yang diupload ke kolom profilepicture di database
    $namaFile = $_FILES['foto_profil']['name'];
    // Simpan perubahan pada profil
    $sqlUpdate = "UPDATE users SET profilepicture = '$namaFile' WHERE username = '$username'";
    
    if ($conn->query($sqlUpdate) === TRUE) {
        // Perbarui informasi profil setelah penyimpanan perubahan
        $informasiProfil['profilepicture'] = $namaFile;
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
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="dist/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
    <style>
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
        }
        a {
            margin-top: 10px;
            text-decoration: none;
            color: #000; /* Warna teks hitam */
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s; /* Transisi untuk warna latar belakang dan teks */
        }

        
    </style>
</head>
<body>

<div class="pt-14 ml-16"> 
        <h1 class="mb-1 font-bold text-2xl" style="letter-spacing: 1px; color: #302B27;">
            Profil Pengguna
        </h1>
        <p class="" style="color: #302B27;">
            Silahkan melihat profil anda
        </p>
        </div>

<!-- Tampilkan informasi profil -->
<div class="pt-14 ml-16"> 
            <h2 class="text-xl font-bold mt-4" style="color: #302B27;"></h2>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>Nama Panggilan:</label>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-1 min-w-0 ms-4">
                                <?php echo $informasiProfil['nama']; ?>
                                </div>
                            </div>
                        </li>
                </ul>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>Username:</label>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                        <?php echo $informasiProfil['username']; ?>
                        </div>
                    </div>
                </li>
                </ul>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>Password:</label>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                        <?php echo $informasiProfil['password']; ?>
                        </div>
                    </div>
                </li>
                </ul>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>Profile Picture:</label>
                <li class="py-3 sm:py-4">
                    <?php echo $informasiProfil['profilepicture']; ?> 
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" name="foto_profil">
                            <input class="bg-black hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" type="submit" value="Upload Foto Profil">
                        </form>
                </li>
                </ul>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>No Telepon:</label>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                        <?php echo $informasiProfil['no_telp']; ?>
                        </div>
                    </div>
                </li>
                </ul>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>Usia:</label>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                        <?php echo $informasiProfil['usia']; ?>
                        </div>
                    </div>
                </li>
                </ul>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <label>Alamat Email:</label>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                        <?php echo $informasiProfil['alamat_email']; ?>
                        </div>
                    </div>
                </li>
                </ul>
                <a class="bg-black hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" href="edit_profile.php">Edit Profil</a>
                <a class="bg-black hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" href="edit_username_password.php">Edit Username & Password</a>
                <a class="bg-black hover:bg-red-900 text-white font-bold py-2 px-4 rounded" href="logout.php">Logout</a>
            </div>

</div>
</body>
</html>
