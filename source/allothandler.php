<?php
  session_start();
  require("db.php");

    // ================== Clean Request Handler =================== //
  //alloting workers
    if(isset($_POST['allotSubmit']) && isset($_SESSION['username'])){
      $reqId = mysqli_real_escape_string($db, $_POST['allotId']);
      $workerId = mysqli_real_escape_string($db, $_POST['workerId']);
  
      $allot_query = "Update cleanrequest set worker_id = '$workerId', req_status=1 where request_id = '$reqId'";
      $allot_result = mysqli_query($db,$allot_query);
      if ($allot_result) {
        $_SESSION['worker_alloted'] = "Housekeeper successfully alloted";
      }else {
        $_SESSION['allotment_failed'] = "Failed to allot worker, contact site management.";
      }
      header("Location: allot.php");
    }

    // residents Registration
    if(isset($_POST['regSubmit']) && isset($_SESSION['username'])){
      $house_id = mysqli_real_escape_string($db, $_POST['regId']);
      $housenumber = mysqli_real_escape_string($db, $_POST['regHouse']);
      $floornumber = mysqli_real_escape_string($db, $_POST['regFloor']);
      $password = md5(12345);
      $housenumber = strtolower($housenumber);

      $tower_name = substr($_SESSION['username'], -1);
      $reg_query = "Insert into residents values ('$house_id', '$password', '$housenumber', '$floornumber', '$tower_name')";
      $reg_result = mysqli_query($db, $reg_query);
      if($reg_result){
        $_SESSION['residents_registered'] = 'Residents with House_id '. $house_id .' is Registered.';
      } else{
        $_SESSION['residents_registered'] = 'Residents is already Registered!';
      }
      header("Location: registerresidents.php");
    }


    // Worker Registration
    if(isset($_POST['regKeeperSubmit']) && isset($_SESSION['username'])){
      $name = mysqli_real_escape_string($db, $_POST['regName']);
      $floornumber = mysqli_real_escape_string($db, $_POST['regFloor']);
      $tower_name = substr($_SESSION['username'], -1);

      $name = strtolower($name);

      $reg_query = "Insert into housekeeper (name, tower, floor) values ('$name', '$tower_name', '$floornumber')";
      $reg_result = mysqli_query($db, $reg_query);
      if($reg_result){
        $_SESSION['worker_registered'] = 'New Housekeeper Registered.';
      } else{
        $_SESSION['worker_registered'] = 'Resistration Failed!';
      }
      header("Location: registerworker.php");
    }

?>