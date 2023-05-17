<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered OTP from the form
    $entered_otp = $_POST['otp'];

    // Call the Python script to verify the OTP
    $command = escapeshellcmd('python otp_mail.py');
    $output = shell_exec($command);

    // Verify the OTP
    if (trim($output) == $entered_otp) {
        echo "OTP verified successfully.";
    } else {
        echo "Invalid OTP.";
    }
}
?>

<!-- HTML form for entering the OTP -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="otp" placeholder="Enter OTP">
    <input type="submit" value="Verify">
</form>
