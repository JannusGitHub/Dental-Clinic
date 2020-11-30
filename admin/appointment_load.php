<?php 
    require('connection.php');
    require('../includes/auth_session.php');

    if(!isset($_SESSION['user']))
    {
        $_SESSION['user'] = session_id(); //generate current session_id for the current user
    }
    $session_uid = $_SESSION['user'];  // set session user to session_uid  
    $datetime_string = date('c',time()); 

    $patientName = $_SESSION['nickname'];
    $patientMobileNumber = $_SESSION['patientMobileNumber'];
    $status = 'Pending'; //default values of Status

    $data = array();
    $start = $connection->real_escape_string($_GET["start"]);
    $end = $connection->real_escape_string($_GET["end"]);
    $query = "SELECT * FROM appointment_table WHERE (date(start_time) >= '".$start."' AND date(start_time) <= '".$end."') AND session_uid='".$session_uid."'";

    $result = $connection->query($query);

    $result->fetch_all(MYSQLI_ASSOC);

    foreach($result as $row){
        $data[] = array(
            'id'                => $row['id'],
            'title'             => $row['title'],
            'start'             => $row['start_time'],
            'end'               => $row['end_time']
        );
    }
    echo json_encode($data);
?>