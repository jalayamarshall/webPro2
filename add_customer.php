<?php
session_start();
include "LibraryHandler.php";

$first = $last = $email = $phone = $zip = "";
$card = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $lh = new LibraryHandler();

  // Sanitize input
  $first = htmlspecialchars(trim($_POST['customer_first_name']));
  $last  = htmlspecialchars(trim($_POST['customer_last_name']));
  $email = filter_var(trim($_POST['customer_email']), FILTER_SANITIZE_EMAIL);
  $phone = htmlspecialchars(trim($_POST['customer_phone_number']));
  $zip   = htmlspecialchars(trim($_POST['customer_zip']));

  // Optional: Email format validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Invalid email format.";
  } else {
    // Check for existing customer
    $existing = $lh->get_customer_by_email($email);

    if ($existing) {
      $card = $existing;
      $message = "Welcome back, $first!";
    } else {
      $card = rand(100000, 999999);
      $lh->add_customer($first, $last, $email, $phone, $zip, $card);
      $message = "Thanks for signing up, $first!";
    }

    $_SESSION['card'] = $card;
    $_SESSION['first'] = $first;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library Card Sign-Up</title>
  <link rel="stylesheet" href="style.css" />
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
    <h2>Get Your Library Card</h2>

    <form method="post" action="add_customer.php">
      <label>First Name:</label>
      <input type="text" name="customer_first_name" value="<?= $first ?>" required />

      <label>Last Name:</label>
      <input type="text" name="customer_last_name" value="<?= $last ?>" required />

      <label>Email:</label>
      <input type="email" name="customer_email" value="<?= $email ?>" required />

      <label>Phone Number:</label>
      <input type="tel" name="customer_phone_number" value="<?= $phone ?>" required />

      <label>Zip Code:</label>
      <input type="text" name="customer_zip" value="<?= $zip ?>" required />

      <input type="submit" value="Sign Up" />
    </form>

    <?php if ($card): ?>
      <h3>Welcome, <?= htmlspecialchars($first) ?>!</h3>
      <p>Your library card number is:</p>
      <div style="font-size: 2em; background: #f0f0f0; padding: 10px; border-radius: 8px;">#<?= $card ?></div>
      <p>You can now check out books and explore the shelves!</p>
    <?php elseif ($message): ?>
      <p style="color:red;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
  </div>
</body>
</html>