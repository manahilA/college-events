<?php

@include 'config.php';

session_start();
error_reporting(0);

if(!isset($_SESSION['super_admin_name'])){
   header('location:login_form.php');
}


function listPublicEvents() {
    @include 'config.php';
    $result = mysqli_query($conn, " SELECT event_name, DATE(start_time) AS start_date, TIME(start_time) AS time_start, DATE(end_time) AS end_date, TIME(end_time) AS time_end, university, id FROM events WHERE privacy_level = 'public' AND super_admin_approved = TRUE");
    
    if (mysqli_num_rows($result) > 0){

       while ($row = $result->fetch_assoc()) {
         echo "<tr>";
          $id = $row['id'];
          echo "<td><a href='events.php?id=$id'>" . $row["event_name"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["time_start"] . "</td><td>" . $row["end_date"] . "</td><td>". $row["time_end"] . "</td><td>" . $row["university"] . "</td></tr>";
          echo "<tr>";
          #echo "\t" .  $row['event_name'] . "\t" . $row['start_date'] . "\t" . $row['time_start'] . "\t" . $row['end_date'] . "\t" . $row['time_end'] . "<br><br>";
          }
 }
 }
 function listPrivateEvents() {
   @include 'config.php';
   $result = mysqli_query($conn, " SELECT event_name, DATE(start_time) AS start_date, TIME(start_time) AS time_start, DATE(end_time) AS end_date, TIME(end_time) AS time_end, university, id FROM events WHERE privacy_level = 'private'");
   
   if (mysqli_num_rows($result) > 0){
      while ($row = $result->fetch_assoc()) {
         echo "<tr>";
         $id = $row['id'];
         $username = $_GET['username'];
         echo "<td><a href='events.php?id=$id&username=$username'>" . $row["event_name"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["time_start"] . "</td><td>" . $row["end_date"] . "</td><td>". $row["time_end"] . "</td><td>" . $row["university"] . "</td></tr>";
         #echo "\t" .  $row['event_name'] . "\t" . $row['start_date'] . "\t" . $row['time_start'] . "\t" . $row['end_date'] . "\t" . $row['time_end'] . "<br><br>";
         echo "</tr>";
      }
}
}

function listRSOEvents() {
    @include 'config.php';
    $result = mysqli_query($conn, " SELECT event_name, DATE(start_time) AS start_date, TIME(start_time) AS time_start, DATE(end_time) AS end_date, TIME(end_time) AS time_end, university, id FROM events WHERE privacy_level = 'rso event'");
    
    if (mysqli_num_rows($result) > 0){
       echo "<table>";
       while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          echo "<a href='events.php?id=$id'>" . $row["event_name"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["time_start"] . "</td><td>" . $row["end_date"] . "</td><td>". $row["time_end"] . "</td><td>" . $row["university"] . "</td></tr>";
          #echo "\t" .  $row['event_name'] . "\t" . $row['start_date'] . "\t" . $row['time_start'] . "\t" . $row['end_date'] . "\t" . $row['time_end'] . "<br><br>";
          }echo "</table>";
 }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>super admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <header>
      <img class="logo" src="images/logo.svg" alt="logo">
      <nav>
         <ul class="nav_links">
            <li><a href="#">Services</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">About</a></li>
         </ul>
      </nav>
      <a href="logout.php" class="cta"><button>Logout</button></a>
   </header>


<div class="container">

   <div class="content">
       <h1>Welcome, <span><?php echo $_SESSION['super_admin_name'] ?></span></h1>
       <p>logged in as super admin</p>
       <a href="create_university_profile.php" class="btn">Create University Profile</a>
       <a href="approve_events.php" class="btn">Approve Events</a>

<table border="1"
       cellspacing="20">
   <tr>
      <th>Event</th>
      <th>Start Date</th>
      <th>Start Time</th>
      <th>End Date</th>
      <th>End Time</th>
      <th>University</th>
   </tr>
   <?php
   listPublicEvents();
   //listRSOEvents();
   ?>
</table>
</div>
</div>

</body>
</html>