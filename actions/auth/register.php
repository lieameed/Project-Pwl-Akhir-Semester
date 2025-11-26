<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "abc"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$email = $_POST['email'] ?? null;
$pass = $_POST['password'] ?? null;
$confirm = $_POST['confirm_password'] ?? null;

if ($pass !== $confirm) {
    echo "<script>alert('Passwords do not match!'); window.location.href='../../signup/index.php';</script>";
    exit;
}

$hashed = password_hash($pass, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $hashed);

if ($stmt->execute()) {
    echo "<script>alert('Account created successfully!'); window.location.href='../../login/index.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
