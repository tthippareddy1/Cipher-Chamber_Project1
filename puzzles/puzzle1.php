<?php
session_start();

// If no score yet, initialize to 100
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 100;
}

if (!isset($_SESSION['hints'])) {
    $_SESSION['hints'] = 0;
}
// Fail if score already 0 or less
if ($_SESSION['score'] <= 0) {
    header('Location: ../fail.php');
    exit;
}

// Initialize per-puzzle hints if needed
if (!isset($_SESSION['hints_puzzle1'])) {
    $_SESSION['hints_puzzle1'] = 0;
}
if (!isset($_SESSION['hints_puzzle2'])) {
    $_SESSION['hints_puzzle2'] = 0;
}
if (!isset($_SESSION['hints_puzzle3'])) {
    $_SESSION['hints_puzzle3'] = 0;
}

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answer = strtolower(trim($_POST['answer']));
    if ($answer === '4') {
        $_SESSION['level'] = 2;
        header('Location: ../loading.php?next=puzzles/puzzle2.php');
        exit;
    } else {
        $_SESSION['score'] -= 10;
        if ($_SESSION['score'] <= 0) {
            header('Location: ../fail.php');
            exit;
        }
        $error = "❌ Wrong answer. Try again! (-10 points)";
    }
}

// Compute total hints used
$totalHints =
    ($_SESSION['hints'] ?? 0) +
    ($_SESSION['hints_puzzle1'] ?? 0) +
    ($_SESSION['hints_puzzle2'] ?? 0) +
    ($_SESSION['hints_puzzle3'] ?? 0);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles.css">
  <title>Cipher Chamber - Puzzle 1</title>
</head>
<body>
  <h1>🔒 Cipher Chamber - Puzzle 1</h1>
  <p>
    🧩 <strong>Puzzle:</strong> "If you add me to myself and add six, you get 14. What am I?"
  </p>

  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="answer" required>
    <button type="submit">Submit Answer</button>
  </form>

  <p><a href="../hints/hint1.php?from=../puzzles/puzzle1.php">Need a hint? (-20 points)</a></p>

  <p>
    ✅ Score: <strong><?= $_SESSION['score'] ?></strong><br>
    💡 Hints Used: <strong><?= $totalHints ?></strong>
  </p>
</body>
</html>
