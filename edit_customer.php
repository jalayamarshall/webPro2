<?php
session_start();
include "LibraryHandler.php";
$lh = new LibraryHandler();

$card = $_GET['card_number'] ?? null;
$customer = null;
$message = "";

if ($card) {
  $customer = $lh->get_customer_by_card($card);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $first = htmlspecialchars(trim($_POST['first_name'] ?? ''));
  $last  = htmlspecialchars(trim($_POST['last_name'] ?? ''));
  $email = filter_var(trim($_POST['customer_email'] ?? ''), FILTER_SANITIZE_EMAIL);
  $phone = htmlspecialchars(trim($_POST['phone_number'] ?? ''));
  $zip   = htmlspecialchars(trim($_POST['zip_code'] ?? ''));
  $card  = intval($_POST['library_card_number'] ?? 0);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Invalid email address.";
  } else {
    $lh->update_customer($card, $first, $last, $email, $phone, $zip);
    $message = "Customer record updated successfully!";
    $customer = $lh->get_customer_by_card($card);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Customer</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1 style="text-align: center">The Book Nook</h1>
    <div class="nav-box">
      <nav>
        <a href="Home.html">Home</a>
        <a href="add_customer.php">Library Card Signup</a>
        <a href="books.php">Books</a>
        <a href="checkout.php">Checkout</a>
        <a href="show_customers.php">Customer Records</a>
      </nav>
    </div>
  </header>

  <main>
    <div class="auth-box">
      <h2>Edit Customer Info</h2>

      <?php if ($customer): ?>
        <form method="post" action="edit_customer.php">
          <input type="hidden" name="library_card_number" value="<?= htmlspecialchars($customer['library_card_number'] ?? '') ?>" />

          <label>First Name:</label>
          <input type="text" name="first_name" value="<?= htmlspecialchars($customer['first_name'] ?? '') ?>" required />

          <label>Last Name:</label>
          <input type="text" name="last_name" value="<?= htmlspecialchars($customer['last_name'] ?? '') ?>" required />

          <label>Email:</label>
          <input type="email" name="customer_email" value="<?= htmlspecialchars($customer['customer_email'] ?? '') ?>" required />

          <label>Phone Number:</label>
          <input type="tel" name="phone_number" value="<?= htmlspecialchars($customer['phone_number'] ?? '') ?>" required />

          <label>Zip Code:</label>
          <input type="text" name="zip_code" value="<?= htmlspecialchars($customer['zip_code'] ?? '') ?>" required />

          <input type="submit" value="Update" />
        </form>

        <?php if ($message): ?>
          <p style="color: green;"><?= htmlspecialchars($message ?? '') ?></p>
        <?php endif; ?>

      <?php else: ?>
        <p style="color: red;">Customer not found or missing card number.</p>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>