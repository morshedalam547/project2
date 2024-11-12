<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM contacts WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: contacts.php");
        exit();
    } else {
        echo "Error deleting contact: " . $conn->error;
    }
}

$conn->close();
?>
