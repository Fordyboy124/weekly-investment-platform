<?php
require '../config/db.php';
require '../includes/session.php';
require_login();

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT wallet_balance, last_transaction FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

$now = new DateTime();
$last = new DateTime($user['last_transaction']);
$interval = $last->diff($now)->days;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $interval >= 7) {
    $amount = $_POST['amount'];
    if ($amount <= $user['wallet_balance']) {
        $pdo->prepare("INSERT INTO transactions (user_id, type, amount, status) VALUES (?, 'withdrawal', ?, 'pending')")
            ->execute([$userId, $amount]);

        $pdo->prepare("UPDATE users SET wallet_balance = wallet_balance - ?, last_transaction = NOW() WHERE id = ?")
            ->execute([$amount, $userId]);

        echo "Withdrawal request submitted.";
    } else {
        echo "Insufficient balance.";
    }
}
?>

<form method="POST">
    <input name="amount" type="number" step="0.01" required>
    <button type="submit" <?= $interval < 7 ? 'disabled' : '' ?>>Withdraw</button>
</form>
