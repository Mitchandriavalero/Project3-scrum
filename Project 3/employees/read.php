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

// Get the id from the URL
if (isset($_GET['id'])){
    $employees = $_GET['id'];
} else {
    $employees = 0;
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE id = $employees");
$stmt->execute();

$names = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bit-academy/Project 3/style.css">
    <title>Detail</title>
</head>

<body>
    <a href="../index.php">
        << terug</a>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>information</th>
                            <th>information</th>
                        </tr>
                    </thead>
                    <tbody> <br>
                        <?php foreach ($names as $name) : ?>
                            <tr>
                                <td>employeeNumber</td>
                                <td><?= $name['employeeNumber'] ?></td>
                            <tr>
                                <td>firstName</td>
                                <td><?= $name['firstName'] ?></td>
                            </tr>
                            <a href="create.php?id=<?= $name['id'] ?>">Details</a>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <td><a href="../employees/update-form.php?id<? echo $_GET['id']?>">Edit</a></td>
</body>
</html>