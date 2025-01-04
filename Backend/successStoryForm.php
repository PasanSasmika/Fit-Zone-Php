<!-- -------------------------------SUCCESS STORY ADDING FUNCTION START----------------------------- -->
<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $name = trim($_POST['name']);
    $achievement = trim($_POST['achievement']);
    $date = trim($_POST['date']);
    
    $picture = trim($_FILES['picture']['name']);
    $picture = str_replace(' ', '_', $picture); 

    if ($picture == '') {
        $message[] = 'Image file name cannot be empty.';
    } else {
        $picture_tmp_name = $_FILES['picture']['tmp_name'];
        $picture_folder = 'C:/xampp/htdocs/FitZone/Backend/upload_img/' . $picture;

        if (!is_dir('C:/xampp/htdocs/FitZone/Backend/upload_img')) {
            mkdir('C:/xampp/htdocs/FitZone/Backend/upload_img', 0777, true);
        }

        $imagefiletype = strtolower(pathinfo($picture_folder, PATHINFO_EXTENSION));
        $check = getimagesize($picture_tmp_name);
        $uploadOk = 1;

        if (empty($title) || empty($name) || empty($achievement) || empty($date) || empty($picture)) {
            $message[] = 'Please fill all fields';
        } elseif (!in_array($imagefiletype, ['jpg', 'jpeg', 'png', 'gif'])) {
            $message[] = 'File types allowed are jpg, jpeg, png, gif';
        } else {

            $insert = "INSERT INTO story(title, name, achievement, date, picture)
                       VALUES('$title', '$name', '$achievement', '$date', '$picture')";
            $upload = mysqli_query($conn, $insert);
            
            if ($upload) {
                move_uploaded_file($picture_tmp_name, $picture_folder);
                $message[] = 'New story added successfully';
            } else {
                $message[] = 'Could not add the Story';
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
    <title>Add Success Story</title>
</head>
<body>
    <div class="success-message-container">
        <div class="success-message">
            <?php
                if (isset($message)) {
                    foreach ($message as $msg) {
                        echo '<span class="message">' . $msg . '</span>';
                    }
                }
            ?>
        </div>
        <div class="header-container">
            <a href="adminDashbord.html" class="back-button"><i class='bx bxs-user'></i>Back to admin panel</a><br/>
        </div>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <h1>Add a Success Story</h1>
        <label for="title">Story Title:</label>
        <input type="text" id="title" name="title" ><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" ><br><br>

        <label for="picture">Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" ><br><br>

        <label for="achievement">Achievement:</label>
        <textarea id="achievement" name="achievement" rows="4" cols="50" ></textarea><br><br>

        <label for="date">Date of Achievement:</label>
        <input type="date" id="date" name="date" ><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>













    <div class="success-stories-list">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM story");
        while ($row = mysqli_fetch_assoc($select)) { ?>
            <div class="success-story-item">
                <div class="story-image">
                    <img src="upload_img/<?php echo $row['picture']; ?>" alt="Story Image">
                </div>
                <div class="story-text">
                    <h4 class="story-name"><?php echo $row['name']; ?></h4>
                    <p class="story-title"><strong><?php echo $row['title']; ?></strong></p>
                    <p class="story-achievement"><strong>Achievement:</strong> <?php echo $row['achievement']; ?></p>
                    <p class="story-date"><strong>Achieved Date:</strong> <?php echo $row['date']; ?></p>
                </div>
                <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn"><i class='bx bxs-trash'></i> Delete</a>

            </div>
        <?php } ?>
    </div>
</body>
</html>
