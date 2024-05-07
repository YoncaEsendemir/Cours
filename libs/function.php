<?php


function CategoriesGet(){
   include "ayar.php";
   $query="SELECT *From kategoriler ";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function CategoriesGetId(int $coursId){
   include "ayar.php";
   $query="SELECT *FROM `kurs_kategori` kc inner join `kategoriler` c on kc.kategori_id=c.id WHERE kc.kurs_id=$coursId";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function GetCourses( bool $anasayfa,bool $onay){
   include "ayar.php";
   $query="SELECT  *from kurslar ";
    if($anasayfa){
    $query .="WHERE anasayfa=1 ";
    }

    if($onay){
      if(str_contains($query,"WHERE")){
          $query .="and onay=1";
      }
      else{
         $query .="WHERE onay=1";

      }
    }
    $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}


function GetCategoriesById(int $id){
   include "ayar.php";
   $query="SELECT *FROM kategoriler WHERE id=$id";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function GetCoursesByFilter($categoriId,$keyword,$page){
   
   include "ayar.php";
    
    $pageCount=2;
    $offset=($page-1)*$pageCount;
    $query="";
    if(!empty($categoriId)){
      $query="from kurs_kategori kc INNER JOIN kurslar k on kc.kurs_id=k.id WHERE kc.kategori_id=$categoriId and onay=1";
    }
    else{
      $query="from kurslar WHERE onay=1";
    }

    if(!empty($keyword)){
      $query .=" and baslik  LIKE '%$keyword%' or altBaslik  LIKE '%$keyword%' ";
    }
   
      $total_sql="SELECT COUNT(*) ".$query;
      $count_data=mysqli_query($con,$total_sql);
      $count=mysqli_fetch_array($count_data)[0];
      $total_pages=ceil($count/$pageCount);
      $sql="SELECT * ".$query." LIMIT $offset,$pageCount";
      $sonuc=mysqli_query($con,$sql);
      mysqli_close($con);
   return  array(
      "total_pages"=>$total_pages,
      "data"=>$sonuc
   );

}


function GetCoursesById(int $id)
{
   include "ayar.php";
   $query="SELECT *FROM kurslar WHERE id=$id";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function GetCoursesByKeyword($q){
   include "ayar.php";
   $query="SELECT *FROM kurslar WHERE baslik  LIKE '%$q%' or altBaslik  LIKE '%$q%' ";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function GetCoursesByCategorisById(int $id)
{
   include "ayar.php";
   $query="SELECT *FROM  kurs_kategori kc  INNER JOIN kurslar k  on kc.kurs_id=k.id  WHERE kc.kategori_id=$id";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function EditCourses(int $id,string $baslik,string $altBaslik,string $aciklama,string $resim ,int $onay, int $anasayfa)
{
   include "ayar.php";
   $query="UPDATE kurslar SET baslik='$baslik', altBaslik='$altBaslik',aciklama='$aciklama',resim='$resim',onay='$onay',anasayfa='$anasayfa' WHERE id=$id";
   $sonuc=mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc;
}

function EditCategories(int $id, string $category){
   include "ayar.php";
   $query="UPDATE kategoriler SET kategori_ad='$category' WHERE id=$id";
   $sonuc= mysqli_query($con,$query);
   mysqli_close($con);
   return $sonuc; 
}


function FileUploade(array $file){
if(isset($file)){
$dest_path="./img/";
$fileName=$file["name"];
$fileSourcePath=$file["tmp_name"];
$fileDestPath=$dest_path.$fileName;
move_uploaded_file($fileSourcePath,$fileDestPath);
echo "resim yüklendi";

}
}

function CategoriesCreat(string $kategori) {  
   include "ayar.php";
   $query ="INSERT INTO kategoriler (kategori_ad) VALUE (?)";
   $stmt=mysqli_prepare($con,$query);
   mysqli_stmt_bind_param($stmt,'s',$kategori);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);
   mysqli_close($con);
}

function CourseCreat( string $baslik, string $altBaslik,string $aciklama, string $resim,int $yorumSayisi=0,int $begeniSayi=0,int $onay=0) {  
   include "ayar.php";
   $query ="INSERT INTO kurslar (baslik,altBaslik,aciklama,resim,yorumSayisi,begeniSayi,onay) VALUES (?,?,?,?,?,?,?)";
   $stmt=mysqli_prepare($con,$query);
   mysqli_stmt_bind_param($stmt,'ssssiii',$baslik,$altBaslik,$aciklama,$resim,$yorumSayisi,$begeniSayi,$onay);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);
   mysqli_close($con);
   return $stmt;
}

function AddCourseCategories($id,$kategori){
 include "ayar.php";
 $query="";
 foreach ($kategori as $catid){
  $query.="INSERT INTO kurs_kategori(kurs_id,kategori_id) VALUES ($id,$catid);";
 } 
 $sonuc=mysqli_multi_query($con,$query);
 mysqli_close($con);
 //return  $sonuc;
}

function DeleteCategories(int $id)
{
  include "ayar.php";
  $query="DELETE FROM kategoriler WHERE id=$id"; 
 mysqli_query($con,$query);
 mysqli_close($con);
}


function  ClearCourseCategori(int $id){
  include "ayar.php";
  $query="DELETE FROM kurs_kategori WHERE kurs_id=$id"; 
  mysqli_query($con,$query);
  mysqli_close($con);

}

function DeleteCourses(int $id)
{
  include "ayar.php";
  $query="DELETE FROM kurslar WHERE id=$id"; 
 mysqli_query($con,$query);
 mysqli_close($con);
}

function getDb() {
   $myfile = fopen("db.json","r");
   $size = filesize("db.json");
   $data = json_decode(fread($myfile, $size),true);
   return $data;
}

function kategoriElke( &$kategori, string $kate,bool $active ){
    $yeni_kate[(count($kategori)+1)]=array(
       "kate"=>$kate,
       "activ"=>$active
    );
    $kategori= array_merge($kategori,$yeni_kate);
    }

    
function EkleKurs(string $kurs,string $altBaslik,$resim,string $yayinTarihi,int $yorumSayisi=0,int $begeniSayi=0,bool $onay=true)
{
   $db=getDb();
   array_push($db["Kurslar"],array(
    "kurs"=>$kurs,
    "altBaslik"=>$altBaslik,
    "resim"=>$resim,
    "yayinTarihi"=>$yayinTarihi,
    "yorumSayisi"=>$yorumSayisi,
    "begeniSayi"=>$begeniSayi,
    "onay"=>$onay,
   ));

   $myfile=fopen("db.json","w");
   fwrite($myfile,json_encode($db, JSON_PRETTY_PRINT));
   fclose($myfile);
}


function safe_html($data)
{
   $data=htmlspecialchars($data);
   $data=htmlentities($data);
   $data=stripslashes($data);
   $data=trim($data);
   return($data);
}


function linkDuzenle (string $baslik){
    return str_replace([" ",".",","],["-","-","-"],strtolower($baslik));
   }
   
   
   function altBaslikUznluk(string $altaslik){
   
     if(strlen($altaslik)>50){
       return substr($altaslik,0,50)."...";
     }
     else{
      return $altaslik;
     }
       
   }

?>