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
$stmt = $conn->query("SELECT * FROM employees");


// Fetch all the rows in the result set
$employees = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Employees</title>
</head>

<body>
    <form method="post">

        <h1>Employees toevoegen</h1>
        <a href="/bit-academy/Project 3/index.php">Home</a>

        <p>employeeNumber</p>
        <input type="text" name="employeeNumber">
        <p>firstName</p>
        <input type="text" name="firstName">
        <p>lastname</p>
        <input type="text" name="lastName">
        <p>extension</p>
        <input type="text" name="extension">
        <p>email</p>
        <input type="email" name="email">
        <p>officeCode</p>
        <input type="text" name="officecode">
        <p>reportsTo</p>
        <input type="text" name="reportsTo">
        <p>jobtitle</p>
        <input type="text" name="jobtitle">
        <br>
        <input type="submit" value="add">
    </form>
</body>
<?php
if (!isset($_POST['firstName'])) {
    return;
}
$EmployeeNumberNew = $_POST['employeeNumber'];
$FirstNameNew = $_POST['firstName'];
$LastNameNew = $_POST['lastName'];
$ExtensionNew = $_POST['extension'];
$EmailNew = $_POST['email'];
$OfficeCodeNew = $_POST['officecode'];
$ReportsToNew = $_POST['reportsTo'];
$JobtitleNew = $_POST['jobtitle'];

try {
    $sql = "INSERT INTO employees 
    (employeeNumber, firstName, lastName, extension, email, officecode, reportsTo, jobtitle) 
            VALUES (:employeeNumberNew, :firstNameNew, :lastNameNew, :extensionNew, :emailNew, 
                :officecodeNew, :reportsToNew, :jobtitleNew)";

    $stmt = $conn->prepare($sql);
    $data = [
        'employeeNumberNew' => $EmployeeNumberNew,
        'firstNameNew' => $FirstNameNew,
        'lastNameNew' => $LastNameNew,
        'extensionNew' => $ExtensionNew,
        'emailNew' => $EmailNew,
        'officecodeNew' => $OfficeCodeNew,
        'reportsToNew' => $ReportsToNew,
        'jobtitleNew' => $JobtitleNew
    ];


    $query_execute = $stmt->execute($data);

    if ($query_execute) {
        $sql = "SELECT id FROM employees WHERE employeeNumber = $EmployeeNumberNew";
        $stmt = $conn->query($sql);
        $id = $stmt->fetch()['id'];

        $_SESSION['message'] = "Updated Successfully";
        header('Location:../index.php?id=' . $id);
        exit(0);
    } else {
        $_SESSION['message'] = "Not Updated";
        header('Location:index.php');
        exit(0);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

</html>