<?php

@include 'config.php';

if(isset($_POST['submit'])){
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
   $password = md5($_POST['password']);
   $cpassword = md5($_POST['cpassword']);
   $university = mysqli_real_escape_string($conn, $_POST['university']);
   $role_type = $_POST['role_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exists!';

   }else{

      if($password != $cpassword){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO contacts(email, f_name, l_name, phone_no) VALUES('$email', '$first_name', '$last_name', '$phone_no')";
         mysqli_query($conn, $insert);
         $insert = "INSERT INTO users(username, first_name, last_name, email, password, role_type, university) VALUES('$username', '$first_name','$last_name', '$email','$password','$role_type', '$university')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="enter your username">
      <input type="text" name="first_name" required placeholder="enter your first name">
      <input type="text" name="last_name" required placeholder="enter your last name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="number" name="phone_no" required placeholder="enter your phone number">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="text" name="university" required placeholder="enter your university name">
      <select name="role_type">
         <option value="student">student</option>
         <option value="admin">admin</option>
         <option value="super admin">super admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>