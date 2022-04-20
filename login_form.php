<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   //$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = md5($_POST['password']);
   #$cpassword = md5($_POST['cpassword']);
   #$role_type = mysqli_real_escape_string($conn, $_POST['role_type']);

   $result = mysqli_query($conn, " SELECT * FROM users WHERE username = '$username' && password = '$password' ");
   #$secondresult = mysqli_query($conn, "SELECT * FROM users ")
   #$result = mysqli_query($conn, $select);

   /*while ($row = mysqli_fetch_array($result)){
      echo $row['role_type'];
      #echo print_r($row);
   }*/
   

   if(mysqli_num_rows($result) > 0)
   {
      $row = mysqli_fetch_array($result);

      echo $row['role_type'];

      if($row['role_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['first_name'];
         header("location:admin_page.php?username=$username");

      }elseif($row['role_type'] == 'student'){
            echo $row['role_type'];

         $_SESSION['user_name'] = $row['first_name'];
         header("location:student_page.php?username=$username");

      }elseif($row['role_type'] == 'super admin'){

         $_SESSION['super_admin_name'] = $row['first_name'];
         header("location:superadmin_page.php?username=$username");

      }
     
   }else{
      $error[] = 'incorrect username or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      
      <input type="text" name="username" required placeholder="enter your username">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>

</div>

</body>
</html>