<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header("Location: main.php");
    exit();
}

$admin_name = $_SESSION['username'];

$query = " SELECT fish_type, COUNT(*) AS entries, SUM(num_of_fish) AS total_fish, SUM(price * num_of_fish) AS total_value FROM my_aquatics GROUP BY fish_type ";

$result = mysqli_query($connection, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1 class="home_name">Menard's Acquatics</h1>
    
    <div class="top_div">
        <h2>Dashboard (Owner Access Only)</h2>
        <a href="main.php"><button style="margin-right: 10px;">Back</button></a>
        <button id="exportPDF">Export All Data</button>
        <a href="logout.php"><button style="margin-right: 10px;">Logout</button></a>
    </div>

    <div class="wrapper_div">
        <div class="dashboard_div" style="background-color: rgba(236, 248, 248, 0.5); border: 2px solid; padding: 20px;">
            <h2 style="font-family: 'Times New Roman', Times, serif;">Welcome, <?php echo htmlspecialchars($admin_name); ?>!</h2>
            <h3 style="margin-top: 20px;">Fish Inventory Summary</h3>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color: rgba(0, 255, 255, 0.5);">
                        <th style="padding: 10px; border: 1px solid black;">Fish Type</th>
                        <th style="padding: 10px; border: 1px solid black;">Total Entries</th>
                        <th style="padding: 10px; border: 1px solid black;">Total No. of Fish</th>
                        <th style="padding: 10px; border: 1px solid black;">Total Value (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td style="padding: 10px; border: 1px solid black;"><?php echo htmlspecialchars($row['fish_type']); ?></td>
                            <td style="padding: 10px; border: 1px solid black;"><?php echo $row['entries']; ?></td>
                            <td style="padding: 10px; border: 1px solid black;"><?php echo $row['total_fish']; ?></td>
                            <td style="padding: 10px; border: 1px solid black;">₱<?php echo number_format($row['total_value'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="script.js"></script>
</body>
</html>