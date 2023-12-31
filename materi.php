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

// Ambil data mata pelajaran dari database
$sqlSubjects = "SELECT * FROM subjects";

// Eksekusi query dan ambil hasilnya
$resultSubjects = $conn->query($sqlSubjects);

// Inisialisasi array untuk menyimpan data mata pelajaran
$subjects = array();

if ($resultSubjects->num_rows > 0) {
    while ($rowSubject = $resultSubjects->fetch_assoc()) {
        $subjects[] = $rowSubject;
    }
} else {
    // Handle query error
    echo "Error: " . $conn->error;
}

?>
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
        Materi
        </h1>
        <p class=""style="color: #302B27;">
        Halo! Berikut adalah materi pembelajaranmu:
        </p>
        
    </div>

    <div class="container mx-auto pt-8">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
    <?php foreach ($subjects as $subject): ?>
    <?php if ($subject['subject_name'] !== 'Istirahat'): ?>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <?php if (isset($subject['subject_name'])): ?>
                <h2 class="text-xl font-semibold mb-2"><?= $subject['subject_name'] ?></h2>
            <?php else: ?>
                <p class="text-red-500">Subject name not available</p>
            <?php endif; ?>
            <p class="text-gray-600"><?= $subject['id'] ?></p>
        </div>
    <?php endif; ?>
<?php endforeach; ?>


    </div>
</div>



</body>
</html>
