<?php
session_start();
include "LibraryHandler.php";

// ⬇️ Handle checkout form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $card = $_POST['card_number'] ?? '';
  $books = $_POST['selected_books'] ?? [];

  $lh = new LibraryHandler();

  if ($card && !empty($books)) {
    $success = $lh->checkout_books($card, $books);

    if ($success) {
      $_SESSION['return_date'] = date('F j, Y', strtotime('+14 days'));
      header("Location: checkout_success.php");
      exit;
    } else {
      $error = "Checkout failed. Please try again.";
    }
  } else {
    $error = "Please enter your library card number and select books.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout Books</title>
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
    <h2>Checkout Books</h2>

    <?php if (isset($error)): ?>
      <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
      <label for="card_number">Library Card Number:</label>
      <input type="number" name="card_number" id="card_number" required><br><br>

      <label>Select the books you wish to checkout:</label><br>
      <input type="checkbox" name="selected_books[]" value="Fundamentals of Software Architecture"> Fundamentals of Software Architecture<br>
      <input type="checkbox" name="selected_books[]" value="The Mythical Man-Month"> The Mythical Man-Month<br>
      <input type="checkbox" name="selected_books[]" value="Philosophy of Software Design"> Philosophy of Software Design<br>
      <input type="checkbox" name="selected_books[]" value="Cybersecurity For Dummies"> Cybersecurity For Dummies<br>
      <input type="checkbox" name="selected_books[]" value="Hacking For Dummies"> Hacking For Dummies<br>
      <input type="checkbox" name="selected_books[]" value="Clean Code"> Clean Code<br>
      <input type="checkbox" name="selected_books[]" value="The Pragmatic Programmer"> The Pragmatic Programmer<br>
      <input type="checkbox" name="selected_books[]" value="The Problem with Software"> The Problem with Software<br>
      <input type="checkbox" name="selected_books[]" value="Design Patterns"> Design Patterns<br>
      <input type="checkbox" name="selected_books[]" value="Cybersecurity Career Master Plan"> Cybersecurity Career Master Plan<br>
      <input type="checkbox" name="selected_books[]" value="Code Complete"> Code Complete<br>
      <input type="checkbox" name="selected_books[]" value="Effective Java"> Effective Java<br><br>

      <input type="submit" value="Checkout">
    </form>
  </div>
</body>
</html>