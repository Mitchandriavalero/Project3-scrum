<?php

// Connect to the database
$host = 'localhost';
$dbname = 'project3';
$username = 'User';
$password = 'Project3!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$table = $_GET['table'];
$id = $_GET['id'];

$query = "DELETE FROM $table WHERE id = $id";
$stmt = $conn->prepare($query);
$stmt->execute();

header("Location:index.php");
?>