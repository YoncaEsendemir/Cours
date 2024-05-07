<?php

require "libs/variables.php";
require "libs/function.php";
?>

<?php require "viewes/_header.php"?>
<?php require "viewes/_navbar.php"?>

<?php
session_start();
$baslik=$baslikErr="";
$altBaslik=$altBaslikErr="";
$resim=$resimErr="";
$aciklama=$aciklamaErr="";

// $kategori=array("Programlama","Web Geliştirme","Veri Analizi","Ofice Uygulamalari");
// kategoriElke($kategori,"Tasarim Dünyasi",true);
// EkleKurs($kurslar,"yeni kurs","yeni kurs altbaşlik 1","img/img1.png","20.05.2021",20,1,true);
//       $kurslar["4"]=$yeniKurs;
// echo $kurslar["4"]["kurs"];
// username ve diğerlerini global olarak tanımla ki hatta mesajlar çikmasın post methodda 
// 'REQUEST_METHOD'== sayfaya erişim için hangi istek yöntemının kulanildiğini bakar

if($_SERVER["REQUEST_METHOD"]=="POST")
{
 
if(empty($_POST["baslik"])){
  $baslikErr="baslik girmeniz gereklidir";
}
else{
  $baslik=safe_html($_POST["baslik"]);
  }

  if(empty($_POST["altBaslik"])){
    $altBaslikErr="Alt baslik girmeniz gereklidir";
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

    // if($_POST["category"]=="0"){
    //   $categoryErr="Bir kategori seciniz";
    // }
    // else{
    //   echo $_POST["category"];
    //  $category=$_POST["category"];
    // }
  

if(empty($baslikErr) or empty($altBaslikErr) or empty($resimErr) or empty($aciklamaErr)){
    CourseCreat($baslik,$altBaslik,$aciklama,$resim);
    $_SESSION["message"]=$baslik."isimli kategori eklendi!";
    $_SESSION["type"]="success";
    header('Location:admin-courses.php');
}
} 
?>
     
<div class="countainer m-3">
 
<form action="course-creat.php" method="Post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-12">


        <div class="card m-3">
        <div class="card-body">
        <label for="baslik">Başlik</label>
                <input type="text" placeholder="baslikAd" name="baslik" class="form-control" value="<?php echo $baslik?>"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
                <div class="text-danger"><?php echo $baslikErr;?></div>
        </div>
        </div>

        <div class="card m-3">
        <div class="card-body">
        <label for="altBaslik">Alt Başlik</label>
                <textarea placeholder="altBaslikAd" name="altBaslik" class="form-control"> </textarea> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
                <div class="text-danger"><?php echo $altBaslikErr;?></div>
        </div>
        </div>

        <div class="card m-3">
        <div class="card-body">
        <label for="aciklama">Açıklama</label>
                <textarea  name="aciklama" class="form-control"><?php echo $aciklama;?> </textarea> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
                <div class="text-danger"><?php echo $aciklamaErr;?></div>
        </div>
        </div>


        <div class="input-group mb-3">
        <label for="imageFile" class="form-control">Resim</label>
        <input type="file" name=imageFile class="form-control">

        <div class="text-danger"><?php echo $resimErr;?></div>
        </div>

      <button type="submit" class="btn btn-primary">Kaydet</button>
    </div>
     
  </div>
  </form>
</div>



<?php include "viewes/_editor.php"?>
<?php require "viewes/_footer.php"?>