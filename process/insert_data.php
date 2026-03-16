<?php
include '../dbcon.php';
if(isset($_POST['add_data'])){

    $fish_type = $_POST['fishtype'];
    $fish_strain = $_POST['fishstrain'];
    $fish_price = $_POST['price'];
    $num_of_fish = $_POST['numoffish'];
    $date_birth = $_POST['datebirth'];
    $fish_image = $_FILES['fish_image']['name'];
    $image_tmp = $_FILES['fish_image']['tmp_name'];

    if($fish_type == "" || empty($fish_type) || $fish_strain == "" || empty($fish_strain) ||$fish_price == "" || empty($fish_price) || $num_of_fish == "" || empty($num_of_fish) || $date_birth == "" || empty($date_birth) || $fish_image == "" || empty($fish_image) || $image_tmp == "" || empty($image_tmp)){
        header('location:../error.php?message=Fill up all the required entry!');
    } else {
    
        if(!empty($fish_image)){
            $image_path = "../uploads/" . $fish_image;
            move_uploaded_file($image_tmp, $image_path);
        } else {
            $fish_image = NULL;
        }

        $query = "INSERT INTO `my_aquatics` (`fish_type`,`fish_strain`,`price`,`num_of_fish`,`date_birth`, `fish_image`) VALUES ('$fish_type','$fish_strain','$fish_price','$num_of_fish','$date_birth', '$fish_image')";
        
        $result = mysqli_query($connection, $query);
        
        if(!$result){
            die("Query Failed".mysqli_error($connection));
        } else {
            header('location:../main.php?message=Data has been added successfully!');
        }
    }

}
?>
