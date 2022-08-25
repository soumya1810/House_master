<?php
session_start();
require("db.php");

$errors = array();

// ========================= LOGIN STUDENT =======================
if(isset($_POST['residentsLogin'])){
  $house_id = mysqli_real_escape_string($db, $_POST['residentsId']);
  $password = mysqli_real_escape_string($db, $_POST['residentsPass']);
  $house_id = (int)$house_id;
  $password = md5($password);
  $query_find_residents = "select * from residents where house_id='$house_id'";
  $result_find_residents = mysqli_query($db,$query_find_residents);
  if (mysqli_num_rows($result_find_residents) == 1) {
    $row = mysqli_fetch_assoc($result_find_residents);
    if($password == $row['password']){
      $_SESSION['house_id'] = $house_id;
      $_SESSION['residents_logged'] = "You are now logged in";
      header("Location: index.php");
    }else{
      array_push($errors, "Wrong password! Please try again.");
    }
  }else {
    array_push($errors, "resident not found!");
  }
}

// ========================= LOGIN ADMIN` =======================
if(isset($_POST['adminLogin'])){
  $adminUsername = mysqli_real_escape_string($db, $_POST['adminUsername']);
  $adminPassword = mysqli_real_escape_string($db, $_POST['adminPassword']);
  
  $adminPassword = md5($adminPassword);
  $query_find_admin = "select * from admin where username='$adminUsername'";
  $result_find_admin = mysqli_query($db,$query_find_admin);
  if (mysqli_num_rows($result_find_admin) == 1) {
    $row = mysqli_fetch_assoc($result_find_admin);
    if($adminPassword == $row['password']){
      $_SESSION['username'] = $adminUsername;
      $_SESSION['admin_logged'] = "You are now logged in";
      header("Location: allot.php");
    }else{
      array_push($errors, "Wrong password! Please try again.");
    }
  }else {
    array_push($errors, "Admin not found!");
  }
}

?>