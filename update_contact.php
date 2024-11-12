<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM contacts WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No contact found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE contacts SET name = '$name', phone = '$phone', email = '$email' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: contacts.php");
        exit();
    } else {
        echo "Error updating contact: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Contact</title>
    
</head>
<body>
    <h2>Update Contact</h2>

    <form action="update_contact.php?id=<?php echo $row['id']; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <input type="submit" value="Update Contact">
    </form>
</body>
</html>

<?php
$conn->close();
?>
