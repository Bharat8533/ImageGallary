<!--  -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Gallary</title>
    <!-- style.css -->
    <link rel="stylesheet" href="style.css"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />

    <style>
      #searchBtn{
        background-color:rgb(182, 234, 183);
        width: 50px;
        height: 50px;
        font-size: 2rem;
        border-radius: 50%;
        display : flex;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="wrapper gradient">
      <div class="search-container">
        <form autocomplete="off" class="search-input">
          <input type="text" id="input" placeholder="Enter Your Image Name" />
          <button type="button" id="searchBtn"><i class="fas fa-search"></i></button>
        </form>
      </div>
      <!-- storing images -->
      <div id="image-show" class="container"></div>
    </div>
    <!-- script -->
    <script src="index.js"></script>
  </body>
</html>
