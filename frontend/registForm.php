<?php
@include 'config.php'; 

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    $duplicate = mysqli_query($conn, "SELECT * FROM userlog WHERE name = '$name' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo 
        "<script>alert('User Already Exist');</script>";
    }
    else{
        if($password == $confirm_password){

            $query = "INSERT INTO userlog (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            echo
            "<script>alert('User Added');</script>";
        }
        else{
            echo
            "<script>alert('Password Does Not Match');</script>";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />

    <title>Document</title>
</head>
<body>
    


<form action="" method="POST">
<h2>Registation</h2>
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
  </div>

  <div class="form-group">
    <label for="confirm-password">Confirm Password:</label>
    <input type="password" id="confirm-password" name="confirm-password" required>
  </div>

  <button id="bttn" type="submit" name="submit">Submit</button>

  <span>Already have an account</span>
  <a href="loginForm.php">Login</a>
</form>

</body>
</html>