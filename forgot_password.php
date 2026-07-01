<?php
include "includes/db.php";

if(isset($_POST['reset']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) == 0)
    {
        echo "<script>alert('Email not found!');</script>";
    }
    else
    {
        // Check passwords match
        if($password != $confirm)
        {
            echo "<script>alert('Passwords do not match!');</script>";
        }
        // Strong password validation
        else if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password))
        {
            echo "<script>alert('Password must contain at least 8 characters, one uppercase letter, one lowercase letter, and one number.');</script>";
        }
        else
        {
            $password = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn,
            "UPDATE users SET password='$password' WHERE email='$email'");

            echo "<script>
                    alert('Password Updated Successfully!');
                    window.location='login.php';
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="login-container">

<div class="login-card">

<h2>🔑 Forgot Password</h2>

<p>Reset your account password</p>

<form method="POST">

<input type="email"
name="email"
placeholder="Enter Email"
required>

<input type="password"
name="password"
placeholder="New Password"
required>

<input type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button type="submit" name="reset">
Reset Password
</button>

</form>

<br>

<a href="login.php" class="link">
← Back to Login
</a>

</div>

</div>
<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>

</body>
</html>