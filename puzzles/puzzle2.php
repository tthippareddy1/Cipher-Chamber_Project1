<?php
session_start();

// Check if user has a score at all
if (!isset($_SESSION['score'])) {
    header('Location: start.php');
    exit;
}

// Block if score is already zero or negative
if ($_SESSION['score'] <= 0) {
    header('Location: ../fail.php');
    exit;
}

// Enforce level lock (must have completed puzzle 1)
if (!isset($_SESSION['level']) || $_SESSION['level'] < 2) {
    header('Location: start.php');
    exit;
}

// Initialize per-puzzle hints
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
    if ($answer === 'apple') {
        $_SESSION['level'] = 3;
        header('Location: ../loading.php?next=puzzles/puzzle3.php');
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
  <title>Cipher Chamber - Puzzle 2</title>
</head>
<body>
  <h1>🔒 Cipher Chamber - Puzzle 2</h1>
  <p>
    🧩 <strong>Puzzle:</strong> "I keep the doctor away if you have me every day. What am I?"
  </p>

  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="answer" required>
    <button type="submit">Submit Answer</button>
  </form>

  <p><a href="../hints/hint2.php?from=../puzzles/puzzle2.php">Need a hint? (-20 points)</a></p>

  <p>
    ✅ Score: <strong><?= $_SESSION['score'] ?></strong><br>
    💡 Hints Used: <strong><?= $totalHints ?></strong>
  </p>
</body>
</html>
