<?php

  $db_conn = mysqli_connect('localhost', 'root', '','student_mentor');

  if (!$db_conn) {
    echo 'connection failed';
    exit;
    
  }
 

  // session_start();
  if(empty($_SESSION) || !isset($_SESSION['login']))
  {
    session_start();
  }
//   date_default_timezone_set('Asia/Kolkata');
//   include('functions.php');
?>