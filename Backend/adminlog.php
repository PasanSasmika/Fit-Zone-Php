<?php
@include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM adminlog WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        header("Location: adminDashbord.html"); 
        exit();
    } else {
        echo "<script>alert('Login failed. Please try again.'); window.location.href = 'index.html';</script>";
        exit();
    }
}

$conn->close();
?>
