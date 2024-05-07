<?php 
session_start();

if(isset( $_SESSION["message"])){
  echo "<div class='aler alert-".$_SESSION["type"]." mb-0 text-center'>". $_SESSION["message"]."</div>";
  unset( $_SESSION["message"]);
  unset($_SESSION["type"]);
}

 
?>