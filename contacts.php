<?php
// Connect to the database
$db_host = 'localhost';
$db_name = 'contacts';
$db_user = 'root';
$db_pass = 'snehashinde';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Insert the form data into the database
$stmt = $pdo->prepare("INSERT INTO submit (name, email, message) VALUES (:name, :email, :message)");

$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':message', $_POST['message']);

if ($stmt->execute()) {
    // Redirect back to the contact page with a success message
    header("Location: contact.php?status=success");
} else {
    // Redirect back to the contact page with an error message
    header("Location: contact.php?status=error");
}

exit();
?>
