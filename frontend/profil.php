<?php
@include 'config.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM userlog WHERE id = '$id'");
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
    <style>
        /* CSS Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .section__container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .section__header {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.2rem;
        }
        
        h3 {
            text-align: center;
            color: #3498db;
            font-size: 1.8rem;
            margin-bottom: 30px;
        }
        
        .link {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 768px) {
            .section__container {
                margin: 20px;
                padding: 20px;
            }
            
            .section__header {
                font-size: 1.8rem;
            }
            
            h3 {
                font-size: 1.4rem;
            }
        }
    </style>
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