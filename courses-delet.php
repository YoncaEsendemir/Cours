
<?php
require "libs/variables.php";
require "libs/function.php";

session_start();
if(empty($_GET["id"]))
{
    header('Location:admin-courses.php');
}
$id=$_GET["id"];
$result=GetCoursesById($id);
$cours=mysqli_fetch_assoc($result);


if($_SERVER["REQUEST_METHOD"]=="POST")
{
   DeleteCourses($id);
   $_SESSION["message"]=$id." numaralı kurs Silindi!";
   $_SESSION["type"]="danger";
   header('Location:admin-courses.php');
}

?>

<?php require "viewes/_header.php"?>

<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  <div class="row">
    <div class="col-12">

    <form action="" method="Post">

      <div class="mb-3">
        <b> <?php echo  $cours["baslik"] ?> </b> Silmek istediğinize emin mısınız
        <button type="submit" name="btnDelete" class="btn btn-primary">Sil</button>

      </div>

      </form>
  
    </div>

  </div>

</div>

<?php require "viewes/_footer.php"?>