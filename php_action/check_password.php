<?php
require_once 'core.php';

// Get the entered password from the request body
$data = json_decode(file_get_contents('php://input'), true);
$enteredPassword = $data['password'];

// Check the entered password against the password stored in the database
$conn = new mysqli($localhost, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE user_ id = 1"; // Modify the query to match your table structure
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $storedPassword = $row['password'];

  $response = array('valid' => password_verify($enteredPassword, $storedPassword));
} else {
  $response = array('valid' => false);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>