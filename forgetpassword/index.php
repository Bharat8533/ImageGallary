<?php
// Include necessary files and initialize your database connection
// You should have a database connection established here.
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];

    $con = mysqli_connect(HOST_NAME , USER_NAME , PASSWORD , DB_NAME);

    $query = "SELECT * FROM sign_up_page WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Database query failed.");
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Email not found in our records.");
    }

    
    $resetToken = bin2hex(random_bytes(4)); 
  
    $userId = $row["user_id"]; 
    
    $expiryTime = date("Y-m-d H:i:s", strtotime("+5 min")); 
    
    // echo $expiryTime;
    // die();
    $query = "INSERT INTO forget_password_tokens (user_id, token, expiry_time) VALUES ('$userId', '$resetToken', '$expiryTime')";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Database query failed.");
    }

    $resetLink = "forgetpassword/reset-password.php?token=$resetToken";
    // echo $resetLink;
    header("Location: ../$resetLink");
   
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImageGallary-forget password ! B-Production</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    
    <div class="wrapper">
        <div class="container">
            <h1>Password reset</h1>
            <h2>Website login</h2>
            <form action="" method="post">
                <div class="formInput">
                    <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Your Email">
                </div>
                
                <button id="btn" type="submit">Send link</button>
                <a href="../login/index.php" target="_blank" id="backToSignIn">Back to sign in</a>
            </form>
        </div>
    </div>
</body>
</html>