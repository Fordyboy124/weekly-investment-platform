<?php
require '../config/db.php';
require '../includes/session.php';
require_login();

$stmt = $pdo->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$transactions = $stmt->fetchAll();

foreach ($transactions as $t) {
    echo "{$t['type']} - {$t['amount']} - {$t['status']} - {$t['created_at']}<br>";
}
?>

