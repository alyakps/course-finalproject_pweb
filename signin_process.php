<?php
session_start();

// Koneksi ke database
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // Set mode error PDO menjadi exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// ...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check user in the database
    $queryCheckUser = "SELECT * FROM users WHERE username = ?";

    try {
        $statementCheckUser = $pdo->prepare($queryCheckUser);
        $statementCheckUser->bindParam(1, $username);
        $statementCheckUser->execute();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    $userData = $statementCheckUser->fetch(PDO::FETCH_ASSOC);

    // Debugging output
    echo "Username: $username<br>";
    echo "Password: $password<br>";
    echo "Hashed Password in Database: {$userData['password']}<br>";
    echo "Role in Database: {$userData['role']}<br>";

    if ($userData) {
        // User ditemukan, periksa password
        if (password_verify($password, $userData['password'])) {
            // Password cocok, set session dan redirect ke dashboard
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $userData['role'];
            $_SESSION['nama'] = $userData['nama'];

            // Debugging output
            echo "Role set in session: {$_SESSION['role']}<br>";

            // Redirect ke halaman dashboard sesuai role
            if ($userData['role'] == 'siswa') {
                header('Location: siswa_dashboard.php');
            } elseif ($userData['role'] == 'tentor') {
                header('Location: tentor_dashboard.php');
            } else {
                // Handle role lainnya jika diperlukan
            }
            exit();
        } else {
            // Password tidak cocok, tampilkan pesan error atau redirect ke halaman sign in
            echo 'Password tidak cocok.';
        }
    } else {
        // User tidak ditemukan, tampilkan pesan error atau redirect ke halaman sign in
        echo 'User tidak ditemukan.';
    }
} else {
    // Jika bukan metode POST, redirect ke halaman sign in
    header('Location: signin.php');
    exit();
}


?>
