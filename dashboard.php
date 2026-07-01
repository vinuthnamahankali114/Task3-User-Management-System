<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$data = mysqli_fetch_assoc($result);
$totalUsers = $data['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main">

    <!-- Welcome Card -->

    <div class="card"
         style="background:linear-gradient(135deg,#6C63FF,#8B5CF6);
                color:white;
                border-radius:18px;
                padding:35px;
                margin-bottom:30px;">
<h1 style="
    font-size:40px;
    font-weight:700;
    color:#FFFFFF;
    text-shadow:2px 2px 6px rgba(0,0,0,0.3);
    margin-bottom:15px;
">
    👋 Welcome, <?php echo $_SESSION['user_name']; ?>
</h1>
<p style="
    font-size:18px;
    color:#FFFFFF;
    opacity:0.95;
">
    Welcome to your User Management System Dashboard.
    Manage users, profiles, and account information with ease.
</p>
    </div>

    <!-- Dashboard Cards -->

    <div style="display:flex;
                gap:25px;
                flex-wrap:wrap;">

        <!-- Total Users -->

        <a href="crud/view_users.php"
           style="text-decoration:none;color:black;">

            <div class="card"
                 style="width:260px;
                        text-align:center;">

                <h1 style="font-size:55px;">👥</h1>

                <h2 style="color:#5b4bdb;">
                    Total Users
                </h2>

                <h1 style="margin:15px 0;
                           color:#1E1B4B;">
                    <?php echo $totalUsers; ?>
                </h1>

                <p style="color:#777;">
                    Click to View Users
                </p>

            </div>

        </a>

        <!-- Add User -->

        <a href="crud/add_user.php"
           style="text-decoration:none;color:black;">

            <div class="card"
                 style="width:260px;
                        text-align:center;">

                <h1 style="font-size:55px;">➕</h1>

                <h2 style="color:#5b4bdb;">
                    Add User
                </h2>

                <h1 style="margin:15px 0;
                           color:#1E1B4B;">
                    +
                </h1>

                <p style="color:#777;">
                    Create a New User
                </p>

            </div>

        </a>

        <!-- My Profile -->

        <a href="profile.php"
           style="text-decoration:none;color:black;">

            <div class="card"
                 style="width:260px;
                        text-align:center;">

                <h1 style="font-size:55px;">👤</h1>

                <h2 style="color:#5b4bdb;">
                    My Profile
                </h2>

                <h1 style="margin:15px 0;
                           color:#1E1B4B;">
                    Profile
                </h1>

                <p style="color:#777;">
                    View Your Profile
                </p>

            </div>

        </a>

    </div>

</div>

<footer style="text-align:center;
               padding:20px;
               margin-top:40px;
               color:#666;
               font-size:14px;">

    © 2026 User Management System | Developed by M. Vinuthna

</footer>

</body>
</html>
