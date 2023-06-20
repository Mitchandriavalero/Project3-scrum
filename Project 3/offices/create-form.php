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
$stmt = $conn->query("SELECT * FROM offices");


// Fetch all the rows in the result set
$offices = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Offices</title>
</head>

<body>
    <form method="post">

        <h1>Offices toevoegen</h1>
        <a href="/bit-academy/Project 3/index.php">Home</a>

        <p>officeCode</p>
        <input type="text" name="officeCode">
        <p>city</p>
        <input type="text" name="city">
        <p>phone</p>
        <input type="text" name="phone">
        <p>addressLine1</p>
        <input type="text" name="addressLine1">
        <p>addressLine2</p>
        <input type="text" name="addressLine2">
        <p>state</p>
        <input type="text" name="state">
        <p>country</p>
        <input type="text" name="country">
        <p>postalCode</p>
        <input type="text" name="postalCode">
        <p>territory</p>
        <input type="text" name="territory">
        <br>
        <input type="submit" value="add">
    </form>
</body>
<?php
if (!isset($_POST['officeCode'])) {
    return;
}
$officeCodeNew = $_POST['officeCode'];
$cityNew = $_POST['city'];
$phoneNew = $_POST['phone'];
$addressLine1New = $_POST['addressLine1'];
$addressLine2New = $_POST['addressLine2'];
$stateNew = $_POST['state'];
$countryNew = $_POST['country'];
$postalCodeNew = $_POST['postalCode'];
$territoryNew = $_POST['territory'];

try {
    $sql = "INSERT INTO offices
    (officeCode, city, phone, addressLine1, addressLine2, state, country, postalCode, territory)
    VALUES (:officeCodeNew, :cityNew, :phoneNew, :addressLine1New, 
    :addressLine2New, :stateNew, :countryNew, :postalCodeNew, :territoryNew)";

    $stmt = $conn->prepare($sql);
    $data = [
        'officeCodeNew' => $officeCodeNew,
        'cityNew' => $cityNew,
        'phoneNew' => $phoneNew,
        'addressLine1New' => $addressLine1New,
        'addressLine2New' => $addressLine2New,
        'stateNew' => $stateNew,
        'countryNew' => $countryNew,
        'postalCodeNew' => $postalCodeNew,
        'territoryNew' => $territoryNew
    ];

    $query_execute = $stmt->execute($data);
    $sql = "SELECT id FROM offices WHERE officeCode = $officeCodeNew";
    $stmt = $conn->query($sql);
    $id = $stmt->fetch()['id'];

    if ($query_execute) {
        $_SESSION['message'] = "Updated Successfully";
        header('Location: ../index.php?id=' . $id);
        exit(0);
    } else {
        $_SESSION['message'] = "Not Updated";
        header('Location: index.php');
        exit(0);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

</html>