<?php
session_start();

// Code untuk mengecek apakah user sudah login atau belum
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'tentor') {
    header('Location: login.php');
    exit();
}

// Connect to the database
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';

$conn = new mysqli($hostname, $username, $password, $database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tentor</title>
    <link rel="stylesheet" href="dist/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Tampilkan daftar siswa dan tugas yang sudah dikumpulkan di sini -->
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
        Dashboard
        </h1>
        <p class=""style="color: #302B27;">
        Halo! Berikut adalah jadwal kamu dari Senin sampai Kamis:
        </p>
        </div>

        <?php
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve the schedule for the currently logged-in tentor
        $loggedUsername = $_SESSION['username'];

        $sqlTentor = "SELECT * FROM users WHERE username = '$loggedUsername'";
        $resultTentor = $conn->query($sqlTentor);

        if ($resultTentor->num_rows > 0) {
            $tentorData = $resultTentor->fetch_assoc();
            $tentorId = $tentorData['id'];

            $sqlSchedule = "SELECT schedule.id, classes.class_name, subjects.subject_name, schedule.day, 
                            schedule.start_time, schedule.end_time
                            FROM schedule
                            INNER JOIN classes ON schedule.class_id = classes.id
                            INNER JOIN subjects ON schedule.subject_id = subjects.id
                            WHERE schedule.tentor_id = '$tentorId'";

            $resultSchedule = $conn->query($sqlSchedule);

            if ($resultSchedule->num_rows > 0) {
                echo '<table class="w-full table-auto text-center mt-8">';
                echo '<tr><th><div class="mb-4">Class</th><th><div class="mb-4">Subject</th><th><div class="mb-4">Day</th><th><div class="mb-4">Start Time</th><th><div class="mb-4">End Time</th></tr>';

                while ($rowSchedule = $resultSchedule->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td><div class="mb-4">' . $rowSchedule['class_name'] . '</td>';
                    echo '<td><div class="mb-4">' . $rowSchedule['subject_name'] . '</td>';
                    echo '<td><div class="mb-4">' . $rowSchedule['day'] . '</td>';
                    echo '<td><div class="mb-4">' . $rowSchedule['start_time'] . '</td>';
                    echo '<td><div class="mb-4">' . $rowSchedule['end_time'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo "No schedule found.";
            }
        } else {
            echo "Tentor not found.";
        }

        // Close the database connection
        $conn->close();
        ?>
</body>
</html>
