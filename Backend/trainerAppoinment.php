<?php
@include 'config.php';
@include 'GetFunctions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Appointments - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ece9e6, #ffffff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        h2 {
            color: #2d3436;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }

        h2::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #0984e3;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background: #0984e3;
            color: #ffffff;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            color: #2d3436;
        }

        tr {
            transition: background 0.2s ease;
        }

        tr:hover {
            background: #f1f5f9;
        }

        .no-appointments {
            text-align: center;
            font-size: 16px;
            color: #636e72;
            padding: 40px 0;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            th, td {
                font-size: 14px;
                padding: 12px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Trainer Appointments</h2>
        
        <?php if (!empty($trainerAppointments)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Trainer Name</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trainerAppointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['trainer_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['customer_email']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-appointments">No trainer appointments found.</div>
        <?php endif; ?>
    </div>
</body>
</html>