<?php

require_once '../inc/db.php';

$conn = getDBConnection();
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
echo json_encode($employees);

$conn->close();
?>
