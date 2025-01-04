<?php
@include 'config.php';


if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result  = mysqli_query($conn, "SELECT * FROM userlog WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("location: loginForm.php");
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
<div class="profile-section section__container">
        <h1 class="section__header">Profile</h1>
        <h3><?php echo $row["name"]; ?></h3>
        
        <ul class="link">
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </div>
</body>
</html>