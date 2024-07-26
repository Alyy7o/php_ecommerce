<?php include ("../../connection/conn.php");
session_start();

?>


<?php 

//Deletion

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = "DELETE FROM `categories` WHERE `id` = '$id' ";

    $result = mysqli_query($connection,$query);

    if(!$result){

        die("Query Failed" . mysqli_error());
    }
    else{
        header('location:category.php?delete_msg=Your have Deleted the record');
        exit();
    }
}

?>