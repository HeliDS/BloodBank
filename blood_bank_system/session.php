<?php
   include('connection.php');  

   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $session_sql = mysqli_query($conn,"select username from users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($session_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>