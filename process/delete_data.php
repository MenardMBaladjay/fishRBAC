<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    die("Access Denied: Only the owner can delete records.");
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    $query = "DELETE FROM `my_aquatics` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        header('location:../main.php?message=Data has been deleted successfully!');
        exit();
    }
}
?>