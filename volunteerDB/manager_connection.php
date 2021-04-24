<?php
// If the user_ID session is not set, then the user has not logged in yet
if (!isset($_SESSION['userID']))
{
    // If the page is receiving the email and password from the login form then verify the login data
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $stmt = $conn->prepare("SELECT userID, password FROM users WHERE email=:email and type IN ('organizer','admin')");
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        
        $queryResult = $stmt->fetch();
        
        // Verify password submitted by the user with the hash stored in the database
        if(!empty($queryResult) && password_verify($_POST["password"], $queryResult['password']))
        {
            // Create session variable
            $_SESSION['userID'] = $queryResult['userID'];
            
            // Redirect to URL
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        } else {
            // Password mismatch
            require('login.php');
            echo("Please login to your admin/organizer account to access this page.");
            exit();
        }
    }
    else
    {
        // Show login page
        require('login.php');
        echo("Please login to your manager account to access this page.");
        exit();
    }
}
?>