<?php

@include 'config.php';

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$event_name = $_POST['event_name']; // Get event name from form
	$start_time = $_POST['start_time']; // Get start time from form
	$end_time = $_POST['end_time']; // Get end time from form
	$university = $_POST['university']; // Get uni name from form
	$location = $_POST['location']; // Get location from form
	$contact = $_POST['contact']; // Get email from form
	$event_description = $_POST['event_description']; // Get description from form

	// insert into events event_name, start time, end time, location, contact, privacy level, event description, id
	$sql = "INSERT INTO events (event_name, start_time, end_time, university, location, contact, privacy_level, event_description, super_admin_approved) VALUES ('$event_name', '$start_time', '$end_time', '$university', '$location', '$contact', 'public', '$event_description', FALSE)";
	
	if ($conn->query($sql) === TRUE) {
		echo "New event added successfully";
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