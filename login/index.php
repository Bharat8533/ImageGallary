<?php

    session_start();

    if(isset($_SESSION["is_user"])){
        header("Location: ../gallary");
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image-Gallary Sign UP ! B-Production</title>
    <!-- style -->
    <link rel="stylesheet" href="style.css" class="rel" />
    <!-- tailwind -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  </head>
  <body>
    <div class="wrapper">
      <div class="form-container">
        <div class="login-form container mt-5">
          <form autocomplete="off" class="form" action="../api/log-in.php" method="post">
            <p class="para">Enjoy Here</p>
            <h3>Login</h3>
            <h6>
              If you are new user? <a href="../signUp/index.php">Sign Up</a>
            </h6>
            
            <div class="mb-3 email">
              <div>
                <i class="fas fa-user"></i>
              </div>

              <input
                type="text"
                class="form-control"
                name="username"
                id=""
                placeholder="Enter Your Name"
              />
            </div>
            <div class="mb-3 email">
              <div>
                <i class="fas fa-lock"></i>
              </div>

              <input
                type="password"
                class="form-control"
                name="password"
                id=""
                placeholder="password"
              />
            </div>
            <div class="remember-forgot">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id=""
                />
                <label class="form-check-label" for=""> Remember me </label>
              </div>
              <div class="">
                <a href="../forgetPassword">Forgot Password?</a>
              </div>
            </div>
            <div>
                <input type="submit" name="log_in" value="Login" class="button btn btn-primary fs-5">
           </div>
            <!-- <button type="submit">submit</button> -->
          </form>
        </div>
      </div>
    </div>
    <!-- script -->
    <script src="index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"></script>
  </body>
</html>



<?php
require_once "../config.php";

if(isset($_POST["log_in"])){
    [
        "username" => $username,
        "password" => $password
    ] = $_POST;
    // to make more secure password
    $salt = "12345";

    $generated_password = "";
    for ($i=0; $i < strlen($password) ; $i++) { 
        $generated_password .= $password[$i] . $salt;
    }
    // here i  making the hash value of the password which contains three parameter 
    // ("algorithm of encrypt,value,key")
    $password = HASH_HMAC("sha256", $generated_password , "bharat");

    $con = mysqli_connect(HOST_NAME , USER_NAME , PASSWORD , DB_NAME);
    if(!$con){
        die("conmection to the database failed due to " . mysqli_connect_errno());
    }
   
    $sql = "INSERT INTO login_page (`username`,`password`, date) VALUES ('$username', '$password', current_timestamp());";
    $data = mysqli_query($con , $sql); 
    $query = "SELECT firstname, password FROM `sign_up_page` WHERE firstname = '$username' AND password = '$password'";
    
    $result = mysqli_query($con, $query);
    if($con->query($query) == true){
        header("Location: ../gallary");
    }else{
        echo "ERROR : $sql <br> $con->error";
    }
    
    if ($result) {
         $row = mysqli_fetch_assoc($result);
        if ($row && $row["firstname"] == $username && $row["password"] == $password) { 
            session_start();
            $_SESSION["is_user"] = true;

            header("Location: ../gallary");
        } else {
        }
    } else {
         echo "Query failed: " . mysqli_error($con);
    }
            
    
    $con->close();
}
?>