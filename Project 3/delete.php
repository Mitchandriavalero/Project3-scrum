<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Delete</title>
</head>
<body>
    <h1>Are you sure you want to delete this entry</h1>
    <a href="index.php">No go back</a>
    <a href="action.php?<?php echo "table=" . $_GET['table'] . "&id=" . $_GET['id']?>">Yes, Delete</a>
</body>
</html>