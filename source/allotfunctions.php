<?php
  // Get Number Of Requests for a Particular residents
  function getRequestCount($db){
    $tower_name = substr($_SESSION['username'], -1);
    $query_request_count = "Select count(*) from cleanrequest cr inner join residents s on cr.house_id=s.house_id where s.tower='$tower_name'";
    $result_request_count = mysqli_query($db, $query_request_count);
    if (mysqli_num_rows($result_request_count) == 1) {
      $countRow = mysqli_fetch_assoc($result_request_count);
    }
    return $countRow;
  }

  // Get Number Of Complaints for a Particular residents
  function getComplantCount($db){
    $tower_name = substr($_SESSION['username'], -1);
    $query_complaint_count = "Select count(*) from complaints cr inner join residents s on cr.house_id=s.house_id where s.tower='$tower_name'";
    $result_complaint_count = mysqli_query($db, $query_complaint_count);
    if (mysqli_num_rows($result_complaint_count) == 1) {
      $countRow = mysqli_fetch_assoc($result_complaint_count);
    }
    return $countRow;
  }

  // Get Number Of Suggestions for a Particular residents
  function getSuggestionCount($db){
    $tower_name = substr($_SESSION['username'], -1);
    $query_suggestion_count = "Select count(*) from suggestions cr inner join residents s on cr.house_id=s.house_id where s.tower='$tower_name'";
    $result_suggestion_count = mysqli_query($db, $query_suggestion_count);
    if (mysqli_num_rows($result_suggestion_count) == 1) {
      $countRow = mysqli_fetch_assoc($result_suggestion_count);
    }
    return $countRow;
  }

  // Get Number Of Request, Housekeeper & Feedback Info
  function getRequests($username, $db){
    $tower = substr($username, -1);

    $query_request = "select cr.worker_id as wid, cr.date, cr.cleaningtime, cr.req_status, cr.request_id, hk.name, fd.rating, fd.timein, fd.timeout, s.house_number, s.tower from 
    residents s Inner Join cleanrequest cr on s.house_id = cr.house_id 
    Left Join housekeeper hk on cr.worker_id = hk.worker_id 
    Left Join feedback fd on fd.request_id = cr.request_id
    where s.tower = '$tower'
    Order by cr.date desc";
    $result_request = mysqli_query($db, $query_request);
    return $result_request;
  }

    // Get Complaints in Detail
    function getComplaints($username, $db){
      $tower = substr($username, -1);
  
      $query_request = "select c.complaint, fb.rating, cr.date, hk.name, s.house_number from
      complaints c Inner Join feedback fb on c.feedback_id = fb.feedback_id
      Inner Join cleanrequest cr on fb.request_id = cr.request_id
      Inner Join housekeeper hk on cr.worker_id = hk.worker_id
      Inner Join residents s on c.house_id = s.house_id
      where s.tower = '$tower'
      Order by cr.date desc";
      $result_request = mysqli_query($db, $query_request);
      return $result_request;
    }

    // Get Complaints in Detail
    function getSuggestions($username, $db){
      $tower = substr($username, -1);
  
      $query_request = "select sg.suggestion, fb.rating, cr.date, hk.name, s.house_number from
      suggestions sg Inner Join feedback fb on sg.feedback_id = fb.feedback_id
      Inner Join cleanrequest cr on fb.request_id = cr.request_id
      Inner Join housekeeper hk on cr.worker_id = hk.worker_id
      Inner Join residents s on sg.house_id = s.house_id
      where s.tower = '$tower'
      Order by cr.date desc";
      $result_request = mysqli_query($db, $query_request);
      return $result_request;
    }

?>