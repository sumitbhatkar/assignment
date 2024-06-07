<?php
require 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    if ($otp == '1111') {
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);

        if ($stmt->execute()) {
            echo "Password reset successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid OTP.";
    }

    $conn->close();
}
?>

<form method="POST" action="reset_password.php">
    Email: <input type="email" name="email" required><br>
    OTP: <input type="text" name="otp" required><br>
    New Password: <input type="password" name="new_password" required><br>
    <input type="submit" value="Reset Password">
</form>
