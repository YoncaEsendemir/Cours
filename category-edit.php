<?php
require "libs/variables.php";
require "libs/function.php";
?>

<?php require "viewes/_header.php"?>
<?php require "viewes/_navbar.php"?>

<?php


if(isset($_GET["id"])){
$id=$_GET["id"];
$categet=GetCategoriesById($id);
$selectCate=mysqli_fetch_assoc($categet);
}
else{
  echo "hata var ";
}


session_start();
$kategoriAd=$kategoriErr="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
if(empty($_POST["kategori"])){

  $kategoriErr="kategori girmeniz gereklidir";
}
else{
  $kategoriAd=safe_html($_POST["kategori"]);
}

if(empty($kategoriErr)){
  EditCategories($id,$kategoriAd);
    $_SESSION["message"]=$kategoriAd."isimli kategori güncellendi!";
    $_SESSION["type"]="success";
    header('Location:admin-categories.php');
}
else{
  echo "hata var ";
}
}
?>

<div class="countainer m-3">

  <div class="row">
    <div class="col-12">
<form  method="Post">

        <div class="card m-3">
        <div class="card-body">
        <label for="kategori">Kategori Adı</label>
       <input type="text" placeholder="kategoriAd" name="kategori" class="form-control" value="<?php echo $selectCate["kategori_ad"] ?>"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
         <div class="text-danger"><?php echo $kategoriErr;?></div>
        </div>
        </div>

      <button type="submit" class="btn btn-primary">Update</button>

      </form>
    </div>

  </div>

</div>

<?php require "viewes/_editor.php"?>
<?php require "viewes/_footer.php"?>
