<?php
require "libs/variables.php";
require "libs/function.php";

session_start();
if(isset($_GET["id"])){
   $id=$_GET["id"];
   DeleteCategories($id);
   $_SESSION["message"]=$id." numaralı kategori Silindi!";
   $_SESSION["type"]="danger";
   header('Location:admin-categories.php');
}
else{
    echo "veri silinemedi!";
}

?>