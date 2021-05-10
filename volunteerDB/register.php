<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = $first_name = $last_name = $confirm_password = $university = $languages = $skills = $vaccinated = "";
$email_err = $password_err = $firstname_err = $lastname_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate first_name
    if (empty(trim($_POST["first_name"]))) {
        $firstname_err = "Please enter your first name.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last_name
    if (empty(trim($_POST["last_name"]))) {
        $lastname_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    if (empty(trim($_POST["last_name"]))) {
        $lastname_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    $university = trim($_POST["university"]);
    // $languages = trim($_POST["languages"]);
    // $skills = trim($_POST["skills"]);
    // $vaccinated = trim($_POST["vaccinated"]);

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter a email.";
    } else {
        $email = trim($_POST["email"]);
        
//         // Prepare a select statement
//         $sql = "SELECT id FROM users WHERE email = ?";

//         if ($stmt = mysqli_prepare($link, $sql)) {
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "s", $param_email);

//             // Set parameters
//             $param_email = trim($_POST["email"]);

//             // Attempt to execute the prepared statement
//             if (mysqli_stmt_execute($stmt)) {
//                 /* store result */
//                 mysqli_stmt_store_result($stmt);

//                 if (mysqli_stmt_num_rows($stmt) == 1) {
//                     $email_err = "This email is already taken.";
//                 } else {
//                     $email = trim($_POST["email"]);
//                 }
//             } else {
//                 echo "Oops! Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($email_err) && empty($password_err) && empty($confirm_password_err && empty($firstname_err) && empty($lastname_err))) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password, first_name, last_name, type) VALUES (?, ?, ?, ?, ?)";
        $sql_university = "INSERT INTO university (university_name) VALUES (?)";
        $sql_volunteer = "INSERT INTO volunteers (userID, university_name) VALUES (?, ?)";

        try {
        if ($stmt = mysqli_prepare($link, $sql)) {
        // if ($stmt = mysqli_prepare($link, $sql) && $stmt_university = mysqli_prepare($link, $sql_university) && $stmt_volunteer = mysqli_prepare($link, $sql_volunteer)) {

            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $first_name;
            $param_lastname = $last_name;
            $param_university = 1;
            $param_type = 'volunteer';
            
            //Insert into volunteers table now 
            $result= mysqli_query($link,"SELECT MAX(userID) AS maximum FROM users");
            $row = mysqli_fetch_array($result); 
            $param_userID = $row['maximum'];

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,'sssss', $param_email, $param_password, $param_firstname, $param_lastname, $param_type);
            // mysqli_stmt_bind_param($stmt_university,'s', $param_university);
            // mysqli_stmt_bind_param($stmt_volunteer,'ss', $param_userID, $param_university);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
            // if (mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt_university) && mysqli_stmt_execute($stmt_volunteer)) {
                // Redirect to home page
                echo "You have successfully created a VDASH account!";
                header("location: index.php");
            } 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>VDASH: Sign Up</title>
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>

h3 {
    text-align: center;
    font-size: 25px; 
    padding-top: 25px; 
    font-family: "Verdana";
    font-weight: bold; 
}

p {
    text-align: center;
    font-size: 13px;
    font-family: "Verdana"; 
    
}
div {
    text-align: center;
}
body {
    background-image:url('bg.png'); 
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
/*   float: right; */
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  font-family: "Verdana"; 
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 20px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}
 
</style>
</head>
<body>

	<ul>
    	<li><a href="index.php" class="pull-left" style="height: auto"><img src="VDASH.png" style="height: 28px"></a><li>
    	<li><a href="user_v.php">Volunteer Portal</a></li>
    	<li><a href="manager_v.php">Manager Portal</a></li>
    	<li class="active"><a href="register.php">Register</a></li>
	</ul>

	<div class="wrapper">
		<h3>Sign Up</h3>
		<p>Create a VDASH volunteer account by completing this form:</p>
        <div class="container mt-3 mb-3">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
				method="post">
                <div class="row justify-content-center">
				<div class="col-4">
						<div class="form-group">
							<label>Email</label> <input type="text" name="email"
								class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
								value="<?php echo $email; ?>"> <span class="invalid-feedback"><?php echo $email_err; ?></span>
						</div>
						<div class="form-group">
							<label>First Name</label> <input type="text" name="first_name"
								class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>"
								value="<?php echo $first_name; ?>"> <span
								class="invalid-feedback"><?php echo $firstname_err; ?></span>
						</div>
						<div class="form-group">
							<label>Last Name</label> <input type="text" name="last_name"
								class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>"
								value="<?php echo $last_name; ?>"> <span
								class="invalid-feedback"><?php echo $lastname_err; ?></span>
						</div>
                        <div class="form-group">
							<label>University</label> <input type="text" name="university"
								class="form-control"
								value="<?php echo $university;?>"> 
						</div>
						<div class="form-group">
							<label>Password</label> <input type="password" name="password"
								class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
								value="<?php echo $password; ?>"> <span class="invalid-feedback"><?php echo $password_err; ?></span>
						</div>
						<div class="form-group">
							<label>Confirm Password</label> <input type="password"
								name="confirm_password"
								class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
								value="<?php echo $confirm_password; ?>"> <span
								class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Submit"> 
                            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
						</div>
						<p>
							Already have an account? <a href="login.php">Login here</a>.
						</p>
                    </div> 
                    </div>
			</form>
		</div>
        </div>
</body>
</html>