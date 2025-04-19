<?php
@include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   
    $sql = "INSERT INTO `addstff`(`name`, `email`, `password`,`role`) 
    VALUES ('$name','$email','$password', '$role')";

    $result = mysqli_query($conn, $sql);

    if($result){
      header("Location:addStaff.php?msg=New record created successfully");
      exit();
    }
    else{
        $error = "Failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Staff</title>
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

    .success-message {
      background-color: #dcfce7;
      color: var(--success);
      border-left: 4px solid var(--success);
    }

    .error-message {
      background-color: #fee2e2;
      color: var(--danger);
      border-left: 4px solid var(--danger);
    }

    /* Form Styles */
    .staff-form-container {
      background-color: white;
      padding: 2rem;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow);
      max-width: 600px;
      margin: 0 auto;
    }

    .staff-form-container h2 {
      font-size: 1.75rem;
      color: var(--primary-dark);
      margin-bottom: 1.5rem;
      text-align: center;
      position: relative;
      padding-bottom: 1rem;
    }

    .staff-form-container h2::after {
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

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--dark);
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid var(--light-gray);
      border-radius: var(--radius-sm);
      font-family: inherit;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }

    .form-group input[type="password"] {
      letter-spacing: 1px;
    }

    .button-group {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }

    button {
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
      flex: 1;
      justify-content: center;
    }

    button:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }

    button.secondary {
      background-color: white;
      color: var(--primary);
      border: 1px solid var(--primary);
    }

    button.secondary:hover {
      background-color: #f8fafc;
    }

    /* Role Badges */
    .role-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 2rem;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .role-manager {
      background-color: #e0f2fe;
      color: #0369a1;
    }

    .role-trainer {
      background-color: #dcfce7;
      color: #166534;
    }

    .role-accountant {
      background-color: #fef3c7;
      color: #92400e;
    }

    /* Responsive */
    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }
      
      .button-group {
        flex-direction: column;
      }
      
      button {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header-container">
      <h1>Staff Management</h1>
      <a href="adminDashbord.html" class="back-button"><i class='bx bxs-arrow-to-left'></i> Back to admin panel</a>
    </div>

    <?php
    if(isset($_GET['msg'])) {
      echo '<div class="message success-message"><i class="bx bxs-check-circle"></i> ' . htmlspecialchars($_GET['msg']) . '</div>';
    }
    if(isset($error)) {
      echo '<div class="message error-message"><i class="bx bxs-error-circle"></i> ' . $error . '</div>';
    }
    ?>

    <div class="staff-form-container">
      <form action="" method="post">
        <h2>Add Staff</h2>

        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" placeholder="Enter staff member's name" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter staff member's email" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>

        <div class="form-group">
          <label for="role">Role:</label>
          <select id="role" name="role" required>
            <option value="">Select Role</option>
            <option value="Manager">Manager</option>
            <option value="Trainer">Trainer</option>
            <option value="Accountant">Accountant</option>
          </select>
        </div>

        <div class="button-group">
          <button type="submit" name="submit"><i class='bx bx-user-plus'></i> Add Staff</button>
          <button type="button" class="secondary" onclick="window.location.href='ViewStaff.php';"><i class='bx bx-list-ul'></i> View Staff</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>