<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View & Update Image</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        include('dbcon.php');

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM `my_aquatics` WHERE `id` = '$id'";
            $result = mysqli_query($connection, $query);

            if($result && mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
            } else {
                die("Data not found");
            }
        } else {
            die("Invalid ID");
        }
    ?>
    <h1 class="home_name">Menard's Acquatics</h1>
    <form action="process/viewdata.php?id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="form_container">
            <div class="form_left">
                <label>Fish Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" value=" <?php echo $row['fish_type']; ?>" readonly><br><br>

                <label>Fish Strain:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" value=" <?php echo $row['fish_strain']; ?>" readonly><br><br>

                <label>Price (₱):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" value=" ₱<?php echo $row['price']; ?>" readonly><br><br>

                <label>Number of Fish:</label>
                <input type="text" value=" <?php echo $row['num_of_fish']; ?>" readonly><br><br>

                <label>Date of Birth:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" value=" <?php echo $row['date_birth']; ?>" readonly><br><br>
            </div>

            <div class="form_right">
                <label>Current Image:</label><br>
                <img src="uploads/<?php echo $row['fish_image']; ?>" class="preview_image"><br><br>
                <input type="file" name="new_fish_image" required><br><br>
                <div class="button_part">
                <a href="main.php"><button  type="button" class="button1" style="width:90%; margin-right:10px;">CLOSE</button></a>
                <input type="submit" name="update_image" value="Update Image" class="button1">
                </div>
            </div>
        </div>
    </form>

</body>
</html>
