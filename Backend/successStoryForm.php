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
                header('location:'.$_SERVER['PHP_SELF']);
                exit();
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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Success Stories</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --secondary: #f43f5e;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #94a3b8;
            --light-gray: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-sm: 0.25rem;
            --radius: 0.5rem;
            --radius-lg: 0.75rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark);
            line-height: 1.6;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light-gray);
        }

        .header-container h1 {
            font-size: 2rem;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Messages */
        .message {
            display: block;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: var(--radius-sm);
            font-weight: 500;
        }

        .message[style*="color: red"] {
            background-color: #fee2e2;
            color: var(--danger) !important;
            border-left: 4px solid var(--danger);
        }

        .message[style*="color: green"] {
            background-color: #dcfce7;
            color: var(--success) !important;
            border-left: 4px solid var(--success);
        }

        /* Form Styles */
        form {
            background-color: white;
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            margin-bottom: 3rem;
        }

        form h1 {
            font-size: 1.75rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }

        form h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        input[type="submit"] {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            justify-content: center;
        }

        input[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Success Stories List */
        .success-stories-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .success-story-item {
            background-color: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
        }

        .success-story-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .story-image {
            height: 250px;
            overflow: hidden;
        }

        .story-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .success-story-item:hover .story-image img {
            transform: scale(1.05);
        }

        .story-text {
            padding: 1.5rem;
        }

        .story-name {
            font-size: 1.25rem;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .story-title {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .story-achievement,
        .story-date {
            color: var(--dark);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .story-achievement strong,
        .story-date strong {
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 1.5rem 1.5rem;
        }

        .delete_btn {
            background-color: #fee2e2;
            color: var(--danger);
        }

        .delete_btn:hover {
            background-color: #fecaca;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gray);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--gray);
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .success-stories-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <h1>Success Stories</h1>
            <a href="adminDashbord.html" class="back-button"><i class='bx bxs-arrow-to-left'></i> Back to admin panel</a>
        </div>

        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<span class="message">' . $msg . '</span>';
            }
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <h1>Add a Success Story</h1>
            
            <label for="title">Story Title:</label>
            <input type="text" id="title" name="title" placeholder="Enter story title" required>
            
            <label for="name">Member Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter member's name" required>
            
            <label for="picture">Member Photo:</label>
            <input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" required>
            
            <label for="achievement">Achievement:</label>
            <textarea id="achievement" name="achievement" placeholder="Describe the achievement..." required></textarea>
            
            <label for="date">Date of Achievement:</label>
            <input type="date" id="date" name="date" required>
            
            <input type="submit" name="submit" value="Add Success Story">
        </form>

        <div class="success-stories-list">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM story");
            if(mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) { ?>
                    <div class="success-story-item">
                        <div class="story-image">
                            <img src="upload_img/<?php echo $row['picture']; ?>" alt="Success Story Image">
                        </div>
                        <div class="story-text">
                            <h4 class="story-name"><?php echo htmlspecialchars($row['name']); ?></h4>
                            <p class="story-title"><?php echo htmlspecialchars($row['title']); ?></p>
                            <p class="story-achievement"><strong>Achievement:</strong> <?php echo htmlspecialchars($row['achievement']); ?></p>
                            <p class="story-date"><strong>Achieved Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                        </div>
                        <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn" onclick="return confirm('Are you sure you want to delete this success story?');">
                            <i class='bx bxs-trash'></i> Delete
                        </a>
                    </div>
                <?php }
            } else { ?>
                <div class="empty-state">
                    <i class='bx bx-trophy'></i>
                    <p>No success stories found</p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>