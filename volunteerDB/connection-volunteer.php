<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "rammohant";
$password = "V00854777";
$database = "project_rammohant";

$link = mysqli_connect($servername, $username, $password, $database);

try {
    // Establish a connection with the MySQL server
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Start or resume session variables
session_start();

// If the user_ID session is not set, then the user has not logged in yet
if (!isset($_SESSION['userID']))
{
    // If the page is receiving the email and password from the login form then verify the login data
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $stmt = $conn->prepare("SELECT userID, password FROM users WHERE email=:email and type like 'volunteer'");
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        
        $queryResult = $stmt->fetch();
        
        // Verify password submitted by the user with the hash stored in the database
        if(!empty($queryResult) && password_verify($_POST["password"], $queryResult['password']))
        {
            // Create session variable
            $_SESSION['userID'] = $queryResult['userID'];
            $username = $_SESSION['userID'];
            
            // Redirect to URL 
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        } else {
            // Password mismatch
            echo "No volunteer account found. Try again.";
            require('volunteer-login.php');
            exit();
        }
    }
    else
    {
        // Show login page
        require('volunteer-login.php');
        exit();
    }
}

?>