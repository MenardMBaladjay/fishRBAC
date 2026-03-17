<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header("Location: main.php");
    exit();
}

if (isset($_POST['update_role'])) {
    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $new_role = mysqli_real_escape_string($connection, $_POST['new_role']);
    
    $query = "UPDATE users SET role = '$new_role' WHERE id = '$uid'";
    mysqli_query($connection, $query);
    header("Location: manage_users.php?message=Role updated successfully");
    exit();
}

if (isset($_POST['delete_user'])) {
    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    
    $query = "DELETE FROM users WHERE id = '$uid'";
    mysqli_query($connection, $connection, $query);
    header("Location: manage_users.php?message=User deleted");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="home_name">User Permission Control</h1>
    
    <div class="mainwrapper_div">
        <div style="margin-bottom: 20px;">
            <a href="main.php"><button class="button1" style="width: 150px; font-size: 16px; margin-left: 40px; margin-top: 30px;">Back to Main</button></a>
        </div>

        <?php if(isset($_GET['message'])) echo "<h6>".$_GET['message']."</h6>"; ?>

        <table style="border-spacing: 1px; width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Current Role</th>
                    <th>Change Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $res = mysqli_query($connection, "SELECT * FROM users");
                while($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo ucfirst($row['role']); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <select name="new_role" style="padding: 5px;">
                                <option value="buyer" <?php if($row['role'] == 'buyer') echo 'selected'; ?>>Buyer</option>
                                <option value="caretaker" <?php if($row['role'] == 'caretaker') echo 'selected'; ?>>Caretaker</option>
                                <option value="owner" <?php if($row['role'] == 'owner') echo 'selected'; ?>>Owner</option>
                            </select>
                            <input type="submit" name="update_role" value="Save" class="button2">
                    </td>
                    <td>
                            <input type="submit" name="delete_user" value="Delete" class="button3" onclick="return confirm('Are you sure?')">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>