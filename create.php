   <?php
require "libs/variables.php";
require "libs/function.php";


if(isset($_POST["btnCreate"])){
  $title=$_POST["title"];
  $subtitle=$_POST["subtitle"];
  $image=$_POST["image"];
  $dateAdded=$_POST["dateAdded"];
  header("Location: index.php");
  EkleKurs($title,$subtitle,$image,$dateAdded);
  }

?>

<?php require "viewes/_header.php"?>

<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  <div class="row">
    <div class="col-12">

    <form action="create.php" method="Post">

      <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" placeholder="title" name="title" class="form-control"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->

      </div>
  
      <div class="mb-3">  <!-- mb margin button -->
        <label for="subtitle">Subtitle:</label>
        <input type="text" placeholder="subtitle" class="form-control" name="subtitle">
      </div>

      <div class="mb-3"> 
        <label for="image">image:</label>
        <input type="text" placeholder="image" class="form-control" name="image">
      </div>

      <div class="mb-3"> 
        <label for="dateAdded">Date Added</label>
        <input type="text" placeholder="dateAdded" class="form-control" name="dateAdded">
      </div>

      <button type="submit" name="btnCreate" class="btn btn-primary">Ekle</button>

      </form>
  
    </div>

  </div>

</div>

<?php require "viewes/_footer.php"?>