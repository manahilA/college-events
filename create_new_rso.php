<?php

@include 'config.php';

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$name = $_POST['name']; // Get rso name from form
	$admin_username = $_POST['admin_username']; // Get admin username from form
	$rso_member_one = $_POST['rso_member_one']; // Get members from form
	$rso_member_two = $_POST['rso_member_two']; 
	$rso_member_three = $_POST['rso_member_three']; 
	$rso_member_four = $_POST['rso_member_four']; 
	$rso_description = $_POST['rso_description']; // Get description from form

	// get uni from admin username
	$stmt = "SELECT university FROM users WHERE username = '$admin_username'";
	$result = mysqli_query($conn, $stmt);
	$row = $result->fetch_assoc();

	$stmt_admin = "SELECT email FROM users WHERE username = '$admin_username'";
	$result_admin = mysqli_query($conn, $stmt_admin);
	$row_admin = $result_admin->fetch_assoc();

	$stmt_one = "SELECT email FROM users WHERE username = '$rso_member_one'";
	$result_one = mysqli_query($conn, $stmt_one);
	$row_one = $result_one->fetch_assoc();

	$stmt_two = "SELECT email FROM users WHERE username = '$rso_member_two'";
	$result_two = mysqli_query($conn, $stmt_two);
	$row_two = $result_two->fetch_assoc();

	$stmt_three = "SELECT email FROM users WHERE username = '$rso_member_three'";
	$result_three = mysqli_query($conn, $stmt_three);
	$row_three = $result_three->fetch_assoc();

	$stmt_four = "SELECT email FROM users WHERE username = '$rso_member_four'";
	$result_four = mysqli_query($conn, $stmt_four);
	$row_four = $result_four->fetch_assoc();

	// check domains
	$parts = explode('@', $row_admin['email']);
	$domain = $parts[1];

	$parts_member_one = explode('@', $row_one['email']);
	$domain_member_one = $parts_member_one[1];

	$parts_member_two = explode('@', $row_two['email']);
	$domain_member_two = $parts_member_two[1];

	$parts_member_three = explode('@', $row_three['email']);
	$domain_member_three = $parts_member_three[1];

	$parts_member_four = explode('@', $row_four['email']);
	$domain_member_four = $parts_member_four[1];

	if($domain != $domain_member_one || $domain != $domain_member_two || $domain != $domain_member_three || $domain != $domain_member_four)
	{
		echo "<script>alert('One of the members is not from the same university, or does not have the same email domain.')</script>";	
	}else{
		
	// insert rso name, rso desc, admin username, university into rsos
	$sql = mysqli_query($conn, "INSERT INTO rsos (name, rso_description, admin_username, university) VALUES ('$name', '$rso_description', '$admin_username', '".$row['university']."')");

	// after inserting, get rsos id to insert rso members
	$stmt_five = "SELECT id FROM rsos WHERE name = '$name'";
	$result_stmt = mysqli_query($conn, $stmt_five);
	$row_five = $result_stmt->fetch_assoc();


	// add other members to rso_members
	$insert = mysqli_query($conn, "INSERT INTO rso_members (rso, rso_member) VALUES (".$row_five['id'].", '$admin_username')");
	$insert_one = mysqli_query($conn, "INSERT INTO rso_members (rso, rso_member) VALUES (".$row_five['id'].", '$rso_member_one')");
	$insert_two = mysqli_query($conn, "INSERT INTO rso_members (rso, rso_member) VALUES (".$row_five['id'].", '$rso_member_two')");
	$insert_three = mysqli_query($conn, "INSERT INTO rso_members (rso, rso_member) VALUES (".$row_five['id'].", '$rso_member_three')");
	$insert_four = mysqli_query($conn, "INSERT INTO rso_members (rso, rso_member) VALUES (".$row_five['id'].", '$rso_member_four')");

	// change user username from student to admin
	$statement = "UPDATE users SET role_type='admin' WHERE username='$admin_username'";
	$stmtresult = mysqli_query($conn, $statement);
	if ($stmtresult) {
		echo "<script>alert('New RSO sucessfully created.')</script>";
	} else {
		echo "<script>alert('Failed to add new RSO. Please try again later.')</script>";
	}
	
	/*$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('RSO added successfully.')</script>";
	} else {
		echo "<script>alert('RSO not added.')</script>";
	}*/
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
					<label for="admin_username">Admin username</label>
					<input type="text" name="admin_username" id="admin_username" placeholder="Enter your admin's username" required>
				</div>
                <div class="input-group">
					<label for="rso_member_one">Member username</label>
					<input type="text" name="rso_member_one" id="rso_member_one" placeholder="Enter your member's username" required>
				</div>
                <div class="input-group">
					<label for="rso_member_two">Member username</label>
					<input type="text" name="rso_member_two" id="rso_member_two" placeholder="Enter your member's username" required>
				</div>
                <div class="input-group">
					<label for="rso_member_three">Member username</label>
					<input type="text" name="rso_member_three" id="rso_member_three" placeholder="Enter your member's username" required>
				</div>
                <div class="input-group">
					<label for="rso_member_four">Member username</label>
					<input type="text" name="rso_member_four" id="rso_member_four" placeholder="Enter your member's username" required>
				</div>
			</div>
			<div class="input-group textarea">
				<label for="rso_description">RSO Description</label>
				<textarea id="rso_description" name="rso_description" placeholder="Describe your RSO" required></textarea>
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
