<?php

// ------------------ADD PLANS DATABASE FUNCTION START---------------------------//
@include 'config.php';

$success = ''; // Initialize a success message variable

if (isset($_POST['submit'])) {
    $membership_plan = $_POST['membership_plan'];
    $plan_type = $_POST['plan_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $trainer = $_POST['trainer'];

    $sql = "INSERT INTO `plans`(`id`, `membership_plan`, `plan_type`, `price`, `description`, `trainer`) 
    VALUES (NULL, '$membership_plan', '$plan_type', '$price', '$description', '$trainer')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = "New plan added successfully!";
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

// ------------------ADD PLANS DATABASE FUNCTION ENDS---------------------------//

?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylei.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
<?php if ($success) : ?>
    <div class="success-message">
        <i class='bx bxs-check-circle'></i> <!-- Success icon -->
        <?php echo $success; ?>
    </div>
<?php endif; ?>
<div class="header-container">
    <h1>Manage plans</h1>
    <a href="adminDashbord.html"><i class='bx bxs-user'></i>Back to admin panel</a>
</div>

<form action="" method="POST">
<h2>Add New Plan</h2>
  <label for="membership_plan">Membership Plan:</label>
  <select id="membership_plan" name="membership_plan">
    <option value="Bacis">Basic</option>
    <option value="Bronze">Bronze</option>
    <option value="Silver">Silver</option>
    <option value="Gold">Gold</option>
    <option value="Premium">Premium</option>
  </select>
  <br>

  <label for="plan_type">Plan Type:</label>
  <select id="plan_type" name="plan_type">
    <option value="monthly">Monthly</option>
    <option value="yearly">Yearly</option>
  </select>
  <br>

  <label for="price">Price:</label>
  <input type="text" id="price" name="price" >
  <br>

  <label for="description">Service Description:</label>
  <textarea id="description" name="description" rows="4" cols="50"></textarea>
  <br>

  <label for="trainer">Trainer:</label>
  <input type="text" id="trainer" name="trainer" >
  <br>

  <button type="submit" name="submit">Submit</button>
</form>





<!-- ----------------------------SHOW MEMBER SHIP FUNCTIONS-------------------------------- -->


<?php
$select = mysqli_query($conn, "SELECT * FROM plans");
?>

<div class="class-cards-container">
    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
        <div class="class-card">
            <div class="class-card-title">
                <h4><?php echo $row['membership_plan']; ?></h4>
            </div>
            <div class="class-card-info">
                <p><strong>Type:</strong> <?php echo $row['plan_type']; ?></p>
                <p><strong>Price:</strong> <?php echo $row['price']; ?></p>
                <p><strong>Trainer:</strong> <?php echo $row['trainer']; ?></p>
                <p class="class-card-description"><?php echo $row['description']; ?></p>
            </div>
            <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn"><i class='bx bxs-trash'></i> Delete</a>
        </div>
        
    <?php } ?>
</div>

</body>
</html>