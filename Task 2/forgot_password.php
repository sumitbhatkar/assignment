<?php
require 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = '1111';

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Normally, you would send the OTP via email. Here we just display it.
        echo "OTP: $otp (for demo purposes only)";
    } else {
        echo "No user found with that email address.";
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="POST" action="forgot_password.php">
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Send OTP">
</form>
