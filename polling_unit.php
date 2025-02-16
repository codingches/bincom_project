<?php
include "db.php";

if (isset($_GET['unit_id'])) {
    $polling_unit_id = intval($_GET['unit_id']);

    // Fetch results
    $query = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = $polling_unit_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Results for Polling Unit ID: $polling_unit_id</h2>";
        echo "<table border='1'><tr><th>Party</th><th>Score</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['party_abbreviation'] . "</td><td>" . $row['party_score'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found for this Polling Unit.";
    }
} else {
    echo "No polling unit selected.";
}
?>
