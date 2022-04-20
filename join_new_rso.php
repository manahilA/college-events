<?php

@include 'config.php';

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$name = $_POST['name']; // Get rso name from form
	$rso_member = $_POST['rso_member']; // Get Comment from form

    //$id = $_GET['id'];
    // search for rsos where name is $name and get id
	$stmt = "SELECT id FROM rsos WHERE name = '$name'";
	$result = mysqli_query($conn, $stmt);
	$row = $result->fetch_assoc();

    // insert id and username into rso_members
    $id = $row['id'];
	$sql = "INSERT INTO rso_members (rso, rso_member)
			VALUES ('$id', '$rso_member')";
	
	// get number of members in rso from rso_members
    $members = "SELECT * FROM rso_members WHERE rso = '$id'";
    $query = mysqli_query($conn, $members);
    $numrows = mysqli_num_rows($query);

	$result = mysqli_query($conn, $sql);
	if ($result && ($numrows >= 4)) {
		echo "<script>alert('Joined RSO successfully. RSO Active.')</script>";
	} else if ($result && $numrows < 4){
		echo "<script>alert('Joined RSO successfully. RSO still Inactive.')</script>";
	} else {
		echo "<script>alert('Could not join RSO at this time. Please try again later.')</script>";
	}
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
					<label for="name">RSO Name</label>
					<input type="text" name="name" id="name" placeholder="Enter your RSO Name" required>
				</div>
				<div class="input-group">
					<label for="rso_member">Your username</label>
					<input type="text" name="rso_member" id="rso_member" placeholder="Enter your username" required>
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
