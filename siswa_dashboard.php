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

// Ambil data jadwal siswa dari database (sesuaikan dengan struktur tabel Anda)
$sql = "SELECT * FROM schedule ORDER BY FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis'), start_time";

// Eksekusi query dan ambil hasilnya
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan jadwal siswa
$scheduleData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scheduleData[$row['day']][] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="dist/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

    <!-- <div class="mt-16">
        <a href="logout.php" class="block text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
            Logout
        </a>
    </div> -->
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
        Dashboard
        </h1>
        <p class=""style="color: #302B27;">
        Halo! Berikut adalah jadwal kamu dari Senin sampai Kamis:
        </p>
        
    </div>
    <div class="pt-14 ml-16"> 
    <?php if (!empty($scheduleData)) : ?>
        <?php foreach ($scheduleData as $day => $daySchedules) : ?>
            <h2 class="text-xl font-bold mt-4" style="color: #302B27;"><?= $day ?></h2>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php foreach ($daySchedules as $scheduleItem) : ?>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-1 min-w-0 ms-4">
                                    <?php
                                    // Replace "MTH10" with "Matematika"
                                    $subjectMappings = [
                                        'MTH10' => 'Matematika',
                                        'SNS10' => 'Sains',
                                        'PHY10' => 'Fisika',
                                        'BREAK' => 'Istirahat',
                                        'ENG10' => 'English',
                                        'CHM10' => 'Kimia',
                                        'BIO10' => 'Biologi',
                                        'ACC10' => 'Akuntansi',
                                    ];
                                    
                                    $subjectName = isset($subjectMappings[$scheduleItem['subject_id']]) ? $subjectMappings[$scheduleItem['subject_id']] : $scheduleItem['subject_id'];
                                    
                                    ?>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        <?= $scheduleItem['class_id'] ?> - <?= $subjectName ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        <?= $scheduleItem['day'] ?>, <?= $scheduleItem['start_time'] ?> - <?= $scheduleItem['end_time'] ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Tidak ada jadwal siswa yang tersedia.</p>
    <?php endif; ?>
</div>

</body>
</html>
