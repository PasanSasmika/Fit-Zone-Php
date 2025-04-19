<?php
@include 'config.php';
@include 'GetFunctions.php';

$customer = getCustomers(conn: $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Customers</title>
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

        .customer-list-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .customer-list-container > h1 {
            font-size: 2rem;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }

        .customer-list-container > h1::after {
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

        .customer-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .customer-card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .customer-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .customer-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .customer-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .customer-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .customer-email {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 1rem;
            word-break: break-all;
        }

        .customer-details {
            width: 100%;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed var(--light-gray);
            display: flex;
            justify-content: space-around;
        }

        .detail-item {
            text-align: center;
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .detail-value {
            font-weight: 600;
            color: var(--primary);
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
            
            .customer-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h1>Customers</h1>
        <a href="adminDashbord.html"><i class='bx bxs-arrow-to-left'></i> Back to admin panel</a>
    </div>

    <div class="customer-list-container">
        <h1>Our Valued Customers</h1>
        <div class="customer-list">
            <?php if (empty($customer)): ?>
                <div class="empty-state">
                    <i class='bx bx-user-x'></i>
                    <p>No customers found</p>
                </div>
            <?php else: ?>
                <?php foreach($customer as $customers): ?>
                    <div class="customer-card">
                        <div class="customer-avatar">
                            <?php echo strtoupper(substr(htmlspecialchars($customers['name']), 0, 1)); ?>
                        </div>
                        <h4 class="customer-name"><?php echo htmlspecialchars($customers['name']); ?></h4>
                        <h4 class="customer-email"><?php echo htmlspecialchars($customers['email']); ?></h4>
                        <div class="customer-details">
                            <div class="detail-item">
                                <div class="detail-label">Member Since</div>
                                <div class="detail-value">2023</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Plan</div>
                                <div class="detail-value">Premium</div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>