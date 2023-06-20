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
    $offices = $_GET['id'];
} else {
    $offices = 0;
}

$stmt = $conn->prepare("SELECT * FROM offices WHERE id = $offices");
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
                                <td>officeCode</td>
                                <td><?= $name['officeCode'] ?></td>
                            <tr>
                                <td>city</td>
                                <td><?= $name['city'] ?></td>
                            </tr>
                            <tr>
                                <td>phone</td>
                                <td><?= $name['phone'] ?></td>
                            </tr>
                            <tr>
                                <td>addressLine1</td>
                                <td><?= $name['addressLine1'] ?></td>
                            </tr>
                            <tr>
                                <td>addressLine2</td>
                                <td><?= $name['addressLine2'] ?></td>
                            </tr>
                            <tr>
                                <td>state</td>
                                <td><?= $name['state'] ?></td>
                            </tr>
                            <tr>
                                <td>country</td>
                                <td><?= $name['country'] ?></td>
                            </tr>
                            <tr>
                                <td>postalCode</td>
                                <td><?= $name['postalCode'] ?></td>
                            </tr>
                            <tr>
                                <td>territory</td>
                                <td><?= $name['territory'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
</body>
</html>