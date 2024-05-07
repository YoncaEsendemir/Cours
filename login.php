<?php
require "libs/ayar.php";

require "libs/variables.php";
require "libs/function.php";

session_start();

if($_SESSION["loginIn"]=true && isset($_SESSION["loginIn"])){
  header("Location:index.php");
 }

$username=$password="";
$usernameErr=$passwordErr=$loginErr=""; 

if(isset($_POST["btnLogin"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
     


  if(empty($_POST["username"])){
    $usernameErr="kullanici adi  girmenız gereklidir";
   }
   else{
    $username=safe_html($_POST["username"]);
   }


  if(empty($_POST["password"])){
    $passwordErr="Şifre girmenız gereklidir";
   }
   else{
    $password=safe_html($_POST["password"]);
   }
    /*
    if($userName==$db_user["username"] && $password==$db_user["password"]){
      setcookie("auth[username]",$db_user["username"],time()+(60*60));
      setcookie("auth[name]",$db_user["name"],time()+(60*60));
      $_SESSION["message"]=$userName." ile hesaba giriş yapıldı";
      header("Location:index.php");   // index sayfasina geri göderiyoruz!! 
    }
    else{
      echo "<div class='aler alert-danger mb-0 text-center'> Yanliş Parola veya username </div>";
    }
  */



    if(empty($usernameErr) && empty($password)){
        $sql="SELECT id, username, password from kullanicilar Where username=? ";  
         if($stmt=mysqli_prepare($con,$sql)){
             mysqli_stmt_bind_param($stmt,'s',$username);
            
             if( mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                      // paralo kontrolu
                       mysqli_stmt_bind_result($stmt,$id,$username,$hashed_passwort);

                       if(mysqli_stmt_fetch($stmt))
                       {
                            if(password_verify($password,$hashed_passwort)){
                              $_SESSION["loginIn"]=true;
                              $_SESSION["id"]=$id;
                              $_SESSION["useername"]=$username;
                                header('Location: index.php');
                            }
                            else{
                             $loginErr="pssword hata var";   
                                 
                            }
                       }
                    }
                    else{
                   $loginErr="username hata var";   
                      
                    }
             }
             else{
              $loginErr="bir hata oluştu";   
             }
         }   
    }
}
?>

<?php
if(!empty($loginErr)){
   echo "<div class='alert alert-daner'>".$loginErr."</div>";
}
?>

<?php require "viewes/_header.php"?>

<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  <div class="row">
    <div class="col-12">

    <form action="login.php" method="Post">

    <div class="mb-3 bg-primary">
        <label for="username">Kullanıcı Adı</label>
        <input type="text" placeholder="username" name="username" value="<?php echo $username;?>" class="form-control"> <!-- form-control text box divin genişliği kadar yer kaplar ve border-radius kullanılmiş  -->
        <div class="text-danger"><?php echo $usernameErr;?></div>
      </div>
  
      <div class="mb-3 bg-success">  <!-- mb margin button -->
        <label for="password">Password</label>
        <input type="password" placeholder="password" value="<?php echo $password;?>" class="form-control" name="password">
        <div class="text-danger"><?php echo $passwordErr;?></div>
      </div>


      <button type="submit" name="btnLogin" class="btn btn-primary">Kayıt Ol</button>

      </form>
  
    </div>

  </div>

</div>

<?php require "viewes/_footer.php"?>
