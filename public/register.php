<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    header('Location: index.php');
}
?>

<form method="POST">
    <input name="username" required>
    <input name="email" type="email" required>
    <input name="password" type="password" required>
    <button type="submit">Register</button>
</form>
