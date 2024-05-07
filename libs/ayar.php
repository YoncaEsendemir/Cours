<?php

$hostName="localhost";
$userName="root";
$password="";
$datadb="coursedb";

$con=mysqli_connect($hostName,$userName,$password,$datadb);

if(mysqli_errno($con)>0){
    die("hata:".mysqli_connect_errno());
}

?>