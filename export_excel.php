<?php
include('dbcon.php');

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FishData.xls");

$query = "SELECT * FROM my_aquatics";
$result = mysqli_query($connection, $query);

echo "<table border='1'>";
echo "<tr>
<th>ID</th>
<th>Fish Type</th>
<th>Fish Strain</th>
<th>Price (₱)</th>
<th>No. of Fish</th>
<th>Date of Birth</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['fish_type']}</td>
    <td>{$row['fish_strain']}</td>
    <td>{$row['price']}</td>
    <td>{$row['num_of_fish']}</td>
    <td>{$row['date_birth']}</td>
    </tr>";
}

echo "</table>";
?>
