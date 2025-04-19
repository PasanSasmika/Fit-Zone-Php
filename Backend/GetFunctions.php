<?php

@include 'config.php';



function getCustomers($conn){
    $sql = "SELECT * FROM userlog";
    $result = $conn->query($sql);
    $customer = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $customer[]=$row;
        }
    }

    return $customer;
}


function getAppointmentclass($conn){
    $sql = "SELECT * FROM customerclass";
    $result = $conn->query($sql);
    $appclass = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $appclass[]=$row;
        }
    }

    return $appclass;
}

function getTrainerAppointments($conn) {
    $sql = "SELECT * FROM customertrainer";
    $result = $conn->query($sql);
    $appointments = [];
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
    }
    return $appointments;
}

$trainerAppointments = getTrainerAppointments($conn);



function getPlanAppointments($conn) {
    $sql = "SELECT * FROM customerplan";
    $result = $conn->query($sql);
    $Pappointments = [];
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Pappointments[] = $row;
        }
    }
    return $Pappointments;
}

$planAppointments = getPlanAppointments($conn);

?>