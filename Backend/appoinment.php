<?php
@include 'config.php';
@include 'GetFunctions.php';


$appclass = getAppointmentclass(conn: $conn);

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
    
<div class="appointment-wrapper">
    <?php foreach($appclass as $appclasss): ?>
        <div class="appointment-item">
            <h4 class="appointment-info customer-name"><?php echo htmlspecialchars($appclasss['name']); ?></h4>
            <h4 class="appointment-info customer-name"><?php echo htmlspecialchars($appclasss['email']); ?></h4>
            <h4 class="appointment-info"><?php echo htmlspecialchars($appclasss['class']); ?></h4>
        </div>
    <?php endforeach; ?>
</div>


</body>
</html>