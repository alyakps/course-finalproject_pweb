<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Database connection details (replace with your actual values)
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $informasiProfil = $row;
} else {
    echo "User information not found.";
    exit();
}

// Initialize the $stmtCheck variable
$stmtCheck = null;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    // Check if the new username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
    $stmtCheck = $conn->prepare($checkUsernameQuery);
    $stmtCheck->bind_param("s", $newUsername);
    $stmtCheck->execute();
    $checkResult = $stmtCheck->get_result();

    if ($checkResult->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update username and hashed password in the database
        $sqlUpdate = "UPDATE users SET username = ?, password = ? WHERE username = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("sss", $newUsername, $hashedPassword, $username);

        if ($stmtUpdate->execute()) {
            // Redirect to profile page after updating
            $_SESSION['username'] = $newUsername; // Update session with new username
            header('Location: profile.php');
            exit();
        } else {
            echo "Error updating record: " . $stmtUpdate->error;
        }
    }
}

// Close the database connection
$stmt->close();

// Close $stmtCheck if it's not null
if ($stmtCheck !== null) {
    $stmtCheck->close();
}

// Close $stmtUpdate if it's not null
if (isset($stmtUpdate)) {
    $stmtUpdate->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Username & Password</title>
</head>
<body>

<h1>Edit Username & Password</h1>

<!-- Form to edit username and password -->
<form method="post" action="edit_username_password.php">
    <label for="new_username">New Username:</label>
    <input type="text" name="new_username" value="<?php echo $informasiProfil['username']; ?>" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required><br>

    <input type="submit" value="Save Changes">
</form>

</body>
</html>
