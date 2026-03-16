<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include('dbcon.php'); ?>

    <h1 class="home_name">Menard's Acquatics</h1>
    <div class="top_div">
        <h2>Registered Fish</h2>
        <button onclick = "effect()">Add new</button>
        <a href="dashboard.php"><button style="margin-right: 20px;">Dashboard</button></a>
        <a href="export_excel.php"><button>Export All Data</button></a>
    </div>
    <div class="blur_effect" id="blur"></div>
    <div class="popup_add" id="popup" style="background-color: rgba(239, 245, 245,0.9);; border:2px solid;">
        <h2 style="background-color: rgba(239, 245, 245,0.9);">Anything new?</h2>
        <form action="process/insert_data.php" method="post" enctype="multipart/form-data">
            <label>Fish Type:</label>
            <select id="fishType" name="fishtype" required>
                <option value="">Select Fish Type</option>
                <option value="guppy">Guppy</option>
                <option value="molly">Molly</option>
                <option value="betta">Betta Fish</option>
                <option value="goldfish">Gold Fish</option>
                <option value="angelfish">Angel Fish</option>
                <option value="danios">Danios</option>
                <option value="flowerhorn">Flowerhorn</option>
                <option value="parrotfish">Parrot Fish</option>
            </select>
            <label>Fish strain</label>
            <input name="fishstrain" type="text" placeholder="Fish strain" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">
            <label>Price (₱)</label>
            <input name="price" type="text" placeholder="Price" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">
            <label>No. of Fish</label>
            <input name="numoffish" type="text" placeholder="No. of fish" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">
            <label>Date of birth</label>
            <input name="datebirth" type="date">
            <label>Add Image</label>
            <input type="file" name="fish_image" style="color: black; font-size: 15px; font-family: 'Times New Roman', Times, serif;">
            <div class="button_part">
                <button  type="button" onclick = "closee()" class="button1">CLOSE</button>
                <input type="submit" name="add_data" class="button1" value="ADD">
            </div>
        </form>
        
    </div>
    <div class="mainwrapper_div">
        <table style="border-spacing: 1px; ">
        <thead>
            <tr style="padding:10px;">
                <th>ID</th>
                <th>Fish Type</th>
                <th>Fish Strain</th>
                <th>Price (₱)</th>
                <th>No. of Fish</th>
                <th>Date of Birth</th>
                <th>View Data</th>
                <th>Update</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php 
            
            $query = "select * from `my_aquatics`";
            
            $result = mysqli_query($connection, $query);

            if(!$result){
                die("Query Failed".mysqli_error($connection));
            }
            else{
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['fish_type']; ?></td>
                            <td><?php echo $row['fish_strain']; ?></td>
                            <td>₱<?php echo $row['price']; ?></td>
                            <td><?php echo $row['num_of_fish']; ?></td>
                            <td><?php echo $row['date_birth']; ?></td>
                            <td style=" text-align: center; padding:0px;"><a href="view.php?id=<?php echo $row['id']; ?>"><button class="button2">View</button></a></td>
                            <td style=" text-align: center; padding:0px;"><a href="process/update_data.php?id=<?php echo $row['id']; ?>"><button class="button2">Update</button></a></td>
                            <td style=" text-align: center; padding:0px;"><a href="delete_notif.php?id=<?php echo $row['id']; ?>"><button class="button3">Delete</button></a></td>
                        </tr>
                    <?php 
                }
            }
             ?>
             
        </tbody>
    </table>

    <?php 
    
        if(isset($_GET['message'])){
            echo "<h6>".$_GET['message']."</h6>";
        }
    
    ?>
     
    </div>
    
    <script src="script.js"></script>
</body>
</html>