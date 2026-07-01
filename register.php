<?php
include "includes/db.php";

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Strong Password Validation
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password))
    {
        echo "<script>
        alert('Password must contain at least 8 characters, one uppercase letter, one lowercase letter, and one number.');
        window.history.back();
        </script>";
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(fullname,email,password)
            VALUES('$fullname','$email','$password')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Registration Successful!');
        window.location='login.php';
        </script>";
    }
    else
    {
        echo "<script>alert('Error while registering!');</script>";
    }
}
?>

<!DOCTYPE html>
<head>
    <title>User Management System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>User Registration</h2>

<form method="POST">

    <input type="text" name="fullname"
    placeholder="Full Name" required><br><br>

    <input type="email" name="email"
    placeholder="Email" required><br><br>

   <input type="password"
       name="password"
       placeholder="Enter Strong Password"
       required
       minlength="8"
       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
       title="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, and one number.">
     
       <small style="color:#666;">
Password must contain:
<ul style="margin-top:5px;">
    <li>✅ At least 8 characters</li>
    <li>✅ One uppercase letter (A-Z)</li>
    <li>✅ One lowercase letter (a-z)</li>
    <li>✅ One number (0-9)</li>
</ul>
</small>

    <button type="submit" name="register">
        Register
    </button>

</form>

<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>

</body>
</html>