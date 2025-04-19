<?php
// Include PHPMailer classes
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

@include 'config.php';
@include 'GetFunctions.php';

$appclass = getAppointmentclass($conn);


if (isset($_GET['action']) && isset($_GET['email']) && isset($_GET['name']) && isset($_GET['class'])) {
    $action = $_GET['action'];
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_GET['name']);
    $class = htmlspecialchars($_GET['class']);

   
    $mail = new PHPMailer(true);
    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pasansasmika333@gmail.com'; // Replace with your email (2A Verification Email)
        $mail->Password = 'mepazxphomwiazyq'; // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('no-reply@fitzone.com', 'FitZone');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(false); 
        if ($action === 'approve') {
            $mail->Subject = 'Appointment Approved';
            $mail->Body = "Dear $name,\n\nYour appointment for the class '$class' has been approved!\n\nThank you,\nFitZone Team";
        } elseif ($action === 'decline') {
            $mail->Subject = 'Appointment Declined';
            $mail->Body = "Dear $name,\n\nWe regret to inform you that your appointment for the class '$class' has been declined.\n\nThank you,\nFitZone Team";
        }

        // Send email
        $mail->send();
        session_start();
        $_SESSION['message'] = "Email sent successfully for $action!";
    } catch (Exception $e) {
        session_start();
        $_SESSION['error'] = "Failed to send email: {$mail->ErrorInfo}";
    }

    // Redirect to avoid resubmission
    header("Location: appoinment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Appointments</title>
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

        .appointment-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .appointment-item {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }

        .appointment-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .appointment-info {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .appointment-info:before {
            font-family: 'boxicons';
            font-size: 1.2rem;
            color: var(--primary);
        }

        .customer-name:before {
            content: "\f272"; /* User icon */
        }

        .customer-email:before {
            content: "\f32e"; /* Email icon */
        }

        .appointment-class:before {
            content: "\f1ad"; /* Calendar icon */
        }

        .appointment-info {
            font-size: 1rem;
            color: var(--dark);
        }

        .appointment-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed var(--light-gray);
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
            font-size: 0.9rem;
        }

        .btn-approve {
            background-color: #dcfce7;
            color: var(--success);
        }

        .btn-approve:hover {
            background-color: #bbf7d0;
        }

        .btn-decline {
            background-color: #fee2e2;
            color: var(--danger);
        }

        .btn-decline:hover {
            background-color: #fecaca;
        }

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
            
            .header-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .appointment-wrapper {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h1>Appointments</h1>
        <a href="adminDashbord.html"><i class='bx bxs-arrow-to-left'></i> Back to admin panel</a>
    </div>

    <div class="appointment-wrapper">
        <?php if (empty($appclass)): ?>
            <div class="empty-state">
                <i class='bx bx-calendar-x'></i>
                <p>No appointments found</p>
            </div>
        <?php else: ?>
            <?php foreach($appclass as $appclasss): ?>
                <div class="appointment-item">
                    <div class="appointment-info customer-name">
                        <?php echo htmlspecialchars($appclasss['name']); ?>
                    </div>
                    <div class="appointment-info customer-email">
                        <?php echo htmlspecialchars($appclasss['email']); ?>
                    </div>
                    <div class="appointment-info appointment-class">
                        <?php echo htmlspecialchars($appclasss['class']); ?>
                    </div>
                    <div class="appointment-actions">
    <a href="appoinment.php?action=approve&email=<?php echo urlencode($appclasss['email']); ?>&name=<?php echo urlencode($appclasss['name']); ?>&class=<?php echo urlencode($appclasss['class']); ?>" class="btn btn-approve"><i class='bx bx-check'></i> Approve</a>
    <a href="appoinment.php?action=decline&email=<?php echo urlencode($appclasss['email']); ?>&name=<?php echo urlencode($appclasss['name']); ?>&class=<?php echo urlencode($appclasss['class']); ?>" class="btn btn-decline"><i class='bx bx-x'></i> Decline</a>
</div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>