<?php
include('conn.php');

if (isset($_GET['ID'])) {
    $cat_id = $_GET['ID'];
    $sql = "DELETE FROM `admin_add_item_movies` WHERE `id` = $cat_id";
    $result = mysqli_query($conn, $sql);
   

    if ($result) {
       header("Location: newItem.php" );
    } 
}