<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $class_token = $_POST["class"];

    // Get the class_id based on the provided class_token
// Get the class_id based on the provided class_token
$class_id_query = "SELECT id FROM classes WHERE id = '$class_token'";
$class_id_result = $conn->query($class_id_query);

// Debugging
echo "Class ID Query: " . $class_id_query . "<br>";

if ($class_id_result) {
    if ($class_id_result->num_rows > 0) {
        $class_id_row = $class_id_result->fetch_assoc();
        $class_id = $class_id_row["id"];

        // Debugging
        echo "Class ID: " . $class_id . "<br>";
    } else {
        echo "No rows found for the given class token<br>";
    }
} else {
    echo "Error in class ID query: " . $conn->error . "<br>";
}

}

$conn->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="dist/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    

<div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="signup_process.php" method="post" id="signupForm">
    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign up for our platform</h5>
    <div>
        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Make Your New Username</label>
        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Username" required>
    </div>

    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Make password</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Your Role</label>
        <div>
            <input type="radio" name="role" value="siswa" id="siswaRadio"> <span class="text-sm font-medium text-gray-900 dark:text-white">Siswa</span>
            <input type="radio" name="role" value="tentor" id="tentorRadio"> <span class="text-sm font-medium text-gray-900 dark:text-white">Tentor</span>
        </div>
    </div>

    <div id="kelasContainer" style="display: none;">
    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Your Class Token</label>
    <input type="text" name="class" id="class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Class Token">
</div>

            <button type="submit" class="bg-black hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" href="edit_profile.php">Register</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Event listener for role selection
            $('input[type=radio][name=role]').change(function () {
                if (this.value === 'siswa') {
                    $('#kelasContainer').show();
                } else {
                    $('#kelasContainer').hide();
                }
            });
        });
    </script>

</body>
</html>