<?php
include "db.php";

if (isset($_GET['lga_id'])) {
    $lga_id = intval($_GET['lga_id']);

    $query = "SELECT party_abbreviation, SUM(party_score) AS total_score 
              FROM announced_pu_results 
              WHERE polling_unit_uniqueid IN 
                  (SELECT uniqueid FROM polling_unit WHERE lga_id = $lga_id)
              GROUP BY party_abbreviation";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Total Results for LGA ID: $lga_id</h2>";
        echo "<table border='1'><tr><th>Party</th><th>Total Score</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['party_abbreviation'] . "</td><td>" . $row['total_score'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found for this LGA.";
    }
} else {
    echo "No LGA selected.";
}
?>
