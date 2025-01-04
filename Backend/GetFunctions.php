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






?>