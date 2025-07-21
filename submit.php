<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "Jalaya123", "librarydb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['registered'])) {
  $_SESSION['first'] = $_POST['customer_first_name'];
  $_SESSION['last']  = $_POST['customer_last_name'];
  $_SESSION['email'] = $_POST['customer_email'];
  $_SESSION['phone'] = $_POST['customer_phone_number'];
  $_SESSION['zip']   = $_POST['customer_zip'];
  $_SESSION['card']  = rand(100000, 999999);
  $_SESSION['registered'] = true;
// Check if this email is already in the system
$check = $conn->prepare("SELECT library_card_number FROM customer WHERE customer_email = ?");
$check->bind_param("s", $_POST['customer_email']);
$check->execute();
$check->bind_result($existing_card);
$check->fetch();
$check->close();

if ($existing_card) {
    // Existing account found — use that card number
    $_SESSION['card'] = $existing_card;
    $_SESSION['first'] = $_POST['customer_first_name'];
    $_SESSION['registered'] = true;
} else {
    // Brand new account — generate card and insert
    $_SESSION['first'] = $_POST['customer_first_name'];
    $_SESSION['last']  = $_POST['customer_last_name'];
    $_SESSION['email'] = $_POST['customer_email'];
    $_SESSION['phone'] = $_POST['customer_phone_number'];
    $_SESSION['zip']   = $_POST['customer_zip'];
    $_SESSION['card']  = rand(100000, 999999);
    $_SESSION['registered'] = true;

    $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, customer_email, phone_number, zip_code, library_card_number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $_SESSION['first'], $_SESSION['last'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['zip'], $_SESSION['card']);
    $stmt->execute();
    $stmt->close();
}
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome to The Book Nook</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <h1 style="text-align: center">The Book Nook</h1>

  <div class="nav-box">
    <nav>
      <a href="Home.html">Home</a>
      <a href="library_card.html">Library Card Signup</a>
      <a href="books.html">Books</a>
      <a href="checkout.html">Checkout</a>
    </nav>
  </div>

  <div class="auth-box">
    <?php
      if (isset($_SESSION['registered'])) {
        echo "<h2>Welcome, {$_SESSION['first']}!</h2>";
        echo "<p>Your library card number is:</p>";
        echo "<div style='font-size: 2em; background: #f0f0f0; padding: 10px; border-radius: 8px; display: inline-block; margin-top: 10px;'>#{$_SESSION['card']}</div>";
        echo "<p style='margin-top: 20px;'>You can now check out books, explore our catalog, and get cozy with your next read!</p>";
      } else {
        echo "<p style='color: red;'>Oops! Something went wrong. Please try again.</p>";
      }

      $conn->close();
      session_unset();
      session_destroy();
    ?>
  </div>
</body>
</html>