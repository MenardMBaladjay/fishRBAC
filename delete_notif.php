<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Are you sure</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="display:flex; justify-content:center; margin-top: 150px; background-color: rgba(0, 255, 255, 0.1);">
    <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header("Location: main.php");
            exit();
        }
    ?>
    <div class="center_div">
        <h1 class="error_msg">Warning!</h1>
        <h3 class="error_par">Do you want to delete this data?</h3>
        <div class="button_close">
            <a href="main.php"><button type="button" class="close_button">No</button></a>
            <a href="process/delete_data.php?id=<?php echo $id; ?>"><button type="button" class="close_button">Delete</button></a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
