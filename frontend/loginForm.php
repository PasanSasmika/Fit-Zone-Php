<?php
@include 'config.php'; 


if(isset($_POST["submit"])){
    $nameemail = $_POST["nameemail"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM userlog WHERE name = '$nameemail' OR email = '$nameemail'");
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result); 
        if($password == $row["password"]){
            
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("location: index.php"); 
            exit();
        }
        else{
            echo 
            "<script>alert('Wrong Password.');</script>";
        }
    }
    else{
        echo 
        "<script>alert('User Not Registered.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="LogCss.css">
    <title>Login</title>
</head>
<body>
    <div class="background-image"></div>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username_or_email">Username or Email</label>
            <input type="text" id="nameemail" name="nameemail" placeholder="Enter your username or email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button id="bttn" type="submit" name="submit">Login</button>
        </form>

        <span>Don't have an account?</span>
        <a href="registForm.php">Register</a>
    </div>
</body>
</html>