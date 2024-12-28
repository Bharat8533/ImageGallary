<?php

require_once "../config.php";
session_start();
session_destroy();
if (isset($_GET['token'])) {
    $resetToken = $_GET['token'];

    $con = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $currentDateTime = date("Y-m-d H:i:s");
    $sql = "SELECT user_id FROM forget_password_tokens WHERE token = '$resetToken' AND expiry_time > '$currentDateTime'";
    $result = $con->query($sql);

    if ($result->num_rows === 1) {

        $userId = $result->fetch_assoc()["user_id"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newPassword = $_POST["new_password"];

            $sql = "UPDATE sign_up_page SET password = '$newPassword' WHERE user_id = $userId";

            if ($con->query($sql) === TRUE) {

                $sql = "DELETE FROM password_reset_tokens WHERE token = '$resetToken'";
                $con->query($sql);

                header("Location: ../login");
                exit;
            } else {
                echo "Error updating password: " . $con->error;
            }
        }
    } else {
        echo "Invalid or expired token.";
    }

    $con->close();
} else {
    echo "Token not provided in the URL.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="reset_password_Style.css">
    <style>
       
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <h1>Password Reset</h1>
            <form method="POST">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button id="btn" type="submit">Reset Password</button>
            </form>
        </div>
    </div>

</body>

</html>