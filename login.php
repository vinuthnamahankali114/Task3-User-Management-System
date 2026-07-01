<?php
session_start();
include "includes/db.php";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            echo "Wrong Password!";
        }
    }
    else
    {
        echo "User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="login-container">

    <div class="login-card">

        <h1>🔐 Login</h1>

        <p>Welcome back! Please login to continue.</p>

        <form method="POST">

            <input
                type="email"
                name="email"
                placeholder="📧 Enter Email"
                required>

            <input type="password"
       id="password"
       name="password"
       placeholder="🔒 Enter Password"
       required>

       <label style="display:block; margin-bottom:15px;">
    <input type="checkbox" onclick="togglePassword()">
    Show Password
</label>
       


            <button type="submit" name="login">
                Login
            </button>

            <br><br>

<a href="forgot_password.php" class="link">
Forgot Password?
</a>

        </form>

        <br>

        <a href="register.php" class="link">
            Don't have an account? Register
        </a>

    </div>

</div>

<script>
function togglePassword()
{
    var password = document.getElementById("password");

    if(password.type === "password")
    {
        password.type = "text";
    }
    else
    {
        password.type = "password";
    }
}
</script>
<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>
</body>
</html>