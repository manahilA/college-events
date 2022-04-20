<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['super_admin_name'])){
   header('location:login_form.php');
}

$id = $_GET['id'];
$val = $_GET['val'];

if ($val == 1){
   $stmt = mysqli_query($conn, "UPDATE events SET super_admin_approved = TRUE WHERE id = $id");
}else if ($val == 0){
   $stmt = mysqli_query($conn, "DELETE FROM events WHERE id = $id");
}




header('location:approve_events.php');
?>