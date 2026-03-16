<?php include('../dbcon.php')?>

<?php 


    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }


    $query = "delete from `my_aquatics` where  `id` = '$id'";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query Failed".mysqli_error($connection));
    }
    else{
        header('location:../main.php?message=Data has been deleted successfully!');
    }
?>
