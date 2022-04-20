<?php

@include 'config.php';
$username = $_GET['username'];
if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$rso_name = $_POST['rso_name']; // Get rso name from form
	$event_name = $_POST['event_name']; // Get event name from form
	$start_time = $_POST['start_time']; // Get start time from form
	$end_time = $_POST['end_time']; // Get end time from form
	$university = $_POST['university']; // Get uni name from form
	$location = $_POST['location']; // Get address from form
	$contact = $_POST['contact']; // Get email from form
	$event_description = $_POST['event_description']; // Get description from form

	// get rsos id where rso_name is rsos name
	$stmt = "SELECT id FROM rsos WHERE name = '$rso_name'";
	$result = mysqli_query($conn, $stmt);
	$row = $result->fetch_assoc();

	// if rso admin_username == username
	$username = $_GET['username'];		// get username
	$getadmin = "SELECT admin_username FROM rsos WHERE name = '$rso_name'";		// get admin_username to compare
	$resultadmin = mysqli_query($conn, $getadmin);
	$adminusername = $resultadmin->fetch_assoc();
	if ($adminusername['admin_username'] == $username)
	{
	// insert into event details into events
	$sql = "INSERT INTO events (event_name, start_time, end_time, university, location, contact, privacy_level, event_description, rso) VALUES ('$event_name', '$start_time', '$end_time', '$university', '$location', '$contact', 'rso event', '$event_description', ".$row['id'].")";
	
	if ($conn->query($sql) === TRUE) {
		echo "New event added successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	}else{
		echo "<script>alert('You need to be the admin to create an event for this RSO.')</script>";
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
					<label for="rso_name">RSO Name</label>
					<input type="text" name="rso_name" id="rso_name" placeholder="Enter the name of your RSO" required>
				</div>
				<div class="input-group">
					<label for="event_name">Event Name</label>
					<input type="text" name="event_name" id="event_name" placeholder="Enter the name of your event" required>
				</div>
                <div class="input-group">
					<label for="start_time">Event Date and Time</label>
					<input type="datetime-local" name="start_time" id="start_time" placeholder="YYYY-MM-DD HH:MI:SS" required>
				</div>
                <div class="input-group">
					<label for="end_time">End Date and Time</label>
					<input type="datetime-local" name="end_time" id="end_time" placeholder="YYYY-MM-DD HH:MI:SS" required>
				</div>
				<div class="input-group">
					<label for="location">Location</label>
					<input type="text" name="location" id="location" placeholder="Address" required>
				</div>
				<div class="input-group">
					<label for="university">University Name</label>
					<input type="text" name="university" id="university" placeholder="University name" required>
				</div>
				<div class="input-group">
					<label for="contact">Contact Email</label>
					<input type="text" name="contact" id="contact" placeholder="Include an email" required>
				</div>
				<div class="input-group textarea">
					<label for="event_description">Description</label>
				<textarea id="event_description" name="event_description" placeholder="Describe your event" required></textarea>
			</div>
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
