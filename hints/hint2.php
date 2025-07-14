<?php
session_start();

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 100;
}

if (!isset($_SESSION['hints_puzzle2'])) {
    $_SESSION['hints_puzzle2'] = 0;
}

// Determine return link
$from = isset($_GET['from']) ? $_GET['from'] : '../puzzles/puzzle2.php';

// Add hint if not maxed out
if ($_SESSION['hints_puzzle2'] < 3) {
    $_SESSION['hints_puzzle2'] += 1;
    $_SESSION['score'] -= 20;
}

// Define hints
$allHints = [
    1 => "Hint 1: It's a common fruit.",
    2 => "Hint 2: It's often red or green.",
    3 => "Hint 3 (Answer): It's an apple."
];

// Collect visible hints
$visibleHints = [];
for ($i = 1; $i <= $_SESSION['hints_puzzle2']; $i++) {
    $visibleHints[] = $allHints[$i];
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles.css">
  <title>The PHP Vault - Puzzle 2 Hints</title>
</head>
<body>
  <h1>💡 Hints for Puzzle 2</h1>

  <?php foreach ($visibleHints as $hint): ?>
    <p class="hint"><?= htmlspecialchars($hint) ?></p>
  <?php endforeach; ?>

  <?php if ($_SESSION['hints_puzzle2'] < 3): ?>
    <p><a href="hint2.php?from=<?= urlencode($from) ?>">Get another hint (-20 points)</a></p>
  <?php else: ?>
    <p><strong>✅ You've unlocked all hints!</strong></p>
  <?php endif; ?>

  <p>✅ Score: <strong><?= $_SESSION['score'] ?></strong><br>
     💡 Hints Used for this puzzle: <strong><?= $_SESSION['hints_puzzle2'] ?></strong></p>

  <p><a href="<?= htmlspecialchars($from) ?>">⬅️ Back to Puzzle</a></p>
</body>
</html>
