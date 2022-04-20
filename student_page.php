<?php

@include 'config.php';

session_start();
error_reporting(0);

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

function listPublicEvents() {
   @include 'config.php';
   $result = mysqli_query($conn, " SELECT event_name, DATE(start_time) AS start_date, TIME(start_time) AS time_start, DATE(end_time) AS end_date, TIME(end_time) AS time_end, university, id FROM events WHERE privacy_level = 'public' AND super_admin_approved = TRUE");
   
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
   $username = $_GET['username'];

   // get rso id
   $stmtid = mysqli_query($conn, "SELECT rso from  rso_members WHERE rso_member = '$username'");
   $queryid = $stmtid->fetch_assoc();
   $rsoid = $queryid['rso'];

   // get event details using rso id
   $result = mysqli_query($conn, " SELECT event_name, DATE(start_time) AS start_date, TIME(start_time) AS time_start, DATE(end_time) AS end_date, TIME(end_time) AS time_end, university, id, rso FROM events WHERE privacy_level = 'rso event' AND rso = '$rsoid'");
   
   // use rso id to get rso name
   $stmtname = mysqli_query($conn, "SELECT name from  rsos WHERE id = '$rsoid'");
   $queryname = $stmtname->fetch_assoc();
   $rsoname = $queryname['name'];
   if (mysqli_num_rows($result) > 0){
      
      while ($row = $result->fetch_assoc()) {
         echo "<tr>";
         $id = $row['id'];
         echo "<td><a href='events.php?id=$id&username=$username'>" . $row["event_name"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["time_start"] . "</td><td>" . $row["end_date"] . "</td><td>". $row["time_end"] . "</td><td>" . $row["university"] . "</td><td>". $rsoname . "</td></tr>";
         #echo "\t" .  $row['event_name'] . "\t" . $row['start_date'] . "\t" . $row['time_start'] . "\t" . $row['end_date'] . "\t" . $row['time_end'] . "<br><br>";
         echo "</tr>";
         }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

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
      <h1>Welcome, <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>logged in as student</p>
      <a href="create_new_rso.php" class="btn">create RSO</a>
      <a href="join_new_rso.php" class="btn">join RSO</a>
      <a href="leave_rso.php" class="btn">leave RSO</a>

<table border="1"
       cellspacing="20">
   <tr>
      <th>Event</th>
      <th>Start Date</th>
      <th>Start Time</th>
      <th>End Date</th>
      <th>End Time</th>
      <th>University</th>
      <th>RSO</th>
   </tr>
   <?php
   listPublicEvents();
   listPrivateEvents();
   listRSOEvents();
   ?>
</table>
</div>
</div>



</body>
</html>
