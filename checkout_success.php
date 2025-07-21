<?php
session_start();
$return_date = $_SESSION['return_date'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Success</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 style="text-align: center">The Book Nook</h1>

  <div class="nav-box">
    <nav>
      <a href="Home.html">Home</a>
      <a href="add_customer.php">Library Card Signup</a>
      <a href="books.php">Books</a>
      <a href="checkout.php">Checkout</a>
      <a href="show_customer.php">Customer Records</a>
    </nav>
  </div>

  <div class="auth-box">
    <h2>Checkout Successful</h2>
    <p>You have successfully checked out your books!</p>

    <?php if ($return_date): ?>
      <p>Your return date is <strong><?= $return_date ?></strong>.</p>
    <?php else: ?>
      <p>Return date not set.</p>
    <?php endif; ?>
  </div>
</body>
</html>