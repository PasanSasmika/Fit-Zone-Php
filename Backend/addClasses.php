<!-- ADD CLASSES DATABASE FUNCTION -->
<?php
@include 'config.php';

if (isset($_POST['add_class'])) {
    $class_name = trim($_POST['class_name']);
    $class_date = trim($_POST['class_date']);
    $class_time = trim($_POST['class_time']);
    $trainer = trim($_POST['trainer']);
    $description = trim($_POST['description']);
    
    $class_image = trim($_FILES['class_image']['name']);
    $class_image = str_replace(' ', '_', $class_image); 

    if ($class_image == '') {
        $message[] = 'Image file name cannot be empty.';
    } else {
        $class_image_tmp_name = $_FILES['class_image']['tmp_name'];
        $class_image_folder = 'C:/xampp/htdocs/FitZone/Backend/upload_img/' . $class_image;

        if (!is_dir('C:/xampp/htdocs/FitZone/Backend/upload_img')) {
            mkdir('C:/xampp/htdocs/FitZone/Backend/upload_img', 0777, true);
        }

        $imagefiletype = strtolower(pathinfo($class_image_folder, PATHINFO_EXTENSION));
        $check = getimagesize($class_image_tmp_name);
        $uploadOk = 1;

        if (empty($class_name) || empty($class_date) || empty($class_time) || empty($trainer) || empty($description) || empty($class_image)) {
            $message[] = 'Please fill all fields';
        } elseif (!in_array($imagefiletype, ['jpg', 'jpeg', 'png', 'gif'])) {
            $message[] = 'File types allowed are jpg, jpeg, png, gif';
        } else {

            $insert = "INSERT INTO classes(class_name, class_date, class_time, trainer, description, class_image)
                       VALUES('$class_name', '$class_date', '$class_time', '$trainer', '$description', '$class_image')";
            $upload = mysqli_query($conn, $insert);
            
            if ($upload) {
                
                move_uploaded_file($class_image_tmp_name, $class_image_folder);
                $message[] = 'New class added successfully';
            } else {
                $message[] = 'Could not add the class';
            }
        }
    }
}
?>



<!---------------------------ADD CLASS FORM-------------------------->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylei.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <title>Add New Class</title>
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
    <h1>Manage Classes</h1>
    <a href="adminDashbord.html"><i class='bx bxs-user'></i>Back to admin panel</a>
</div>

<div class="class-form">
    <h2>Add New Class</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="type">Class Type:</label>
            <input type="text" id="type" name="class_name">
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="class_date">
        </div>

        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" id="time" name="class_time">
        </div>

        <div class="form-group">
            <label for="trainer">Trainer:</label>
            <input type="text" id="trainer" name="trainer">
        </div>

        <div class="form-group">
            <label for="description">Class Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Class Image:</label>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="class_image">
        </div>

        <div class="form-group">
            <button type="submit" name="add_class">Add Class</button>
        </div>
    </form>
</div>





<!------------------------ VIEW ADDED CLASSES--------------------------- -->




<?php
$select = mysqli_query($conn, "SELECT * FROM classes");
?>

<div class="class-cards-container">
    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
        <div class="class-card">
    <div class="class-card-image">
        <img src="upload_img/<?php echo $row['class_image']; ?>" alt="Class Image">
    </div>
    <div class="class-card-title">
        <h4><?php echo $row['class_name']; ?></h4>
    </div>
    <div class="class-card-info">
        <p class="class-type"><?php echo $row['class_name']; ?></p> <!-- New Class Type -->
        <p><strong>Date:</strong> <?php echo $row['class_date']; ?></p>
        <p><strong>Time:</strong> <?php echo $row['class_time']; ?></p>
        <p><strong>Trainer:</strong> <?php echo $row['trainer']; ?></p>
        <p class="class-card-description"><?php echo $row['description']; ?></p>
    </div>
    <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn"><i class='bx bxs-trash'></i> Delete</a>
</div>

    <?php } ?>
</div>

</body>
</html>
