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