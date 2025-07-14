<?php
session_start();

// Check if they completed the last puzzle
if (!isset($_SESSION['level']) || $_SESSION['level'] < 3) {
    header('Location: index.php');
    exit;
}

// Store final score
$finalScore = $_SESSION['score'];

// Compute total hints used across all puzzles
$totalHintsUsed = 
    ($_SESSION['hints'] ?? 0) +
    ($_SESSION['hints_puzzle1'] ?? 0) +
    ($_SESSION['hints_puzzle2'] ?? 0) +
    ($_SESSION['hints_puzzle3'] ?? 0);

// Optional: Destroy session so they can restart fresh
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Congratulations! - The PHP Vault</title>
</head>
<body>
  <h1 class="victory-heading">🎉 Congratulations! 🎉</h1>

  <div class="victory-box">
    <p>✅ You successfully escaped The Cipher Chamber!</p>
    <p>🏆 Your Final Score: <strong><?= htmlspecialchars($finalScore) ?></strong></p>
    <p>💡 Hints Used: <strong><?= htmlspecialchars($totalHintsUsed) ?></strong></p>
  </div>

  <div class="button-container">
    <a href="index.php" class="restart-button">🔄 Play Again</a>
  </div>
</body>
</html>
