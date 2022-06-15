<?php

include 'config.php';

error_reporting(0);

session_start();
if (isset($_GET['log'])) {
  $username = $_GET['username'];
  $lpassword = md5($_GET['lpassword']);

  $msql = "SELECT * FROM users WHERE email='$username' AND password='$lpassword'";
  $lresult = mysqli_query($conn, $msql);
  if ($lresult->num_rows > 0) {
    $row = mysqli_fetch_assoc($lresult);
    $_SESSION['user'] =[
      "fname" => $row['Fname'],
      "lname" => $row['Lname'],
      "email" => $row['Email'],
      "phone" => $row['Phone'],
      "cpass" => $row['Password']
    ];
    header("Location: index.php");
  } else {
    $_SESSION['messagepas'] = 'Incorrect email or password!';
    header('Location: pr.php');
  }
}
