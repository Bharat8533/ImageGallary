<?php

    require_once "../config.php";

    if(isset($_POST["sign_up"])){

        [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => $password
        ] = $_POST;

        // salt method is  used to make more secure your password;
        $salt = "12345";
        
        // new array for  storing new hash value password;
        $new_hash_password = "";
        for ($i=0; $i < strlen($password) ; $i++) { 
            $new_hash_password .= $password[$i] . $salt;
        }
        // inside the  hash algorithm first value is hash algorithm name , second value is your password , and last value is your key;
        $password = HASH_HMAC("sha256", $new_hash_password , "bharat");

        $con = mysqli_connect(HOST_NAME , USER_NAME , PASSWORD , DB_NAME);

        $sql = "INSERT INTO sign_up_page (`firstname`, `last name`, `email`, `password`, date) VALUES ('$firstname', '$lastname', '$email', '$password', current_timestamp());";

        if($con->query($sql) == true){
            header("Location: ../login");
        }else{
            echo "ERROR : $sql <br> $con->error";
        }
        
        $con->close();

    }

?>