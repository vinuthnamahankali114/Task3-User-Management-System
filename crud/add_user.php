<?php
include "../includes/db.php";

if(isset($_POST['add']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(fullname,email,password)
            VALUES('$fullname','$email','$password')";

    mysqli_query($conn,$sql);

    header("Location: view_users.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include "../includes/sidebar.php"; ?>

<div class="main">

    <div class="card" style="max-width:600px; margin:auto;">

        <h2 style="margin-bottom:25px; text-align:center;">
            ➕ Add New User
        </h2>

        <form method="POST">

            <label><b>Full Name</b></label><br>
            <input type="text"
                   name="fullname"
                   placeholder="Enter Full Name"
                   required
                   style="width:100%;padding:12px;margin:10px 0 20px;border:1px solid #ccc;border-radius:8px;">

            <label><b>Email Address</b></label><br>
            <input type="email"
                   name="email"
                   placeholder="Enter Email"
                   required
                   style="width:100%;padding:12px;margin:10px 0 20px;border:1px solid #ccc;border-radius:8px;">

            <label><b>Password</b></label><br>
           <input type="password"
       name="password"
       placeholder="Enter Strong Password"
       required
       minlength="8"
       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
       title="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, and one number."
       style="width:100%;padding:12px;margin:10px 0 5px;border:1px solid #ccc;border-radius:8px;">

       <small style="color:#666;">
Password must contain:
<ul style="margin-top:5px; padding-left:20px;">
    <li>✅ At least 8 characters</li>
    <li>🔠 One uppercase letter (A-Z)</li>
    <li>🔡 One lowercase letter (a-z)</li>
    <li>🔢 One number (0-9)</li>
</ul>
</small>

            <button type="submit"
                    name="add"
                    class="btn"
                    style="width:100%;padding:14px;font-size:16px;">
                Add User
            </button>

        </form>

    </div>

</div>
<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>

</body>
</html>