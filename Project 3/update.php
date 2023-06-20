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
    $id = $_GET['id'];
} else {
    $id = 0;
}

$table = $_GET['table'];
            
try {
if($table == "employees"){

    $employeeNumberNew = $_POST['employeeNumber'];
    $firstNameNew = $_POST['firstName'];
    $lastNameNew = $_POST['lastName'];
    $extensionNew = $_POST['extension'];
    $emailNew = $_POST['email'];
    $officecodeNew = $_POST['officecode'];
    $reportsToNew = $_POST['reportsTo'];
    $jobtitleNew = $_POST['jobtitle'];
    
    $query = "UPDATE employees SET employeeNumber = :employeeNumberNew, firstName = :firstNameNew, 
                            lastName = :lastNameNew, extension = :extensionNew, email = :emailNew, 
                            officecode = :officecodeNew, reportsTo = :reportsToNew, jobtitle = :jobtitleNew WHERE id = $id";
            
            $statement = $conn->prepare($query);
            
            $data = [
                ':employeeNumberNew' => $employeeNumberNew,
                ':firstNameNew' => $firstNameNew,
                ':lastNameNew' => $lastNameNew,
                ':extensionNew' => $extensionNew,
                ':emailNew' => $emailNew,
                ':officecodeNew' => $officecodeNew,
                ':reportsToNew' => $reportsToNew,
                ':jobtitleNew' => $jobtitleNew,
            ];
        } else if ($table == "offices"){
            $officeCodeNew = $_POST['officeCode'];
            $cityNew = $_POST['city'];
            $phoneNew = $_POST['phone'];
            $addressLine1New = $_POST['addressLine1'];
            $addressLine2New = $_POST['addressLine2'];
            $stateNew = $_POST['state'];
            $countryNew = $_POST['country'];
            $postalCodeNew = $_POST['postalCode'];
            $territoryNew = $_POST['territory'];
            
            $query = "UPDATE offices SET officeCode = :officeCodeNew, city = :cityNew, 
                            phone = :phoneNew, addressLine1 = :addressLine1New, addressLine2 = :addressLine2New, 
                            state = :stateNew, country = :countryNew, postalCode = :postalCodeNew, territory = :territoryNew WHERE id = $id";
            
            $statement = $conn->prepare($query);
            
            $data = [
                ':officeCodeNew' => $officeCodeNew,
                ':cityNew' => $cityNew,
                ':phoneNew' => $phoneNew,
                ':addressLine1New' => $addressLine1New,
                ':addressLine2New' => $addressLine2New,
                ':stateNew' => $stateNew,
                ':countryNew' => $countryNew,
                ':postalCodeNew' => $postalCodeNew,
                ':territoryNew' => $territoryNew,
            ];
        } else {
            echo "Error: Table not found";
        }
            
            $query_execute = $statement->execute($data);
            
                if ($query_execute) {
                    $_SESSION['message'] = "Updated Successfully";
                    header('Location: index.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Not Updated";
                    header('Location: index.php');
                    exit(0);
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
