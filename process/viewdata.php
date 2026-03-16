<?php
include('../dbcon.php');

if (isset($_GET['id']) && isset($_POST['update_image'])) {
    $id = $_GET['id'];

    if (isset($_FILES['new_fish_image']) && $_FILES['new_fish_image']['error'] === 0) {
        $image_name = $_FILES['new_fish_image']['name'];
        $image_tmp = $_FILES['new_fish_image']['tmp_name'];

        $target_path = "../uploads/" . $image_name;
        move_uploaded_file($image_tmp, $target_path);

        $query = "UPDATE `my_aquatics` SET `fish_image` = '$image_name' WHERE `id` = '$id'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Update failed: " . mysqli_error($connection));
        } else {
            header("location: ../view.php?id=$id");
            exit();
        }
    } else {
        die("Please select an image to upload.");
    }
} else {
    die("Error!");
}
?>
