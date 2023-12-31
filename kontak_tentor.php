<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dist/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="relative mt-16 text-center">
        <div class="absolute inset-0">
            <img class="w-full h-48 object-top object-cover" src="./images/headerbg.png" alt="Background Image">
            <div class="w-full h-48 absolute inset-0 bg-black opacity-50"></div>
        </div>
    </div>

    <div class="relative mx-auto max-w-screen-lg"> 
        <h1 class="pt-7 mb-2 font-bold text-2xl text-white text-center" style="letter-spacing: 1px;">
            Level Up Your Coding Skills<br>with Aktual Cendekia Course.
        </h1>
        <p class="text-[18px] text-white sm:text-lg text-center">
            Whether you want to excel in web development, mobile development, or strengthen<br>basic software engineering skills, there is a course for you.
        </p>
    </div>

    <div class="pt-14 ml-16"> 
        <h1 class="mb-1 font-bold text-2xl" style="letter-spacing: 1px; color: #302B27;">
            Kontak Tentor
        </h1>
        <p class="" style="color: #302B27;">
            Punya pertanyaan tentang materimu? Silahkan bertanya ke tentor kita:
        </p>
        </div>

        <?php
        // Simpan koneksi ke database di sini (gunakan PDO atau MySQLi)
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'Aktual_Cendekia_Course';

        // Membuat koneksi
        $conn = new mysqli($hostname, $username, $password, $database);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data tentor dari database
        $sqlTentors = "SELECT * FROM users"; // Ganti nama_tabel_tentor dengan nama tabel tentor di database Anda

        // Eksekusi query dan ambil hasilnya
        $resultTentors = $conn->query($sqlTentors);

        // Display tentors as a full-width table
        echo '<table class="w-full table-auto text-center mt-8">';
        echo '<thead>';
        echo '<tr><th><div class="mb-4">Nama</th><th><div class="mb-4">No. Telpon</th><th><div class="mb-4">Alamat Email</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        if ($resultTentors->num_rows > 0) {
            while ($rowTentor = $resultTentors->fetch_assoc()) {
                echo '<tr>';
                echo '<td><div class="mb-4">' . $rowTentor['nama'] . '</td>';
                echo '<td><div class="mb-4">' . $rowTentor['no_telp'] . '</td>';
                echo '<td><div class="mb-4">' . $rowTentor['alamat_email'] . '</td>';
                echo '</tr>';
            }
        } else {
            // Handle query error
            echo '<tr><td colspan="3">Error: ' . $conn->error . '</td></tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // Close the database connection
        $conn->close();
        ?>
</body>
</html>
