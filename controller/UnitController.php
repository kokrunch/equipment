<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemType = $_POST['itemType'];
    $itemName = $_POST['itemName'];
    $quantity = $_POST['quantity'];

    // Debugging
    echo "Item Type: $itemType<br>";
    echo "Item Name: $itemName<br>";
    echo "Quantity: $quantity<br>";

    if ($itemType === 'equipment') {
        $sql = "INSERT INTO equipment (name, quantity) VALUES (?, ?)";
    } elseif ($itemType === 'supplies') {
        $sql = "INSERT INTO supplies (name, quantity) VALUES (?, ?)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $itemName, $quantity);

    if ($stmt->execute()) {
        echo "Item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
