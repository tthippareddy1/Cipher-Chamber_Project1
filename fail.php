<?php
session_start();

// Get score (should be 0 or negative)
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

// Count all hints used
$totalHints = 0;
$totalHints += isset($_SESSION['hints']) ? $_SESSION['hints'] : 0;
$totalHints += isset($_SESSION['hints_puzzle1']) ? $_SESSION['hints_puzzle1'] : 0;
$totalHints += isset($_SESSION['hints_puzzle2']) ? $_SESSION['hints_puzzle2'] : 0;
$totalHints += isset($_SESSION['hints_puzzle3']) ? $_SESSION['hints_puzzle3'] : 0;

// Destroy session so they can restart
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>💀 Game Over</title>
</head>
<body>
  <h1>💀 Game Over! 💀</h1>
  <p>❌ Your score dropped to zero.</p>
  <p>✅ Final Score: <strong><?= htmlspecialchars($score) ?></strong></p>
  <p>💡 Total Hints Used: <strong><?= htmlspecialchars($totalHints) ?></strong></p>
  <p>But don't worry! You can try again:</p>
  <div class="button-container">
    <a href="index.php" class="restart-button">🔄 Play Again</a>
  </div>
</body>
</html>
