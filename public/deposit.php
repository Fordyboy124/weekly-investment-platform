<?php
require '../config/db.php';
require '../includes/session.php';
require_login();

// Assume amount is passed from a form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $userId = $_SESSION['user_id'];

    // Record pending transaction
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount, reference, status) VALUES (?, 'deposit', ?, ?, 'pending')");
    $ref = uniqid('ref_');
    $stmt->execute([$userId, $amount, $ref]);

    // Redirect to Flutterwave payment page (pseudo code)
    header("Location: https://flutterwave.com/pay/$ref");
    exit;
}
?>
