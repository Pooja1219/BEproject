<?php
session_start();
// Generate a random OTP
$otp = rand(100000, 999999);

// User's email address
$email = 'aryaarusasidharan10@gmail.com';

// Send OTP via email
$to = $email;
$subject = 'OTP Verification';
$message = 'Your OTP is: ' . $otp;
$headers = 'From: shreepooja.1912@gmail.com' . "\r\n" .
    'Reply-To: your_email@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'OTP sent successfully!';
} else {
    echo 'Failed to send OTP.';
}

// Store the OTP in a session or database for verification later

$_SESSION['otp'] = $otp;
?>
