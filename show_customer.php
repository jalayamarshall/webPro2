<?php
include "LibraryHandler.php";
$lh = new LibraryHandler();
$customers = $lh->get_all_customers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Records</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1 style="text-align: center">The Book Nook</h1>
    <div class="nav-box">
      <nav>
        <a href="Home.html">Home</a>
        <a href="add_customer.php">Library Card Signup</a>
        <a href="books.html">Books</a>
        <a href="checkout.php">Checkout</a>
        <a href="show_customer.php">Customer Records</a>
      </nav>
    </div>
  </header>

  <main>
    <div class="auth-box">
      <h2>Library Card Holders</h2>

      <?php if (empty($customers)): ?>
        <p>No customer records found.</p>
      <?php else: ?>
        <table class="customer-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Zip</th>
              <th>Card Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $customer): ?>
              <tr>
                <td><?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></td>
                <td><?= htmlspecialchars($customer['customer_email']) ?></td>
                <td><?= htmlspecialchars($customer['phone_number']) ?></td>
                <td><?= htmlspecialchars($customer['zip_code']) ?></td>
                <td><?= htmlspecialchars($customer['library_card_number']) ?></td>
                <td>
                  <!-- EDIT FORM -->
                  <form method="get" action="edit_customer.php" style="display:inline;">
                    <input type="hidden" name="card_number" value="<?= $customer['library_card_number'] ?>" />
                    <input type="submit" value="Edit" />
                  </form>

                  <!-- DELETE FORM -->
                  <form method="post" action="delete_customer.php" onsubmit="return confirm('Delete this customer?');" style="display:inline;">
                    <input type="hidden" name="card_number" value="<?= $customer['library_card_number'] ?>" />
                    <input type="submit" value="Delete" />
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>