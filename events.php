<?php

@include 'config.php';
session_start();
error_reporting(0);

$location = "UF";
$username = $_GET['username'];
$id = $_GET['id'];

function listEventInfo() {
	
    
	try
    {
        @include 'config.php';
        
		$id = $_GET['id'];
        $stmt = $conn->prepare("SELECT e.event_name, e.event_description, DATE(e.start_time) AS start_date, location, e.contact FROM events e INNER JOIN contacts ON contacts.email = e.contact WHERE e.id = (?)");
        $stmt->bind_param("i", $id);	

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $GLOBALS['location'] = $row['location'];

		echo "<p> <font color=black size='6t'>Name: " . $row['event_name'] . "</font></p>";
        echo"<br>";
        echo"<br>";
		echo "<p> <font color=black size='3pt'>Description: " . $row['event_description'] . "</font></p>";
		echo "<p> <font color=black size='3pt'>Date: " . $row['start_date'] . "</font></p>";
		echo "<p> <font color=black size='3pt'>Contact Email: " . $row['contact'] . "</font></p>";


    }
    catch(Exception $e)
    {
        print_r($e);
        /*** if we are here, something has gone wrong with the database ***/
        echo 'We are unable to process your request. Please try again later';
    }	
	
}

function listCommentsAndRatings() {
	
	try
    {
        @include 'config.php';
        #$result = mysqli_query($conn, "SELECT e.event_name, e.event_description, DATE(e.start_time) AS start_date, e.google_place_id, e.contact FROM events e, contacts c INNER JOIN contacts ON e.contact = c.contact_email WHERE e.id = ?");
        //$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the select statement ***/
        //$stmt = $dbh->prepare("SELECT event_name, event_description, DATE(start_time) AS start_date, events.contact INNER JOIN contacts ON events.contact = contacts.contact_email, google_place_id FROM events WHERE id = :id");        
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT c.comment_text, c.rating FROM comments c, events e WHERE e.id = c.event_id AND e.id = (?)");
        $stmt->bind_param("i", $id);
		
        $stmt->execute();
        $result = $stmt->get_result();
		/*** execute the prepared statement ***/
        //$stmt->execute();
		
		//$result = $stmt->fetch(PDO::FETCH_ASSOC);		
        echo "<br>";
		echo "<h3>Comments: </h3>";
		echo "<br>";

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<p>" . $row['comment_text'] . "\t\t\t" . "Rating: " .$row['rating'] . "</p>" . "<a href=/>Remove</a>";
            echo"<br><br>";
        }        
        //$result = $stmt->get_result();
        //$row = $result->fetch_array(MYSQLI_ASSOC);

		//$GLOBALS['location'] = $result['google_place_id'];
		//echo "<p> <font color=black size='8t'>Name: " . $row['event_name'] . "</font></p>";
		//echo "<p> <font color=black size='3pt'>Description: " . $row['event_description'] . "</font></p>";
		//echo "<p> <font color=black size='4pt'>Date: " . $row['start_date'] . "</font></p>";
		#echo "<h3>Contact Phone: " . $row['contact_phone'] . "</h3>";
		//echo "<p> <font color=black size='4pt'>Contact Email: " . $row['contact'] . "</font></p>";


    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        echo 'We are unable to process your request. Please try again later';
    }	
	
}

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$user = $_POST['user']; // Get user from form
	$rating = $_POST['rating']; // Get rating from form
	$comment_text = $_POST['comment_text']; // Get Comment from form

    $id = $_GET['id'];
	$sql = "INSERT INTO comments (comment_text, rating, user, event_id)
			VALUES ('$comment_text', '$rating', '$user', $id)";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Comment added successfully.')</script>";
	} else {
		echo "<script>alert('Comment does not add.')</script>";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styles.css">

</head>
<div>

		<?php 
		
			listEventInfo();
			echo "<br>";
			//listCommentsAndRatings();
		
		?>
</div>




<body>
<div id="page">

	<div class="wrapper">
		<form action="" method="POST" class="form">
			<div class="row">
				<div class="input-group">
					<label for="user">Username</label>
					<input type="text" name="user" id="user" placeholder="Enter your Username" required>
				</div>
				<div class="input-group">
					<label for="rating">Rating</label>
					<input type="number" name="rating" id="rating" placeholder="Enter your rating (0-5)" required>
				</div>
			</div>
			<div class="input-group textarea">
				<label for="comment_text">Comment</label>
				<textarea id="comment_text" name="comment_text" placeholder="Enter your Comment" required></textarea>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Post Comment</button>
			</div>
		</form>
		<div class="prev-comments">
            <?php 
            
            $sql = "SELECT * FROM comments WHERE event_id = '$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
            <div class="single-item">
                <h4>User: <?php echo $row['user']; ?></h4>
                <p>Rating: <?php echo $row['rating']; ?></p>
                <p>Comment: <?php echo $row['comment_text']; ?></p>

				<div style="display: inline-block">
                <?php if ($row['user'] == $username) {?>
                <form method = 'POST' action='editcomment.php'>
                    <input type='hidden' name='id' value=' <?= $row['id'] ?> '>
                    <input type='hidden' name='user' value='<?=  $row['user'] ?> '>
                    <input type='hidden' name='rating' value='<?= $row['rating'] ?> '>
                    <input type='hidden' name='comment_text' value='<?= $row['comment_text'] ?> '>
                    <button class="button">Edit</button>
                </form>
                <?php } ?>

				<?php if ($row['user'] == $username) {?>
                <form method = 'POST' action='deletecomment.php'>
                    <input type='hidden' name='id' value=' <?= $row['id'] ?> '>
                    <button name='delete' class="button">Delete</button>
                </form>
                <?php } ?>
				</div>           
                
            </div>
            <?php

                }
            }
            
            ?>
        </div>
	</div>
	


		
					
		
    
</div>
		
		<br>

<iframe 
    width="640"
    height="480" 
    frameborder="0" 
    scrolling="no" 
    marginheight="0" 
    marginwidth="0" 
    src="https://maps.google.it/maps?q=<?php echo $location; ?>&output=embed"></iframe>
		
</body>
</html>

