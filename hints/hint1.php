<?php
session_start();

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 100;
}
if (!isset($_SESSION['hints'])) {
    $_SESSION['hints'] = 0;
}

// Determine where to go back
$from = isset($_GET['from']) ? $_GET['from'] : '../puzzles/puzzle1.php';

// Check if hints already at max
if ($_SESSION['hints'] < 3) {
    $_SESSION['hints'] += 1;
    $_SESSION['score'] -= 20;
}

// Prepare hints
$allHints = [
    1 => "Hint 1: It's a single-digit number.",
    2 => "Hint 2: Double me, then add 6 = 14.",
    3 => "Hint 3 (Answer): The number is 4."
];

// Build visible hints
$visibleHints = [];
for ($i = 1; $i <= $_SESSION['hints']; $i++) {
    $visibleHints[] = $allHints[$i];
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles.css">
  <title>The PHP Vault - Puzzle 1 Hints</title>
</head>
<body>
  <h1>💡 Hints for Puzzle 1</h1>

  <?php foreach ($visibleHints as $hint): ?>
    <p class="hint"><?= htmlspecialchars($hint) ?></p>
  <?php endforeach; ?>

  <?php if ($_SESSION['hints'] < 3): ?>
    <p><a href="hint1.php?from=<?= urlencode($from) ?>">Get another hint (-20 points)</a></p>
  <?php else: ?>
    <p><strong>✅ You've unlocked all hints!</strong></p>
  <?php endif; ?>

  <p>✅ Score: <strong><?= $_SESSION['score'] ?></strong><br>
     💡 Hints Used: <strong><?= $_SESSION['hints'] ?></strong></p>

  <p><a href="<?= htmlspecialchars($from) ?>">⬅️ Back to Puzzle</a></p>
</body>
</html>
