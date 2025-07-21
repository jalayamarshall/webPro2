<?php
class LibraryHandler {
  private $db;

  public function __construct() {
    $this->db = new mysqli("localhost", "root", "Jalaya123", "librarydb");

    if ($this->db->connect_error) {
      die("Connection failed: " . $this->db->connect_error);
    }
  }

  //  Lookup customer by email (to prevent duplicates)
  public function get_customer_by_email($email) {
    $stmt = $this->db->prepare("SELECT library_card_number FROM customer WHERE customer_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($card);
    $stmt->fetch();
    $stmt->close();
    return $card ?: false;
  }

  // Add new customer
  public function add_customer($first, $last, $email, $phone, $zip, $card) {
    $stmt = $this->db->prepare(
      "INSERT INTO customer (first_name, last_name, customer_email, phone_number, zip_code, library_card_number) 
       VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssi", $first, $last, $email, $phone, $zip, $card);
    $success = $stmt->execute();
    $stmt->close();
    return $success ? "Successfully added!" : "Failed to add customer.";
  }

  // Lookup customer by card number
  public function get_customer_by_card($card_number) {
    $stmt = $this->db->prepare(
      "SELECT first_name, last_name, customer_email, phone_number, zip_code, library_card_number 
       FROM customer WHERE library_card_number = ?"
    );
    $stmt->bind_param("i", $card_number);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result ?: false;
  }

  // Record book checkouts
  public function checkout_books($card_number, $book_titles) {
    foreach ($book_titles as $title) {
      $stmt = $this->db->prepare(
        "INSERT INTO checkout (library_card_number, book_title, checkout_date) 
         VALUES (?, ?, NOW())"
      );
      $stmt->bind_param("is", $card_number, $title);
      $success = $stmt->execute();
      $stmt->close();

      if (!$success) {
        return false;
      }
    }
    return true;
  }

  //  Get all customer records
  public function get_all_customers() {
    $result = $this->db->query(
      "SELECT first_name, last_name, customer_email, phone_number, library_card_number, zip_code 
       FROM customer"
    );
    $customers = [];
    while ($row = $result->fetch_assoc()) {
      $customers[] = $row;
    }
    return $customers;
  }

  //  Delete customer by card number
  public function delete_customer($card_number) {
    $stmt = $this->db->prepare("DELETE FROM customer WHERE library_card_number = ?");
    $stmt->bind_param("i", $card_number);
    $stmt->execute();
    $stmt->close();
  }

  //  Update customer details
  public function update_customer($card, $first, $last, $email, $phone, $zip) {
    $stmt = $this->db->prepare(
      "UPDATE customer 
       SET first_name = ?, last_name = ?, customer_email = ?, phone_number = ?, zip_code = ? 
       WHERE library_card_number = ?"
    );
    $stmt->bind_param("sssssi", $first, $last, $email, $phone, $zip, $card);
    $stmt->execute();
    $stmt->close();
  }
}
?>