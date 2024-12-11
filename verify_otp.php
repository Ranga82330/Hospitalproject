<?php
session_start();

// Get the submitted OTP from the request
$otp = $_POST['otp'];

// Retrieve the stored OTP from the session
$storedOTP = $_SESSION['otp'];

if ($otp === $storedOTP) {
  // OTP is valid, clear the session variable
  unset($_SESSION['otp']);

  // Redirect to the dashboard or other desired page
  header('Location: dashboard.php');
  exit();
} else {
  echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
}