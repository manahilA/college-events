<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" href="css/style.css">
</head>

<body>

<?php
@include 'config.php';

if (isset($_POST['delete'])) { // Check press or not Post Comment Button
    $id = $_POST['id'];

    //$id = $_GET['id'];
	$sql = "DELETE FROM comments WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Comment updated successfully.')</script>";
	} else {
		echo "<script>alert('Comment failed to update. Please try again later.')</script>";
	}
}
header('location:events.php');

?>
</body>
