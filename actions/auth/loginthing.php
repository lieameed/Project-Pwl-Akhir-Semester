<?php
require_once '../../config/db-connections.php';
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {

        if (password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
            header('Location: ../../homepage/index.php');
            exit;
        } 

        echo "<script>alert('Email or password wrong'); window.location.href='../../login/index.php';</script>";
        exit;
    }

    echo "<script>alert('Email or password wrong'); window.location.href='../../login/index.php';</script>";
    exit;
}
?>
