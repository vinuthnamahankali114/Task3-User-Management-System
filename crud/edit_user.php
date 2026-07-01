<?php
include "../includes/db.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    mysqli_query($conn,
    "UPDATE users SET fullname='$fullname',
    email='$email'
    WHERE id=$id");

    header("Location:view_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include "../includes/sidebar.php"; ?>

<div class="main">

    <div class="card" style="max-width:600px; margin:auto;">

        <h2 style="text-align:center; margin-bottom:25px;">
            ✏️ Edit User
        </h2>

        <form method="POST">

            <label><b>Full Name</b></label><br>

            <input
                type="text"
                name="fullname"
                value="<?php echo $user['fullname']; ?>"
                required
                style="width:100%;padding:12px;margin:10px 0 20px;border:1px solid #ccc;border-radius:8px;">

            <label><b>Email Address</b></label><br>

            <input
                type="email"
                name="email"
                value="<?php echo $user['email']; ?>"
                required
                style="width:100%;padding:12px;margin:10px 0 20px;border:1px solid #ccc;border-radius:8px;">

            <button
                type="submit"
                name="update"
                class="btn"
                style="width:100%;padding:14px;font-size:16px;">
                Update User
            </button>

        </form>

    </div>

</div>
<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>

</body>
</html>