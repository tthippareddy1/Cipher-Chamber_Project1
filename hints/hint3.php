<?php
session_start();

// Score safety check
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 100;
}

// Initialize hints counter for puzzle 3
if (!isset($_SESSION['hints_puzzle3'])) {
    $_SESSION['hints_puzzle3'] = 0;
}

// Determine return link
$from = isset($_GET['from']) ? $_GET['from'] : '../puzzles/puzzle3.php';

// Increment hints (max 3)
if ($_SESSION['hints_puzzle3'] < 3) {
    $_SESSION['hints_puzzle3'] += 1;
    $_SESSION['score'] -= 20;
}

// Define hints
$allHints = [
    1 => "Hint 1: It's always with you in light.",
    2 => "Hint 2: It disappears in the dark.",
    3 => "Hint 3 (Answer): It's your shadow."
];

// Gather visible hints
$visibleHints = [];
for ($i = 1; $i <= $_SESSION['hints_puzzle3']; $i++) {
    $visibleHints[] = $allHints[$i];
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles.css">
  <title>The PHP Vault - Puzzle 3 Hints</title>
</head>
<body>
  <h1>💡 Hints for Puzzle 3</h1>

  <?php foreach ($visibleHints as $hint): ?>
    <p class="hint"><?= htmlspecialchars($hint) ?></p>
  <?php endforeach; ?>

  <?php if ($_SESSION['hints_puzzle3'] < 3): ?>
    <p><a href="hint3.php?from=<?= urlencode($from) ?>">Get another hint (-20 points)</a></p>
  <?php else: ?>
    <p><strong>✅ You've unlocked all hints!</strong></p>
  <?php endif; ?>

  <p>✅ Score: <strong><?= $_SESSION['score'] ?></strong><br>
     💡 Hints Used for this puzzle: <strong><?= $_SESSION['hints_puzzle3'] ?></strong></p>

  <p><a href="<?= htmlspecialchars($from) ?>">⬅️ Back to Puzzle</a></p>
</body>
</html>
