<?php
// report all errors cause this guy was giving me a lot of problems.
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $polling_unit_id = isset($_POST['polling_unit_id']) ? intval($_POST['polling_unit_id']) : 0;
    $party = isset($_POST['party']) ? trim($_POST['party']) : "";
    $score = isset($_POST['score']) ? intval($_POST['score']) : 0;

    if (empty($polling_unit_id) || empty($party) || empty($score)) {
        echo "❌ All fields are required!";
        exit();
    }

    $check_query = "SELECT * FROM polling_unit WHERE uniqueid = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $polling_unit_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows === 0) {
        echo "❌ Error: Polling Unit ID does not exist!";
        exit();
    }
    $check_stmt->close();

    $stmt = $conn->prepare("INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address) VALUES (?, ?, ?, 'Excel', NOW(), '127.0.0.1')");
    $stmt->bind_param("isi", $polling_unit_id, $party, $score);

    if ($stmt->execute()) {
        echo "✅ Result added successfully!";
    } else {
        echo "❌ Error inserting data: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
