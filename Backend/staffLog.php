<?php
@include 'config.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Escape user inputs for security
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM addstff WHERE email ='$email' AND password ='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if a matching record was found
        if (mysqli_num_rows($result) > 0) {
            header("Location: appoinment.php?error=none");
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Failed to login: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staffStyle.css">

    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h3>Welcome to Fit Zone</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required />
                    </div>
                    <div class="form-group">
                        <button class="btn" name="login"  >Log In</button>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
</body>
</html>