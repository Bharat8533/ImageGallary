<?php

    session_start();

    if(isset($_SESSION["is_user"])){
        header("Location: ../gallary");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image-Gallery Sign Up - B-Production</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <div class="form-container">
            <div class="container mt-5">
                <div class="form-page">
                    <h4 class="text-uppercase fs-6 text-white">Connect With Us</h4>
                    <h2 class="text-white fw-bold">Create a new account<span class="text-primary fs-1">.</span></h2>
                    <p class="para">Already a member? <a href="../login/index.php" class="text-decoration-none">Login</a></p>
                    <div class="form-page-content"> 
                    <form autocomplete="off" id="form" action="../api/sign-up.php" method="post">
                            <div class="name">
                                <span>
                                    <input type="text" placeholder="First Name *" name="firstname" required autocomplete="off" />
                                    <i class="fas fa-user"></i>
                                </span>
                                <span>
                                    <input type="text" placeholder="Last Name *" name="lastname" autocomplete="off" />
                                    <i class="fas fa-user"></i>
                                </span>
                                
                            </div>
                            <div class="email">
                                <input type="email" placeholder="Email Address *" name="email" required autocomplete="off"/>
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                             
                            <div class="email">
                                <input type="password" name="password" placeholder="Password *" required autocomplete="off"/>
                                <i class="fa-solid fa-lock"></i>
                            </div>
                              
                            <div>
                                <input name="sign_up" type="submit" class="btn btn-primary" placeholder="Create Account">
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"></script>
</body>
</html>
