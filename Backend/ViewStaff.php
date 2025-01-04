<?php

@include 'config.php';







?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="staffStyle.css">
    <title>Staff List</title>
</head>
<body>
    <div class="staff-table-container">
        <h2>Staff List</h2>
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
        @include 'config.php';
        $sql = "SELECT * FROM `addstff`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){

            
            ?>

                        <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name']?> </td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['password']?></td>
                    <td><?php echo $row['role']?></td>
                    <td>
                   

                     <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="del"><i class='bx bxs-trash'></i> Delete</a>
                        
                    </td>
                </tr>
           
            <?php

        }
    
    ?>
                
               
            </tbody>
        </table>
    </div>
</body>
</html>
