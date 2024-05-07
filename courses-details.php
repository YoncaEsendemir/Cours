<?php
require "libs/variables.php";
require "libs/function.php";


// $kategori=array("Programlama","Web Geliştirme","Veri Analizi","Ofice Uygulamalari");

// kategoriElke($kategori,"Tasarim Dünyasi",true);

// EkleKurs($kurslar,"yeni kurs","yeni kurs altbaşlik 1","img/img1.png","20.05.2021",20,1,true);
//       $kurslar["4"]=$yeniKurs;
// echo $kurslar["4"]["kurs"];

if(!isset($_GET["id"]) && !is_numeric($_GET["id"])){
  header('Location:index.php');
}

$sonuc=GetCoursesById($_GET["id"]);
$cours=mysqli_fetch_assoc($sonuc);

?>
     
<?php require "viewes/_header.php"?>
<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  
    <div class="card">
      <div class="row">
    <div class="col-4">
           <img src="img/<?php echo $cours["resim"]?>" alt="<?php echo $cours["baslik"]?>" class="img-fluid">
    </div>
    
    <div class="col-8">
      <div class="card-body">
      <h5 class="h5-title"><?php echo $cours["baslik"]?></h5>
          <p class="card-text"><?php echo $cours["altBaslik"]?></p>
          <p class="card-text"><?php echo $cours["aciklama"]?></p>


          </div>
    </div>
    </div>

  </div>

</div>

<?php require "viewes/_footer.php"?>
