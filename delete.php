<?php
include("dbconnection.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM client WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

header("location: index.php");
exit;
?>
