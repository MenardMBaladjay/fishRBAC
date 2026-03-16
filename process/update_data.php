<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <?php include('../dbcon.php'); ?>

    <?php 
    
        if(isset($_GET['id'])){
            $id = $_GET['id'];


        $query = "select * from `my_aquatics` where `id` = '$id'";
        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query Failed".mysqli_error($connection));
        }
        else{
            $row = mysqli_fetch_assoc($result);
        }
 }
    ?>

    <?php 

    if(isset($_POST['update_data'])){

        if(isset($_GET['id_new'])){
            $idnew = $_GET['id_new'];
        }

        $fishtype = $_POST['fishtype'];
        $fishstrain = $_POST['fishstrain'];
        $fishprice = $_POST['price'];
        $numoffish = $_POST['numoffish'];
        $datebirth = $_POST['datebirth'];

      
        if(isset($_FILES['new_fish_image']) && $_FILES['new_fish_image']['error'] == 0){
            $new_image_name = $_FILES['new_fish_image']['name'];
            $new_image_tmp = $_FILES['new_fish_image']['tmp_name'];

            
            $image_path = "../uploads/" . $new_image_name;
            move_uploaded_file($new_image_tmp, $image_path);

            $query = "UPDATE `my_aquatics` SET `fish_type` = '$fishtype', `fish_strain` = '$fishstrain', `price` = '$fishprice', `num_of_fish` = '$numoffish', `date_birth` = '$datebirth', `fish_image` = '$new_image_name' WHERE `id` = '$idnew'";
        } else {
            $query = "UPDATE `my_aquatics` SET `fish_type` = '$fishtype', `fish_strain` = '$fishstrain',`price` = '$fishprice', `num_of_fish` = '$numoffish', `date_birth` = '$datebirth' WHERE `id` = '$idnew'";
        }

        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query Failed".mysqli_error($connection));
        } else {
            header('location:../main.php?message=Data has been updated successfully!');
            exit();
        }
    }

    ?>

    <h1 class="home_name">Menard's Acquatics</h1>
    <div class="update_div" style="width:60%; min-height: 10px; border: 2px solid black;">
        <h2 style="margin-top:20px;">Anything Update?</h2>

    
        <form action="update_data.php?id_new=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
           <label for="fishType">Fish Type:</label>
            <select id="fishType" name="fishtype" required>
                <option value="">Select Fish Type</option>
                <option value="guppy" <?php if ($row['fish_type'] == 'guppy') echo 'selected'; ?>>Guppy</option>
                <option value="molly" <?php if ($row['fish_type'] == 'molly') echo 'selected'; ?>>Molly</option>
                <option value="betta" <?php if ($row['fish_type'] == 'betta') echo 'selected'; ?>>Betta Fish</option>
                <option value="goldfish" <?php if ($row['fish_type'] == 'goldfish') echo 'selected'; ?>>Gold Fish</option>
                <option value="angelfish" <?php if ($row['fish_type'] == 'angelfish') echo 'selected'; ?>>Angel Fish</option>
                <option value="danios" <?php if ($row['fish_type'] == 'danios') echo 'selected'; ?>>Danios</option>
                <option value="flowerhorn" <?php if ($row['fish_type'] == 'flowerhorn') echo 'selected'; ?>>Flowerhorn</option>
                <option value="parrotfish" <?php if ($row['fish_type'] == 'parrotfish') echo 'selected'; ?>>Parrot Fish</option>
            </select>
            <label>Fish strain</label>
            <input name="fishstrain" type="text" placeholder="Fish strain" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;" value=" <?php  echo $row['fish_strain']?>">
            <label>Price (₱)</label>
            <input name="price" type="text" placeholder="Price" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;" value=" <?php  echo $row['price']?>">
            <label>No. of Fish</label>
            <input name="numoffish" type="text" placeholder="No. of fish" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;" value=" <?php  echo $row['num_of_fish']?>">
            <label>Date of birth</label>
            <input name="datebirth" type="date" value="<?php  echo $row['date_birth']?>">
            <label>Update Image</label>
            <input type="file" name="new_fish_image" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">
            <div class="button_part">
                <a href="../main.php"><button  type="button" class="button1" style="width:90%; margin-right:10px;">CLOSE</button></a>
                <input type="submit" name="update_data" class="button1" value="UPDATE" style="margin-left:10px;">

            </div>
        </form>
        
    </div>
    <script src="../script.js"></script>
</body>
</html>