<!-- ADD CLASSES DATABASE FUNCTION -->
<?php
@include 'config.php';

if (isset($_POST['add_trainer'])) {
    $trainer_name = trim($_POST['trainer_name']);
    $trainer_expe = trim($_POST['trainer_expe']);
    $trainer_Cinfo = trim($_POST['trainer_Cinfo']);
    $description = trim($_POST['description']);
   
 
    // Trim and sanitize the image file name to remove any leading/trailing whitespace and replace spaces
    $trainer_image = trim($_FILES['trainer_image']['name']);
    $trainer_image = str_replace(' ', '_', $trainer_image); // Replace spaces with underscores

    // Additional validation to prevent accidental blank filenames
    if ($trainer_image == '') {
        $message[] = 'Image file name cannot be empty.';
    } else {
        $trainer_image_tmp_name = $_FILES['trainer_image']['tmp_name'];
        $trainer_image_folder = 'C:/xampp/htdocs/FitZone/Backend/upload_img/' . $trainer_image;

        // Ensure the upload directory exists
        if (!is_dir('C:/xampp/htdocs/FitZone/Backend/upload_img')) {
            mkdir('C:/xampp/htdocs/FitZone/Backend/upload_img', 0777, true);
        }

        $imagefiletype = strtolower(pathinfo($trainer_image_folder, PATHINFO_EXTENSION));
        $check = getimagesize($trainer_image_tmp_name);
        $uploadOk = 1;

        if (empty($trainer_name) || empty($trainer_expe) || empty($trainer_Cinfo) || empty($description) ||  empty($trainer_image)) {
            $message[] = 'Please fill all fields';
        } elseif (!in_array($imagefiletype, ['jpg', 'jpeg', 'png', 'gif'])) {
            $message[] = 'File types allowed are jpg, jpeg, png, gif';
        } else {
            // Insert into database without any additional whitespace in image name
            $insert = "INSERT INTO trainer(trainer_name, trainer_expe, trainer_Cinfo, description, trainer_image)
                       VALUES('$trainer_name', '$trainer_expe ', '$trainer_Cinfo', '$description', '$trainer_image')";
            $upload = mysqli_query($conn, $insert);
            
            if ($upload) {
                // Move uploaded file to the server's directory
                move_uploaded_file($trainer_image_tmp_name, $trainer_image_folder);
                $message[] = 'New class added successfully';
            } else {
                $message[] = 'Could not add the class';
            }
        }
    }
}
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

<?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<span class="message">' . $msg . '</span>';
        }
    }
    ?>

<div class="header-container">
    <h1>Manage Trainer</h1>
    <a href="adminDashbord.html"><i class='bx bxs-user'></i>Back to admin panel</a>
</div>
    

<div class="class-form">
    <h2>Add Trainer</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="type">Name</label>
            <input type="text" id="type" name="trainer_name">
        </div>

        <div class="form-group">
            <label for="type">Experties</label>
            <input type="text" id="date" name="trainer_expe">
        </div>

        <div class="form-group">
            <label for="type">contact Info:</label>
            <input type="text" id="time" name="trainer_Cinfo">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Class Image:</label>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="trainer_image">
        </div>

        <div class="form-group">
            <button type="submit" name="add_trainer">Add Class</button>
        </div>
    </form>
</div>




<!------------------------ VIEW ADDED CLASSES--------------------------- -->




<?php
$select = mysqli_query($conn, "SELECT * FROM trainer");
?>

<div class="class-cards-container">
    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
        <div class="class-card">
            <div class="class-card-image">
            <img src="upload_img/<?php echo $row['trainer_image']; ?>" alt="Trainer Image">
            </div>
            <div class="class-card-title">
                <h4><?php echo $row['trainer_name']; ?></h4>
            </div>
            <div class="class-card-info">
                <p><strong>Experties:</strong> <?php echo $row['trainer_expe']; ?></p>
                <p><strong>contact Info:</strong> <?php echo $row['trainer_Cinfo']; ?></p>
                <p class="class-card-description"><?php echo $row['description']; ?></p>
            </div>
            <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn"><i class='bx bxs-trash'></i> Delete</a>

        </div>
    <?php } ?>
</div>
</body>
</html>