<?php

session_start();

if (isset($_SESSION["is_user"])) {
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <div class="wrapper">
    <div class="form-container">
      <div class="login-form container mt-5">
        <form id="loginForm" autocomplete="off" class="form">
          <p class="para">Enjoy Here</p>
          <h3>Login</h3>
          <h6>If you are a new user? <a href="../signUp/index.php">Sign Up</a></h6>

          <div class="mb-3 email">
            <div><i class="fas fa-user"></i></div>
            <input type="number" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter Your Name" />
          </div>

          <div class="mb-3 email">
            <div><i class="fas fa-lock"></i></div>
            <input type="password" class="form-control" name="password" id="password" placeholder="password" />
          </div>

          <input type="text" name="for" value="PASSWORD" hidden>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
  <!-- script -->
  <script src="index.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"></script>

  <script>
  // Select the form and button elements
  const form = document.getElementById('loginForm');
  const submitButton = form.querySelector('button[type="submit"]');

  // Add an event listener to handle form submission
  form.addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent default form submission

    // Collect form data
    const formData = new FormData(form);

    // Append country code to mobile number
    const mobileNo = formData.get('mobile_no');
    const formattedMobileNo = '91' + mobileNo;  // Append country code to the mobile number
    formData.set('mobile_no', formattedMobileNo); // Set the formatted mobile number

    // Disable the submit button to prevent multiple submissions
    submitButton.disabled = true;

    try {
      // Perform the fetch request
      const response = await fetch('https://stayinbraj.com/channel_manager/is_valid_user', {
        method: 'POST',
        body: formData, // Send the FormData object
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const data = await response.json(); // Parse JSON response

      // Handle the response data here
      if (data.success) {
        alert("Login Successful!");
        window.location.href = "../gallary"; // Redirect to gallery page
      } else {
        alert("Login failed: " + data.message); // Show error message
      }
    } catch (error) {
      // Handle any errors that occur during fetch
      console.error("Error during fetch:", error);
      alert("An error occurred, please try again.");
    } finally {
      // Re-enable the submit button
      submitButton.disabled = false;
    }
  });
</script>

</body>

</html>



<?php
require_once "../config.php";

if (isset($_POST["log_in"])) {
  [
    "username" => $username,
    "password" => $password
  ] = $_POST;
  // to make more secure password
  $salt = "12345";

  $generated_password = "";
  for ($i = 0; $i < strlen($password); $i++) {
    $generated_password .= $password[$i] . $salt;
  }
  // here i  making the hash value of the password which contains three parameter 
  // ("algorithm of encrypt,value,key")
  $password = HASH_HMAC("sha256", $generated_password, "bharat");

  $con = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
  if (!$con) {
    die("conmection to the database failed due to " . mysqli_connect_errno());
  }

  $sql = "INSERT INTO login_page (`username`,`password`, date) VALUES ('$username', '$password', current_timestamp());";
  $data = mysqli_query($con, $sql);
  $query = "SELECT firstname, password FROM `sign_up_page` WHERE firstname = '$username' AND password = '$password'";

  $result = mysqli_query($con, $query);
  if ($con->query($query) == true) {
    header("Location: ../gallary");
  } else {
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