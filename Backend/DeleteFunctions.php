<?php
@include 'config.php';


// ------------------   CLASS DELETE FUNCTION START-----------//

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM classes WHERE id = $id");
    header('location:addClasses.php');
}



// ------------------   TRAINER DELETE FUNCTION SATART-----------//


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM trainer WHERE id = $id");
    header('location:addTrainers.php');
}



// ------------------   MEMBERSHIP PLAN DELETE FUNCTION START-----------//


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM plans WHERE id = $id");
    header('location: membershipPlan.php');
}


// ------------------   SUCCESS STORIES DELETE FUNCTION START-----------//




if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM story WHERE id = $id");
    header('location: successStoryForm.php');
}



// ----------------------------- DELETE STAFF ==========================/

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM addstff WHERE id = $id");
    header('location: ViewStaff.php');
}








?>