<?php
require "libs/variables.php";
require "libs/function.php";
?>

<?php require "viewes/_header.php"?>
<?php require "viewes/_navbar.php"?>

<?php
session_start();
$kategoriAd=$kategoriErr="";

// $kategori=array("Programlama","Web Geliştirme","Veri Analizi","Ofice Uygulamalari");
// kategoriElke($kategori,"Tasarim Dünyasi",true);
// EkleKurs($kurslar,"yeni kurs","yeni kurs altbaşlik 1","img/img1.png","20.05.2021",20,1,true);
//       $kurslar["4"]=$yeniKurs;
// echo $kurslar["4"]["kurs"];
// username ve diğerlerini global olarak tanımla ki hatta mesajlar çikmasın post methodda 
// 'REQUEST_METHOD'== sayfaya erişim için hangi istek yöntemının kulanildiğini bakar

if($_SERVER["REQUEST_METHOD"]=="POST"){
if(empty($_POST["kategori"])){
  $kategoriErr="kullanıcı adi girmeniz gereklidir";
}
else{
  $kategoriAd=safe_html($_POST["kategori"]);
}

if(empty($kategoriErr)){
    CategoriesCreat($kategoriAd);
    $_SESSION["message"]=$kategoriAd."isimli kategori eklendi!";
    $_SESSION["type"]="success";
    header('Location:admin-categories.php');
}
}
?>
     



<div class="countainer m-3">

  <div class="row">
    <div class="col-12">
<form action="category-creat.php" method="Post">

        <div class="card m-3">
        <div class="card-body">
        <label for="kategori">Kategori Adı</label>
                <input type="text" placeholder="kategoriAd" name="kategori" class="form-control"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
                <div class="text-danger"><?php echo $kategoriErr;?></div>
        </div>
        </div>

      <button type="submit" class="btn btn-primary">Kaydet</button>

      </form>
    </div>

  </div>

</div>


<?php require "viewes/_footer.php"?>
