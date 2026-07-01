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

<h2 style="color:#5b4bdb;">
    Welcome, <?php echo $_SESSION['user_name']; ?> 👋
</h2>

<p style="color:#777;">
    Manage your users easily from the dashboard.
</p>

<br>

    <div class="card">
        <h1>Welcome <?php echo $_SESSION['user_name']; ?></h1>
        <p>User Management System Dashboard</p>
    </div>

    <div style="display:flex; gap:20px; margin-top:20px; flex-wrap:wrap;">

        <a href="crud/view_users.php" style="text-decoration:none; color:black;">
            <div class="card" style="width:250px; text-align:center;">
                <h2>Total Users</h2>
                <h1><?php echo $totalUsers; ?></h1>
                <p>Click to View</p>
            </div>
        </a>

        <a href="crud/add_user.php" style="text-decoration:none; color:black;">
            <div class="card" style="width:250px; text-align:center;">
                <h2>Add User</h2>
                <h1>+</h1>
                <p>Create New User</p>
            </div>
        </a>

        <a href="profile.php" style="text-decoration:none; color:black;">
            <div class="card" style="width:250px; text-align:center;">
                <h2>My Profile</h2>
                <h1>👤</h1>
                <p>View Profile</p>
            </div>
        </a>

    </div>

</div>

</body>
</html>