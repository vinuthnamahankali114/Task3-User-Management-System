<?php
include "includes/db.php";

if(isset($_POST['register']))
{
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Strong Password Validation
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password))
    {
        echo "<script>
        alert('Password must contain at least 8 characters, one uppercase letter, one lowercase letter and one number.');
        window.history.back();
        </script>";
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0)
    {
        echo "<script>alert('Email already exists!');</script>";
    }
    else
    {
        mysqli_query($conn,"INSERT INTO users(fullname,email,password)
        VALUES('$fullname','$email','$password')");

        echo "<script>
        alert('Registration Successful!');
        window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>User Registration</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/style.css">

</head>

<body>

<div class="login-container">

<div class="login-card">

<h1>📝 Create Account</h1>

<p>Create your account to continue</p>

<form method="POST">

<input
type="text"
name="fullname"
placeholder="👤 Full Name"
required>

<input
type="email"
name="email"
placeholder="📧 Email Address"
required>

<input
type="password"
id="password"
name="password"
placeholder="🔒 Password"
required
minlength="8"
pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
title="Minimum 8 characters, one uppercase, one lowercase and one number">

<label style="font-size:14px;">
<input type="checkbox" onclick="togglePassword()">
 Show Password
</label>

<br><br>

<small>
Password must contain:
</small>

<ul>
<li>✔ Minimum 8 characters</li>
<li>✔ One Uppercase Letter</li>
<li>✔ One Lowercase Letter</li>
<li>✔ One Number</li>
</ul>

<button type="submit" name="register">

Register

</button>

</form>

<br>

<div style="text-align:center;">

Already have an account?

<br><br>

<a href="login.php" class="link">

Login Here

</a>

</div>

</div>

</div>

<footer>

© 2026 User Management System | Developed by M. Vinuthna

</footer>

<script>

function togglePassword(){

var x=document.getElementById("password");

if(x.type==="password")
x.type="text";
else
x.type="password";

}

</script>

</body>
</html>
