<?php
// had to use help from AI cause the errors were much and i could'nt fix all of them.
include "db.php";
if (isset($_GET['unit_id'])) {
    $polling_unit_id = intval($_GET['unit_id']);
    $query = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $polling_unit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<h2>Results for Polling Unit ID: $polling_unit_id</h2><table border='1'><tr><th>Party</th><th>Score</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['party_abbreviation']}</td><td>{$row['party_score']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found for this Polling Unit.";
    }
    $stmt->close();
} else {
    echo "No polling unit selected.";
}
// DONE AND DUSTED...
?>
