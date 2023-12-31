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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $queryCheckUsername = "SELECT * FROM users WHERE username = ?";
    
    try {
        $statementCheckUsername = $pdo->prepare($queryCheckUsername);
        $statementCheckUsername->bindParam(1, $username);
        $statementCheckUsername->execute();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    $resultCheckUsername = $statementCheckUsername->fetch(PDO::FETCH_ASSOC);

    if ($resultCheckUsername) {
        // Username sudah ada, tampilkan pesan error atau redirect ke halaman sign-up
        echo 'Username sudah digunakan. Silakan pilih username lain.';
    } else {
        // Jika username belum ada, simpan data ke database
        $queryInsertUser = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        
        try {
            $statementInsertUser = $pdo->prepare($queryInsertUser);
            $statementInsertUser->bindParam(1, $username);
            $statementInsertUser->bindParam(2, $hashedPassword);
            $statementInsertUser->bindParam(3, $role);
            $statementInsertUser->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        // Redirect ke halaman login atau halaman lainnya setelah sign-up berhasil
        header('Location: index.php');
        exit();
    }
} else {
    // Jika bukan metode POST, redirect ke halaman sign-up
    header('Location: signup.php');
    exit();
}
?>
