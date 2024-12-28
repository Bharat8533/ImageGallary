<?php

    session_start();

    if(isset($_SESSION["is_user"])){
        header("Location: ./gallary");
    }else{
        header("Location: ./login");
    }


?>