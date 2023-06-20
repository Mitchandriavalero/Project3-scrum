<?php

// Connect to the database
$host = 'localhost';
$dbname = 'project3';
$username = 'User';
$password = 'Project3!';
$officecode = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Get the id from the URL
if (isset($_GET['id'])) {
    $employees = $_GET['id'];
} else {
    $employees = 0;
}

$stmt = $conn->query("SELECT * FROM employees");


// Fetch all the rows in the result set
$names = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Employees - Offices</title>
</head>

<body>
    <nav>
        <a href="./employees/create-form.php">Create Employees</a>
        <a href="./offices/create-form.php">Create Offices</a>
    </nav>
    <table>
        <thead>
            <tr> Employees
                <th>employeeNumber</th>
                <th>firstName
                <th>lastName</th>
                <th>extension</th>
                <th>email</th>
                <th>officecode</th>
                <th>reportsTo</th>
                <th>jobtitle</th>
                <th>Updated</th>
                <th>Deleted</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($names as $name) : ?>
                <tr>
                    <td><?= $name['employeeNumber'] ?></td>
                    <td><?= $name['firstName'] ?></td>
                    <td><?= $name['lastName'] ?></td>
                    <td><?= $name['extension'] ?></td>
                    <td><?= $name['email'] ?></td>
                    <td><?= $name['officecode'] ?></td>
                    <td><?= $name['reportsTo'] ?></td>
                    <td><?= $name['jobtitle'] ?></td>
                    <td><a href="update-form.php?id=<?= $name['id'] ?>&table=employees">Update</a></td>
                    <td><a href="delete.php?id=<?= $name['id'] ?>&table=employees">Delete</a></td>
                </tr>
            <?php 
                $officecode = $name['officecode'];
                endforeach; 
            ?>
        </tbody>
    </table>
    <table>
        <thead>
            <tr> Offices
                <th>officeCode</th>
                <th>city</th>
                <th>phone</th>
                <th>addressLine1</th>
                <th>addressLine2</th>
                <th>state</th>
                <th>country</th>
                <th>postalCode</th>
                <th>territory</th>
                <th>Updated</th>
                <th>Deleted</th>
            </tr>
        </thead>
        <tbody>
            <?php 

            $stmto = $conn->query("SELECT * FROM offices WHERE officecode=" .$officecode);
            $offices = $stmto->fetchAll();
            foreach ($offices as $office) : ?>
                <tr>
                    <td><?= $office['officeCode'] ?></td>
                    <td><?= $office['city'] ?></td>
                    <td><?= $office['phone'] ?></td>
                    <td><?= $office['addressLine1'] ?></td>
                    <td><?= $office['addressLine2'] ?></td>
                    <td><?= $office['state'] ?></td>
                    <td><?= $office['country'] ?></td>
                    <td><?= $office['postalCode'] ?></td>
                    <td><?= $office['territory'] ?></td>
                    <td><a href="update-form.php?id=<?= $office['id'] ?>&table=offices">Update</a></td>
                    <td><a href="delete.php?id=<?= $office['id'] ?>&table=offices">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>