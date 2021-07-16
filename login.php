<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: index.php");
 
// }
 
// Include config file
require_once("dbconnection.php");
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
}   
    
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

    <div class="wrapper" style="border:1px solid black; border-radius: 8px; box-shadow: 1px 2px 5px black;">
        <div class="logincard">
                <div class="logcard">
                    <h2>Login</h2>
                    <p>Please fill in your credentials to login.</p>
                </div>
        </div>
        <div class="formcard">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label><br>  
                    <input type="text" size="34" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span style="color:red;" class="help-block"><?php echo $username_err; ?></span>
                </div> <br>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label><br>  
                    <input type="password" size="34" name="password" class="form-control">
                    <span style="color:red;" class="help-block"><?php echo $password_err; ?></span>
                </div><br>
                <div class="form-group">
                    <input onclick="Myfunction()" style="background-color:green; color:white; width: 21.5em;" type="submit" class="btn btn-primary" value="Login"><br><br>
                    <img id="load" style="width: 50px; height: 50px; margin-left: 100px; border:none;">
                    <script>
                    function Myfunction (){
                        document.getElementById('load').src="rol.gif";
                    }
                    
                    </script>
                </div>
                <p>Don't have an account? <a href="users.php">Sign up now</a>.</p>
            </form>
        </div>
    </div>    
</body>
</html>