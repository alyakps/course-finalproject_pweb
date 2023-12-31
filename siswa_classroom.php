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
            Classroom
        </h1>
        <p class="" style="color: #302B27;">
            Jangan lupa pantau tugas kamu yaa
        </p>
        </div>

        <?php
        // Connect to the database
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'Aktual_Cendekia_Course';

        $conn = new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch assignments for Aelita Stones
        $sqlAssignments = "SELECT subjects.subject_name, assignments.file_path, assignments.is_submitted
                           FROM assignments
                           INNER JOIN subjects ON assignments.subject_id = subjects.id
                           WHERE assignments.student_id = 3"; // Assuming Aelita Stones has user_id 2

        $resultAssignments = $conn->query($sqlAssignments);

        if ($resultAssignments->num_rows > 0) {
            echo '<table class="w-full table-auto text-center mt-8">';
            echo '<tr><th><div class="mb-4">Subject</th><th><div class="mb-4">File Path</th><th><div class="mb-4">Submitted</th></tr>';
        
            while ($rowAssignment = $resultAssignments->fetch_assoc()) {
                echo '<tr>';
                echo '<td><div class="mb-4">' . $rowAssignment['subject_name'] . '</div></td>';
                echo '<td><div class="mb-4">' . $rowAssignment['file_path'] . '</div></td>';
                echo '<td><div class="mb-4">' . ($rowAssignment['is_submitted'] ? 'Yes' : 'No') . '</div></td>';
                echo '</tr>';
            }
        
            echo '</table>';
        } else {
            echo "No assignments found.";
        }
        
        

        // Close the database connection
        $conn->close();
        ?>
</body>
</html>
