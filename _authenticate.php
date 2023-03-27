<?php
session_start();

$name = $_POST['name'];
$password = $_POST['password'];

// i should delete the white_spaces in the input
$name = trim($name);
$password = trim($password);

// hash it using the 'sha256' algo  , comparing them to the hashed values i have in the file Data_Hashed.txt  ....
$Name_Hashed = hash("sha256", strtolower($name));
$password_Hashed = hash("sha256", strtolower($password));

$_SESSION['_authentification_check'] = false;

// link to the Data_Hashed.txt file : 
$data_file_name = '... path to file .... => \Projects Admin\Data_Hashed.txt';

$lines = file($data_file_name, FILE_IGNORE_NEW_LINES);

// Loop through the array and check if the username exists
foreach ($lines as $line) {
    // Split the line into an array using the "|" separator
    $line_split = explode('|', $line);
    // Check the ID :
    
    if ($line_split[0] === $Name_Hashed) {
        
        // Check the password:
        if ($line_split[1] === $password_Hashed) {
            // Correct inputs :)
            $_SESSION['authenticated'] = true;
            $_SESSION['_authentification_check'] = true;
            header('Location: index.php');
            exit;
        }
    }
}
header('location: login_signUp.php?error=1');


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Styles/_authenticate.css">
</head>

<body>
    
    <div class="spinner"></div>
</body>
</html>