<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'config.php';

$name         = trim($_POST['name'] ?? '');
$email        = trim($_POST['email'] ?? '');
$organization = trim($_POST['organization'] ?? '');
$message      = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
  http_response_code(400);
  exit('Please fill all required fields.');
}

if (!$mysqli || $mysqli->connect_errno) {
  http_response_code(500);
  exit('DB connection error: ' . $mysqli->connect_error);
}

$stmt = $mysqli->prepare(
  "INSERT INTO contact_messages (name, email, organization, message)
   VALUES (?, ?, ?, ?)"
);

if (!$stmt) {
  http_response_code(500);
  exit('Prepare failed: ' . $mysqli->error);
}

if (!$stmt->bind_param('ssss', $name, $email, $organization, $message)) {
  http_response_code(500);
  exit('Bind failed: ' . $stmt->error);
}

if (!$stmt->execute()) {
  http_response_code(500);
  exit('Execute failed: ' . $stmt->error);
}

header('Location: /CompanyProfile/index.php?sent=1');
exit;

