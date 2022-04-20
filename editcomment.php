<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" href="css/style.css">
</head>

<body>

<?php
@include 'config.php';

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
    $id = $_POST['id'];
	$user = $_POST['user']; // Get user from form
	$rating = $_POST['rating']; // Get rating from form
	$comment_text = $_POST['comment_text']; // Get Comment from form

    //$id = $_GET['id'];
	$sql = "UPDATE comments SET comment_text='$comment_text', rating='$rating' WHERE id='$id'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Comment updated successfully.')</script>";
	} else {
		echo "<script>alert('Comment failed to update. Please try again later.')</script>";
	}
}




$id = $_POST['id']; // Get comment from form
$user = $_POST['user']; // Get username from form
$rating = $_POST['rating']; // Get rating from form
$comment_text = $_POST['comment_text']; // Get Comment from form
echo "<form method='POST' action='editcomment.php'>
<input type='hidden' name='id' value='" . $id . "'>
<input type='hidden' name='user' value='" . $user . "'>Rating:
<input type='number' name='rating' value='" . $rating . "'><br>Comment:
<textarea name='comment_text'>".$comment_text."</textarea><br>
<button type='submit' name ='submit'>Edit</button>
</form>";

?>
</body>