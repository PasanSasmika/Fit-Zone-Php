<?php
@include 'config.php';
@include 'GetFunctions.php';


$customer = getCustomers(conn: $conn);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylei.css">

    <title>Document</title>
</head>
<body>
    
<div class="customer-list-container">
        <h1>Our All Customers</h1>
    <div class="customer-list">
        <?php foreach($customer as $customers): ?>
            <div class="customer-card">
                <h4 class="customer-name"><?php echo htmlspecialchars($customers['name']); ?></h4>
                <h4 class="customer-email"><?php echo htmlspecialchars($customers['email']); ?></h4>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</body>
</html>