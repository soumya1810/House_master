<?php
  // Get Resident Row - Its Information
  function getResidents($id, $db){
    $query_find_residents = "select * from residents where house_id='$id'";
    $result_find_residents= mysqli_query($db,$query_find_residents);
    if (mysqli_num_rows($result_find_residents) == 1) {
      $residents = mysqli_fetch_assoc($result_find_residents);
    }
    return $residents;
  }

  // Get Number Of Requests for a Particular Resident
  function getRequestCount($id, $db){
    $query_request_count = "Select count(*) from cleanrequest where house_id='$id'";
    $result_request_count = mysqli_query($db, $query_request_count);
    if (mysqli_num_rows($result_request_count) == 1) {
      $countRow = mysqli_fetch_assoc($result_request_count);
    }
    return $countRow;
  }

  // Get Number Of Complaints for a Particular Resident
  function getComplantCount($id, $db){
    $query_complaint_count = "Select count(*) from complaints where house_id='$id'";
    $result_complaint_count = mysqli_query($db, $query_complaint_count);
    if (mysqli_num_rows($result_complaint_count) == 1) {
      $countRow = mysqli_fetch_assoc($result_complaint_count);
    }
    return $countRow;
  }

  // Get Number Of Suggestions for a Particular Resident
  function getSuggestionCount($id, $db){
    $query_suggestion_count = "Select count(*) from suggestions where house_id='$id'";
    $result_suggestion_count = mysqli_query($db, $query_suggestion_count);
    if (mysqli_num_rows($result_suggestion_count) == 1) {
      $countRow = mysqli_fetch_assoc($result_suggestion_count);
    }
    return $countRow; 
  }

  // Get Number Of Request, Housekeeper & Feedback Info
  function getRequests($id, $db){
    $query_request = "Select cr.request_id as reqid, hk.worker_id,cr.req_status,hk.name,cr.date, cr.cleaningtime, fd.timein, fd.timeout from cleanrequest cr Left Join housekeeper hk on cr.worker_id=hk.worker_id Left Join feedback fd on cr.request_id = fd.request_id where cr.house_id='$id'";
    $result_request = mysqli_query($db, $query_request);
    return $result_request;
  }

?>