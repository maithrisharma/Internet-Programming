<?php
require_once 'connection.php';
session_start();

 if(!isset($_SESSION['user_login'])) //check unauthorize user not access in "delete.php" page
 {
  header("location: index.php");
 }
 
if (isset($_GET['id'])){
    $ID = (int)$_GET['id'];
    $delete= $db->prepare("DELETE FROM Recipes WHERE id=$ID LIMIT 1");
    $delete->execute();
    if ($delete){
        echo '<script>alert("Recipe deleted successfully !")</script>';
        echo '<script>window.location.href="home.php";</script>';
    }
}
?>