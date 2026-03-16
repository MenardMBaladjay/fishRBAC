<?php
session_start();
include('dbcon.php');

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $check_query = "SELECT * FROM users WHERE username = '$username'";
        $check_result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "Username already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($connection, $insert_query)) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $message = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="cute">
    <h1 class="logintop">Welcome to Menard's Acquatics</h1>

    <div class="wrapper_div">
        <div class="login_div">
            <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 30px; margin-top: 30px; text-shadow: 0 4px 5px rgba(0,0,0,1);">Register</h2>
            <form method="POST" action="">
                <label>Username</label>
                <input name="username" type="text" placeholder="Username" required style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">

                <label>Password</label>
                <input name="password" type="password" placeholder="Password" required style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">

                <label>Confirm Password</label>
                <input name="confirm_password" type="password" placeholder="Confirm Password" required style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">

                <div class="button_part" style="margin-top: 20px;">
                    <input type="submit" name="register" value="Register" class="button1">
                </div>

                <p style="margin-top: 20px;">Already have an account? <a href="index.php">Log in here</a></p>

                <?php if (isset($message)) echo "<p style='color:red;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>
