<?php

@include 'config.php';

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$name = $_POST['name']; // Get uni name from form
	$location = $_POST['location']; // Get uni address from form
	$no_of_students = $_POST['no_of_students']; // Get no student from form
	$image_url = $_POST['image_url']; // Get image url from form
	$uni_description = $_POST['uni_description']; // Get description from form

	// insert into universities name, location, uni, description, no of students, and image url
	$sql = "INSERT INTO universities (name, location, uni_description, no_of_students, image_url) VALUES ('$name', '$location', '$uni_description', '$no_of_students', '$image_url')";
	
	if ($conn->query($sql) === TRUE) {
		echo "New university added successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	
	
	/*$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Comment added successfully.')</script>";
	} else {
		echo "<script>alert('Comment does not add.')</script>";
	}*/
}

?>


<!DOCTYPE html>
<html>


<div id="page">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="wrapper">
		<form action="" method="POST" class="form">
			<div class="row">
				<div class="input-group">
					<label for="name">University name</label>
					<input type="text" name="name" id="name" placeholder="Enter the name of your institution" required>
				</div>
				<div class="input-group">
					<label for="location">University location</label>
					<input type="text" name="location" id="location" placeholder="Enter the address" required>
				</div>
                <div class="input-group">
					<label for="no_of_students">Number of students</label>
					<input type="number" name="no_of_students" id="no_of_students" placeholder="Enter number of students" required>
				</div>
                <div class="input-group">
					<label for="image_url">Image</label>
					<input type="text" name="image_url" id="image_url" placeholder="Include a picture of the institution" required>
				</div>
			</div>
			<div class="input-group textarea">
				<label for="uni_description">Description</label>
				<textarea id="uni_description" name="uni_description" placeholder="Describe your institution" required></textarea>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>
		</form>
		</div>
	</div>
</body>


		
					
		
    
</div>
		

</html>



</body>
</html>
