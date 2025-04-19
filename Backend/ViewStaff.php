<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
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

        /* Staff Table */
        .staff-table-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 2rem;
            overflow-x: auto;
        }

        .staff-table-container h2 {
            font-size: 1.75rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .staff-table-container h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .staff-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .staff-table th {
            background-color: var(--primary);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 500;
        }

        .staff-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--light-gray);
            vertical-align: middle;
        }

        .staff-table tr:last-child td {
            border-bottom: none;
        }

        .staff-table tr:hover {
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

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #dbeafe;
            color: var(--primary);
        }

        .btn-edit:hover {
            background-color: #bfdbfe;
        }

        .btn-del {
            background-color: #fee2e2;
            color: var(--danger);
        }

        .btn-del:hover {
            background-color: #fecaca;
        }

        /* Password masking */
        .password-mask {
            letter-spacing: 2px;
            font-family: monospace;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .staff-table th, 
            .staff-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }
            
            .btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
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

        <div class="staff-table-container">
            <h2><i class='bx bxs-group'></i> Staff List</h2>
            <table class="staff-table">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `addstff`";
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $role_class = '';
                            switch($row['role']) {
                                case 'Manager': $role_class = 'role-manager'; break;
                                case 'Trainer': $role_class = 'role-trainer'; break;
                                case 'Accountant': $role_class = 'role-accountant'; break;
                            }
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="password-mask">••••••••</td>
                                <td><span class="role-badge <?php echo $role_class; ?>"><?php echo htmlspecialchars($row['role']); ?></span></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="DeleteFunctions.php?delete=<?php echo $row['id']; ?>" class="btn btn-del" onclick="return confirm('Are you sure you want to delete this staff member?');">
                                            <i class='bx bxs-trash'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="empty-state"><i class="bx bx-user-x"></i><p>No staff members found</p></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>