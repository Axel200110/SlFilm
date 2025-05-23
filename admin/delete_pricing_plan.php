<?php
include('conn.php');

if (isset($_GET['id'])) {
    $plan_id = $_GET['id'];
    $sql = "DELETE FROM `add_pricing_plan` WHERE plan_id = $plan_id";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php'); // Redirect back to the dashboard
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
