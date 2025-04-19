<?php
@include 'config.php';






if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM trainer WHERE id = $id");
    header('location:adminDashbord.html');
}





if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM classes WHERE id = $id");
    header('location:adminDashbord.html');
}



if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM plans WHERE id = $id");
    header('location:adminDashbord.html');
}







if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM story WHERE id = $id");
    header('location:adminDashbord.html');
}



// ----------------------------- DELETE STAFF ==========================/

// if (isset($_GET['delete'])) {
//     $id = $_GET['delete'];
//     mysqli_query($conn, "DELETE FROM addstff WHERE id = $id");
//     header('location: ViewStaff.php');
// }








?>