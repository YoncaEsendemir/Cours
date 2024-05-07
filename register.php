<?php
require "libs/ayar.php";
require "libs/variables.php";
require "libs/function.php";


// $kategori=array("Programlama","Web Geliştirme","Veri Analizi","Ofice Uygulamalari");

// kategoriElke($kategori,"Tasarim Dünyasi",true);

// EkleKurs($kurslar,"yeni kurs","yeni kurs altbaşlik 1","img/img1.png","20.05.2021",20,1,true);
//       $kurslar["4"]=$yeniKurs;
// echo $kurslar["4"]["kurs"];

// username ve diğerlerini global olarak tanımla ki hatta mesajlar çikmasın post methodda 
$username=$email=$password=$repassword=$city="";
$hobbies =[];
$usernameErr=$emailErr=$passwordErr=$repasswordErr=$cityErr=$hobbiesErr="";

// 'REQUEST_METHOD'== sayfaya erişim için hangi istek yöntemının kulanildiğini bakar

if($_SERVER["REQUEST_METHOD"]=="POST"){
if(empty($_POST["username"])){
  $usernameErr="kullanıcı adi girmeniz gereklidir";
}
else if( strlen($_POST["username"])<5 or strlen($_POST["username"])>20)
{
  $usernameErr="kullanıcı adi 5'ten fazla 20'den az karakter giriniz"; 
}
else if(!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/',$_POST["username"])){
  $usernameErr="username sadece harf, rakam  alt cizgiden oluşabilir "; 
}
else{
 $sql="SELECT id from kullanicilar Where username=?";
  if($stmt=mysqli_prepare($con,$sql)){
      $param_username=trim($_POST["username"]);
      mysqli_stmt_bind_param($stmt,"s",$param_username);
      if(mysqli_stmt_execute($stmt))
      {
        mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt)>=1){
           $usernameErr="kullanıcı adi alinmiştir";  
      }
      else{
        $username=safe_html($_POST["username"]);
      }
    }
    else{
      echo mysqli_errno($con);
      echo "Hata oluştu";
}
  }

 
}

if(empty($_POST["email"])){
  $emailErr="email girmeniz gereklidir";
 }
 elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
  $emailErr="email doğru şekilde girilmedi";
 }

 else{

  $sql="SELECT id from kullanicilar Where email=?";
  if($stmt=mysqli_prepare($con,$sql)){
      $param_email=trim($_POST["email"]);
      mysqli_stmt_bind_param($stmt,"s",$param_email);
      if(mysqli_stmt_execute($stmt))
      {
        mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt)>=1){
           $emailErr="kullanıcı adi alinmiştir";  
      }
      else{
        $email=safe_html($_POST["email"]);
      }
    }
    else{
      echo mysqli_errno($con);
      echo "Hata oluştu";
}
  
 }

 if(empty($_POST["password"])){
  $passwordErr="Şifre girmenız gereklidir";
 }
 else{
  $password=safe_html($_POST["password"]);
 }

 if($_POST["repassword"]!=$_POST["password"]){
  $repasswordErr= "şifreler birbirine uymuyor!";
 }
 else{
  $repassword=safe_html($_POST["repassword"]);
 }

 if($_POST["city"]==-1){
  $cityErr= "Lütfen şehir seçınız";
 }
 else{
  $city=$_POST["city"];
 }

 if(!isset($_POST["hobbies"])){
  $hobbiesErr="Lütfen bir hobi seç";
 }
 else{
  $hobbies=$_POST["hobbies"];
 }


 
 if(empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($repasswordErr)){
        include "libs/ayar.php";
        $sql="INSERT INTO kullanicilar(username,email,password,sehir,hobiler) VALUE(?,?,?,?,?)";
        if($stmt=mysqli_prepare($con,$sql))
        {
          $param_username=$username;
          $param_email=$email;
          $param_password=password_hash($password,PASSWORD_DEFAULT);
          $param_city=$city;
          $param_hobiler=$hobbies;
            
       mysqli_stmt_bind_param($stmt,"sssss",$param_username,$param_email,$param_password,$param_city,$param_hobiler);

       if(mysqli_stmt_execute($stmt)){
              header("Location:login.php");
              mysqli_close($con);
       }else{
           echo "<br>";
           echo "hata var!!";
          mysqli_error($con);
       }
  
      }
 }


 }
}


?>

     
<?php require "viewes/_header.php"?>

<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  <div class="row">
    <div class="col-12">
<form action="register.php" method="Post" novalidate>

      <div class="mb-3 bg-primary">
        <label for="username">Kullanıcı Adı</label>
        <input type="text" placeholder="username" name="username" value="<?php echo $username;?>" class="form-control"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
        <div class="text-danger"><?php echo $usernameErr;?></div>
      </div>

      <div class="mb-3 bg-secondary">
        <label for="email">Email</label>
        <input type="email" placeholder="email" name="email" value="<?php echo $email;?>" class="form-control">
        <div class="text-danger"><?php echo $emailErr;?></div>
      </div>
  
      <div class="mb-3 bg-success">  <!-- mb margin button -->
        <label for="password">Password</label>
        <input type="password" placeholder="password" value="<?php echo $password;?>" class="form-control" name="password">
        <div class="text-danger"><?php echo $passwordErr;?></div>
      </div>

      <div class="mb-3 bg-secondary">
        <label for="repassword">Password Tekrar</label>
        <input type="password" placeholder="repassword" name="repassword" class="form-control">
        <div class="text-danger"><?php echo $repasswordErr;?></div>
      </div>

      <div class="mb-3">
        <select name="city" class="form-control">
            <option value="-1" selected>Şehir Seçiniz</option>
            <?php foreach($citys as $plaka => $sehir):?>
            <option value="<?php echo $plaka;?>" 
            <?php if($plaka==$city):?>
              selected
              <?php endif?>> 
            <?php echo $sehir;?> </option>
           <?php endforeach?>
        </select>
        <div class="text-danger"><?php echo $cityErr;?></div>
      </div>

      <div class="mb-3">
      <label for="hobiler">Hobiler</label>

<?php foreach($hobiler as $id => $hobi): ?>

    <div class="form-check">
        <input type="checkbox" name="hobbies[]" 
        value="<?php echo $hobi;?>" 
        id="hobbies_<?php echo $id;?>"
        <?php if(in_array($hobi,$hobbies)) echo 'checked'?>
        >
        <label for="hobbies_<?php echo $id;?>" class="form-check-label"><?php echo $hobi;?></label>
    </div>

<?php endforeach; ?>
        </div>
        <div class="text-danger"><?php echo $hobbiesErr;?></div>
      </div>

      <button type="submit" class="btn btn-primary">Kayıt Ol</button>

      </form>
    </div>

  </div>

</div>

<?php require "viewes/_footer.php"?>
