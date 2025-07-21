<?php
include "LibraryHandler.php";
$lh = new LibraryHandler();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $card = $_POST['card_number'] ?? '';
  if ($card) {
    $lh->delete_customer($card);
  }
}

header("Location: show_customers.php");
exit;