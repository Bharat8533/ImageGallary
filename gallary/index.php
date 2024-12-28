<?php

    session_start();
    
    if(!isset($_SESSION["is_user"])){
        header("Location: ./index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Gallary ! B-Production</title>
    <!-- style.css -->
    <link rel="stylesheet" href="style.css" class="rel" />
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
    <div class="wrapper gradient">
      <form class="nav" action="../logout.php" method="post">
        <button class="" type="submit" name="log Out">Log Out</button>
      </form>
      <div class="search-container">
        
        <form autocomplete="off" class="search-input">
          <input type="text" id="input" placeholder="Enter Your Image Name" />
          <i class="fas fa-search" id="searchBtn"></i>
        </form>
      </div>
      <!-- storing images -->
      <div id="image-show" class="container"></div>
    </div>
    <!-- script -->
    <script src="index.js"></script>
  </body>
</html>
