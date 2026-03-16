<?php
session_start();
include('dbcon.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role']; 
            header("Location: main.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="cute">
    <h1 class="logintop">Welcome to Menard's Acquatics</h1>

    <div class="wrapper_div">
        <div class="login_div">
            <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 30px; margin-top: 30px; text-shadow: 0 4px 5px rgba(0,0,0,1);">Log in</h2>
            <form method="POST" action="">
                <label>Username</label>
                <input name="username" type="text" placeholder="Username" required style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">

                <label>Password</label>
                <input name="password" type="password" placeholder="Password" required style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">

                <div class="button_part" style="margin-top: 20px;">
                    <input type="submit" name="login" value="Log in" class="button1">
                </div>

                <p style="margin-top: 20px;">Don't have an account? <a href="register.php">Register here</a></p>

                <?php if (isset($message)) echo "<p style='color:red;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>
