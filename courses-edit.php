<?php
require "libs/variables.php";
require "libs/function.php";
?>

<?php require "viewes/_header.php"?>
<?php require "viewes/_navbar.php"?>

<?php

/*
mysqli_fetch_assoc fonksiyonu, sonuç kümesindeki her bir satır için bir associative array döndürür.
 Bu array, sütun isimleri ile ilişkilendirilmiş anahtar/değer çiftlerini içerir. 
Bu şekilde, her bir sütuna erişebilir ve verileri işleyebilirsiniz.
*/

if(isset($_GET["id"])){
$id=$_GET["id"];
$course=GetCoursesById($id);
$selectCourse=mysqli_fetch_assoc($course);
}

else{
  echo "hata var ";
}

session_start();

$baslik=$baslikErr="";
$altBaslik=$altBaslikErr="";
$resim=$resimErr="";
$onay=$onayErr="";
$aciklama=$aciklamaErr="";


if($_SERVER["REQUEST_METHOD"]=="POST"){
if(empty($_POST["baslik"])){

  $baslikErr="Baslik  girmeniz gereklidir";
}
else{
  $baslik=safe_html($_POST["baslik"]);
}

if(empty($_POST["altBaslik"]))
{
   $altBaslikErr="Kurs hakkında bilgi vermenis gerekiyor";
}
else{
  $altBaslik=safe_html($_POST["altBaslik"]);
}

if(empty($_POST["aciklama"])){
  $aciklamaErr="aciklama girmeniz gereklidir";
}
else{
  $aciklama=safe_html($_POST["aciklama"]);
}


if(empty($_FILES['imageFile'])){
  $resimErr="lütfen bir resim seciniz";
}
else{ 
  FileUploade($_FILES["imageFile"]);
  $resim=$_FILES["imageFile"]["name"];
}

$onay;
if($_POST["onay"]=="on"){
  $onay=1;
}
else{
  $onay=0;
}
$anasayfa;
if($_POST["anasayfa"]=="on"){
  $anasayfa=1;
}
else{
  $anasayfa=0;
}

$categories=[];
if(isset($_POST["categories"])){
$categories=$_POST["categories"];
}

if(empty($kategoriErr) && empty($altBaslikErr) && empty($resimErr))
{
  
   if(EditCourses($id,$baslik,$altBaslik,$aciklama,$resim,$onay,$anasayfa)){
     
    ClearCourseCategori($id);
    if(count($categories)>0)
    {
      AddCourseCategories($id,$categories); // categories id leri yani seçtiğimiz id'ler bir dizide sakliyoruz
    }
     $_SESSION["message"]=$cours."isimli kategori güncellendi!";
     $_SESSION["type"]="success";
     header('Location:admin-courses.php');
  }
}
else{
  echo "hata var ";
}
}
?>

<div class="countainer m-3">
<div class="card card-body">
<form  method="Post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-9">


        <div class="card m-3">
        <div class="card-body">
        <label for="kategori">Baslik</label>
       <input type="text" placeholder="baslik" name="baslik" class="form-control" value="<?php echo $selectCourse["baslik"] ?>"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
         <div class="text-danger"><?php echo $baslikErr;?></div>
        </div>
        </div>

        <div class="card m-3">
        <div class="card-body">
        <label for="altBaslik">Alt Başlik</label>
                <input type="text" placeholder="altBaslikAd" name="altBaslik" class="form-control" value="<?php echo $selectCourse["altBaslik"]?>" > <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
                <div class="text-danger"><?php echo $altBaslikErr;?></div>
        </div>
        </div>

        
        <div class="card m-3">
        <div class="card-body">
        <label for="aciklama">Açıklama</label>
                <textarea  name="aciklama" class="form-control">  <?php echo $selectCourse["aciklama"];?> </textarea> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
                <div class="text-danger"><?php echo $aciklamaErr;?></div>
        </div>
        </div>



        <div class="card md-3">
        <div class="input-group mb-3">

        <input type="file" name=imageFile class="form-control" id="imageFile">
        <label for="imageFile" class="form-control">Yükle</label>
        <div class="text-danger"><?php echo $resimErr;?></div>
        </div>
       
        </div>

      <button type="submit" class="btn btn-primary">Update</button>

      
    </div>
    <div class="col-3">
    <div class="card m-3">
         <img class="img-fluid" src="img/<?php echo $selectCourse["resim"]?>" alt="">
        </div>
      <hr>
    <?php foreach(CategoriesGet() as $c):?>
      <div class="form-check">
          <label for="category_<?php echo $c["id"]?>"><?php echo $c["kategori_ad"]?></label>
          <input class="form-check-input" type="checkbox" name="categories[]" value="<?php echo $c["id"]?>" id="category_<?php echo $c["id"]?>"
          <?php
             $isChecked=false;
             $selectCategory=CategoriesGetId($selectCourse["id"]);

             foreach($selectCategory as $selectCat)
              {
                  if($selectCat["id"]==$c["id"])
                  {
                    $isChecked=true;
                  }
              }
              if($isChecked)
              {
               echo "checked";
              }
          ?>
          >
    </div>
    <?php endforeach ;?>
    <hr>
      
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="onay" name="onay" 
        <?php
        if($selectCourse["onay"]){
          echo "checked";
        }
        else{
          echo "";
        }
        ?>>
       <label for="onay"  class="form-check-lable" >Onay</label>
        <br>
       <input type="checkbox" class="form-check-input" id="anasayfa" name="anasayfa" 
        <?php
        if($selectCourse["anasayfa"]){
          echo "checked";
        }
        else{
          echo "";
        }
        ?>>
       <label for="anasayfa"  class="form-check-lable" >Anasayfa</label>
        </div>
    </div>
  </div>
  </form>
  </div>
</div>

<?php include('viewes/_editor.php')?>
<?php require "viewes/_footer.php"?>
