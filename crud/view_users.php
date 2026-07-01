<?php
include "../includes/db.php";

$search = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $result = mysqli_query($conn,
    "SELECT * FROM users
     WHERE fullname LIKE '%$search%'
     OR email LIKE '%$search%'");
}
else
{
    $result = mysqli_query($conn,"SELECT * FROM users");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include "../includes/sidebar.php"; ?>

<div class="main">

    <div class="card">

        <h2>All Users</h2>
        <br>
        <br>

<form method="GET" style="margin-bottom:20px;">

<input
type="text"
name="search"
placeholder="🔍 Search by Name or Email"
value="<?php echo $search; ?>"
style="
width:320px;
padding:12px;
border:1px solid #ccc;
border-radius:8px;">

<button
class="btn"
style="padding:12px 20px;"
type="submit">

Search

</button>

<a href="view_users.php"
style="
margin-left:10px;
text-decoration:none;
background:#dc3545;
color:white;
padding:12px 18px;
border-radius:8px;">

Reset

</a>

</form>

        <table border="0" width="100%" cellpadding="15">

            <tr style="background:#7C3AED; color:white;">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

            <?php while($row=mysqli_fetch_assoc($result)){ ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>

               <td style="white-space: nowrap;">

    <a href="edit_user.php?id=<?php echo $row['id']; ?>"
       class="btn"
       style="display:inline-block;
              width:90px;
              text-align:center;
              margin-right:12px;">
       Edit
    </a>

    <a href="delete_user.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Are you sure you want to delete this user?')"
       style="display:inline-block;
              width:90px;
              text-align:center;
              background:#dc3545;
              color:white;
              padding:10px 0;
              border-radius:8px;
              text-decoration:none;">
       Delete
    </a>

</td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>
<footer style="text-align:center;padding:20px;margin-top:40px;color:#666;font-size:14px;">
    © 2026 User Management System | Developed by M. Vinuthna
</footer>

</body>
</html>