<?php 
session_start();
include('dbcon.php'); 

if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1 class="home_name">Menard's Acquatics</h1>
    <div class="top_div">
        <h2>Registered Fish (Role: <?php echo ucfirst($role); ?>)</h2>
        
        <?php if ($role === 'caretaker' || $role === 'owner'): ?>
            <button onclick="effect()">Add new</button>
        <?php endif; ?>

        <?php if ($role === 'owner'): ?>
            <a href="dashboard.php"><button style="margin-right: 20px;">Dashboard</button></a>
            <a href="export_excel.php"><button>Export All Data</button></a>
            <a href="manage_users.php"><button style="background-color: #ff4d4d;">Manage Users</button></a>
        <?php endif; ?>

        <a href="logout.php"><button style="background-color: gray;">Logout</button></a>
    </div>

    <div class="blur_effect" id="blur"></div>
    
    <div class="popup_add" id="popup" style="background-color: rgba(239, 245, 245,0.9); border:2px solid;">
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
            <input name="fishstrain" type="text" placeholder="Fish strain">
            <label>Price (₱)</label>
            <input name="price" type="text" placeholder="Price">
            <label>No. of Fish</label>
            <input name="numoffish" type="text" placeholder="No. of fish">
            <label>Date of birth</label>
            <input name="datebirth" type="date">
            <label>Add Image</label>
            <input type="file" name="fish_image">
            <div class="button_part">
                <button type="button" onclick="closee()" class="button1">CLOSE</button>
                <input type="submit" name="add_data" class="button1" value="ADD">
            </div>
        </form>
    </div>

    <div class="mainwrapper_div">
        <table style="border-spacing: 1px;">
        <thead>
            <tr style="padding:10px;">
                <th>ID</th>
                <th>Fish Type</th>
                <th>Fish Strain</th>
                
                <?php if ($role !== 'buyer'): ?>
                    <th>Price (₱)</th>
                <?php endif; ?>

                <th>No. of Fish</th>
                <th>Date of Birth</th>
                <th>View Data</th>
                
                <?php if ($role === 'caretaker' || $role === 'owner'): ?>
                    <th>Update</th>
                <?php endif; ?>
                
                <?php if ($role === 'owner'): ?>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM `my_aquatics`";
            $result = mysqli_query($connection, $query);

            if(!$result){
                die("Query Failed".mysqli_error($connection));
            } else {
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fish_type']; ?></td>
                        <td><?php echo $row['fish_strain']; ?></td>
                        
                        <?php if ($role !== 'buyer'): ?>
                            <td>₱<?php echo $row['price']; ?></td>
                        <?php endif; ?>

                        <td><?php echo $row['num_of_fish']; ?></td>
                        <td><?php echo $row['date_birth']; ?></td>
                        <td style="text-align: center; padding:0px;"><a href="view.php?id=<?php echo $row['id']; ?>"><button class="button2">View</button></a></td>
                        
                        <?php if ($role === 'caretaker' || $role === 'owner'): ?>
                            <td style="text-align: center; padding:0px;"><a href="process/update_data.php?id=<?php echo $row['id']; ?>"><button class="button2">Update</button></a></td>
                        <?php endif; ?>

                        <?php if ($role === 'owner'): ?>
                            <td style="text-align: center; padding:0px;"><a href="delete_notif.php?id=<?php echo $row['id']; ?>"><button class="button3">Delete</button></a></td>
                        <?php endif; ?>
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