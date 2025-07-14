<?php
session_start();
$next = isset($_GET['next']) ? $_GET['next'] : 'index.php';
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Loading...</title>
  <meta http-equiv="refresh" content="2.5;url=<?= htmlspecialchars($next) ?>">
</head>
<body class="loading-background">
</body>
</html>
