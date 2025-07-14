<?php
session_start();
session_destroy(); // Clear all old session data

session_start();
$_SESSION['score'] = 100;
$_SESSION['level'] = 1;
$_SESSION['hints'] = 0;
$_SESSION['hints_puzzle1'] = 0;
$_SESSION['hints_puzzle2'] = 0;
$_SESSION['hints_puzzle3'] = 0;

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Cipher Chamber</title>
</head>
<body>
  <h1>🔐 Welcome to The Cipher Chamber</h1>
  <p>Can you solve all the puzzles and escape?</p>
  <p>Your goal: solve 3 unique puzzles to unlock the vault doors.</p>
  <p>Hints are available, but using them reduces your final score.</p>
  <form action="loading.php" method="get">
    <input type="hidden" name="next" value="puzzles/puzzle1.php">
    <button type="submit">Start Game</button>
</form>
</body>
</html>
