<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

if(isset($_POST['upload']))
{
    $filename = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];

    if($filename != "")
    {
        $newname = time() . "_" . $filename;

        move_uploaded_file($tempname, "uploads/" . $newname);

        mysqli_query($conn,
        "UPDATE users SET photo='$newname' WHERE id=$id");
    }

    header("Location: profile.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<style>

body{
    font-family:Arial;
    background:#f4f7fb;
}

.container{
    width:450px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
    text-align:center;
}

img{
    width:170px;
    height:170px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #6c63ff;
}

button{
    background:#6c63ff;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    cursor:pointer;
    margin-top:15px;
    transition:0.3s;
}

button:hover{
    background:#5648d6;
    transform:scale(1.05);
}

input[type=file]{
    margin-top:10px;
}

a{
    text-decoration:none;
    color:#6c63ff;
    font-weight:bold;
}

a:hover{
    color:#5648d6;
}

</style>

</head>

<body>

<div class="container">

<h2>👤 My Profile</h2>

<?php
if(empty($user['photo']))
{
    echo "<img src='uploads/default.png'>";
}
else
{
    echo "<img src='uploads/".$user['photo']."'>";
}
?>

<br><br>

<form method="POST" enctype="multipart/form-data">

<input type="file" name="photo" required>

<br>

<button type="submit" name="upload">
📷 Upload Photo
</button>

</form>

<hr>

<h3><?php echo $user['fullname']; ?></h3>

<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<p><strong>Role:</strong> <?php echo $user['role']; ?></p>

<br>

<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>

</body>
</html>