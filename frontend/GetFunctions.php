<?php 

@include 'config.php';


function getClass($conn){
    $sql = "SELECT * FROM classes";
    $result = $conn->query($sql);
    $class = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $class[]=$row;
        }
    }

    return $class;
}



function getTrainers($conn){
    $sql = "SELECT * FROM trainer";
    $result = $conn->query($sql);
    $trainer = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $trainer[]=$row;
        }
    }

    return $trainer;
}


function getPlans($conn){
    $sql = "SELECT * FROM plans";
    $result = $conn->query($sql);
    $plan = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $plan[]=$row;
        }
    }

    return $plan;
}


function getStory($conn){
    $sql = "SELECT * FROM story";
    $result = $conn->query($sql);
    $story = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $story[]=$row;
        }
    }

    return $story;
}



?>


