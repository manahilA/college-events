<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['super_admin_name'])){
   header('location:login_form.php');
}


function listPublicEvents() {
    @include 'config.php';
    $result = mysqli_query($conn, " SELECT event_name, DATE(start_time) AS start_date, TIME(start_time) AS time_start, DATE(end_time) AS end_date, TIME(end_time) AS time_end, university, id FROM events WHERE privacy_level = 'public' AND super_admin_approved = 'FALSE'");
    
    if (mysqli_num_rows($result) > 0){
       while ($row = $result->fetch_assoc()) {
           echo "<tr>";
          $id = $row['id'];
          echo "<td><a href='events.php?id=$id'>" . $row["event_name"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["time_start"] . "</td><td>" . $row["end_date"] . "</td><td>". $row["time_end"] . "</td><td>" . $row["university"] . "</td><td><a href='approve_function.php?id=$id&val=1'>" . 'Approve' . "</td><td><a href='approve_function.php?id=$id&val=0'>" . 'Reject' . "</td></tr>";
          #echo "\t" .  $row['event_name'] . "\t" . $row['start_date'] . "\t" . $row['time_start'] . "\t" . $row['end_date'] . "\t" . $row['time_end'] . "<br><br>";
          }echo "</tr>";
 } else{
    echo "No Results";
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

<div class="container">
   <div class="content">
<table border="1"
       cellspacing="50">
   <tr>
      <th>Event</th>
      <th>Start Date</th>
      <th>Start Time</th>
      <th>End Date</th>
      <th>End Time</th>
      <th>University</th>
      <th>Approve</th>
      <th>Reject</th>
   </tr>
   <?php
   listPublicEvents();
   ?>
</table>
</div>
</div>

</body>
</html>