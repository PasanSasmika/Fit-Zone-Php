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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Class</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Header */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .header-container h1 {
            font-size: 2rem;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .header-container a {
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

        .header-container a:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Messages */
        .message {
            display: block;
            padding: 1rem;
            margin: 1rem 0;
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
        .class-form {
            background-color: white;
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            margin-bottom: 3rem;
        }

        .class-form h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .class-form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="time"],
        .form-group input[type="file"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .form-group button[type="submit"] {
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
        }

        .form-group button[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Class Cards */
        .class-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .class-card {
            background-color: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .class-card-image {
            height: 200px;
            overflow: hidden;
        }

        .class-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .class-card:hover .class-card-image img {
            transform: scale(1.05);
        }

        .class-card-title {
            padding: 1rem 1.5rem 0;
        }

        .class-card-title h4 {
            font-size: 1.25rem;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .class-card-info {
            padding: 0 1.5rem 1.5rem;
        }

        .class-card-info p {
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .class-card-info strong {
            color: var(--primary);
            font-weight: 500;
        }

        .class-card-description {
            color: var(--gray) !important;
            font-size: 0.9rem;
            margin-top: 0.5rem;
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
            margin-top: 1rem;
        }

        .delete_btn {
            background-color: #fee2e2;
            color: var(--danger);
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .delete_btn:hover {
            background-color: #fecaca;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .class-form {
                padding: 1.5rem;
            }
            
            .class-cards-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
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
                    <input type="text" id="type" name="class_name" placeholder="e.g., Yoga, Crossfit, Zumba">
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
                    <input type="text" id="trainer" name="trainer" placeholder="Trainer's name">
                </div>

                <div class="form-group">
                    <label for="description">Class Description:</label>
                    <textarea id="description" name="description" placeholder="Describe the class..."></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Class Image:</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="class_image">
                </div>

                <div class="form-group">
                    <button type="submit" name="add_class"><i class='bx bx-plus'></i> Add Class</button>
                </div>
            </form>
        </div>

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
                        <p><strong>Date:</strong> <?php echo $row['class_date']; ?></p>
                        <p><strong>Time:</strong> <?php echo $row['class_time']; ?></p>
                        <p><strong>Trainer:</strong> <?php echo $row['trainer']; ?></p>
                        <p class="class-card-description"><?php echo $row['description']; ?></p>
                    </div>
                    <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn"><i class='bx bxs-trash'></i> Delete</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>