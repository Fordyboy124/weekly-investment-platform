<?php
require '../config/db.php';

// Run weekly via cron
$stmt = $pdo->query("SELECT id, wallet_balance FROM users");

while ($user = $stmt->fetch()) {
    $profit = $user['wallet_balance'] * 0.10;
    if ($profit > 0) {
        $pdo->prepare("UPDATE users SET wallet_balance = wallet_balance + ? WHERE id = ?")
            ->execute([$profit, $user['id']]);

        $pdo->prepare("INSERT INTO profit_logs (user_id, amount) VALUES (?, ?)")
            ->execute([$user['id'], $profit]);
    }
}
?>
