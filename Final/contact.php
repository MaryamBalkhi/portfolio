<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit("Invalid request");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
  exit("Please fill all fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  exit("Invalid email address.");
}

// ===== YOUR EMAIL =====
$to = "maraxxad@example.com";
$subject = "New Contact Form Message";

// Email content
$body = "You received a new message:\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n\n";
$body .= "Message:\n$message\n";

// Headers
$headers = "From: Contact Form <no-reply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send mail
if (mail($to, $subject, $body, $headers)) {
  echo "Message sent successfully!";
} else {
  echo "Failed to send message. Please try again later.";
}
?>
