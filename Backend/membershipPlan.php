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
        header('location:'.$_SERVER['PHP_SELF']);
        exit();
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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Manage Membership Plans</title>
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

        /* Success Message */
        .success-message {
            background-color: #dcfce7;
            color: var(--success);
            padding: 1rem;
            border-radius: var(--radius-sm);
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        form h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
            position: relative;
            padding-bottom: 0.5rem;
        }

        form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        input[type="text"],
        select,
        textarea {
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
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Plan Cards */
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
            position: relative;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .class-card-title {
            padding: 1.5rem 1.5rem 0;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .class-card-title h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .class-card-info {
            padding: 1.5rem;
        }

        .class-card-info p {
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .class-card-info strong {
            color: var(--primary);
            font-weight: 500;
        }

        .class-card-description {
            color: var(--gray);
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
            margin: 1rem 1.5rem 1.5rem;
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

        /* Plan Type Badge */
        .plan-type {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: white;
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            form {
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
        <?php if ($success) : ?>
            <div class="success-message">
                <i class='bx bxs-check-circle'></i>
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <div class="header-container">
            <h1>Manage Plans</h1>
            <a href="adminDashbord.html"><i class='bx bxs-user'></i>Back to admin panel</a>
        </div>

        <form action="" method="POST">
            <h2>Add New Plan</h2>
            
            <label for="membership_plan">Membership Plan:</label>
            <select id="membership_plan" name="membership_plan" required>
                <option value="">Select a plan</option>
                <option value="Basic">Basic</option>
                <option value="Bronze">Bronze</option>
                <option value="Silver">Silver</option>
                <option value="Gold">Gold</option>
                <option value="Premium">Premium</option>
            </select>
            
            <label for="plan_type">Plan Type:</label>
            <select id="plan_type" name="plan_type" required>
                <option value="">Select type</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
            
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" placeholder="Enter price" required>
            
            <label for="description">Service Description:</label>
            <textarea id="description" name="description" placeholder="Describe the plan benefits..." required></textarea>
            
            <label for="trainer">Trainer:</label>
            <input type="text" id="trainer" name="trainer" placeholder="Assigned trainer" required>
            
            <button type="submit" name="submit"><i class='bx bx-plus'></i> Add Plan</button>
        </form>

        <?php
        $select = mysqli_query($conn, "SELECT * FROM plans");
        ?>

        <div class="class-cards-container">
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                <div class="class-card">
                    <span class="plan-type"><?php echo ucfirst($row['plan_type']); ?></span>
                    <div class="class-card-title">
                        <h4><?php echo $row['membership_plan']; ?></h4>
                    </div>
                    <div class="class-card-info">
                        <p><strong>Price:</strong> Rs <?php echo $row['price']; ?></p>
                        <p><strong>Trainer:</strong> <?php echo $row['trainer']; ?></p>
                        <p class="class-card-description"><?php echo $row['description']; ?></p>
                    </div>
                    <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn delete_btn" onclick="return confirm('Are you sure you want to delete this plan?');">
                        <i class='bx bxs-trash'></i> Delete
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>