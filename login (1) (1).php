
<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome.php");
                            
                        }
                    }

                }

    }
}    


}


?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PoliTalkHub-Login</title>
    <link rel="stylesheet" href="login.css">
   
 
<body>
    
    
    <div class="page-container">
        <div class="login-container">
            <div class="top-text">
                <h2>Welcome to <i class="fa-solid fa-scale-balanced"></i>PoliTalkHub!</h2>
                <h3 class="heroText">Login </h3>
                
            
                        
                        

                   
                    
             
                <div class="input-form">
                    <form>
                        <input type="text" placeholder="Username">
                        <input type="password" placeholder="Password">
                       <button><a href="welcome.php">Login</a></button>
                       
                        
                    </form>
                </div>
                <div class="bottom-text">
                    <p>Forgot your username or password ?</p>
                    <p class="last-text">if you are new to PoliTalkHub,<span ><a href="welcome.php">SIGN UP</a></span></p>
                </div>
            </div>
             </div>
    </div>

