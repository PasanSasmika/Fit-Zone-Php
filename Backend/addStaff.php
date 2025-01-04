<?php
@include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   
    $sql = "INSERT INTO `addstff`(`name`, `email`, `password`,`role`) 
    VALUES ('$name','$email','$password', '$role')";

    $result = mysqli_query($conn, $sql);

    if($result){
      header("Location:addStaff.php?msg=New record created successfully");
    }
    else{
        echo "Failed: " . mysqli_error($conn);
    }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Staff</title>
  <link rel="stylesheet" href="staffStyle.css">
</head>
<body>
<div class="staff-form-container">
  <form action="" method="post">
  <h2>Add Staff</h2>

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
      <label for="role">Role:</label>
      <select id="role" name="role" required>

        <option value="">Select Role</option>
        <option value="Manager">Manager</option>
        <option value="Trainer">Trainer</option>
        <option value="Accountant">Accountant</option>
        
      </select>
    </div>

    <button type="submit" name="submit">Add Staff</button>
    <button type="submit" onclick="window.location.href='ViewStaff.php';">View Staff</button>

  </form>

</div>





</body>
</html>
