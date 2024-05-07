<?php
require "libs/variables.php";
require "libs/function.php";

?>
<?php 
// $kategori=array("Programlama","Web Geliştirme","Veri Analizi","Ofice Uygulamalari");

// kategoriElke($kategori,"Tasarim Dünyasi",true);

// EkleKurs($kurslar,"yeni kurs","yeni kurs altbaşlik 1","img/img1.png","20.05.2021",20,1,true);
//       $kurslar["4"]=$yeniKurs;
// echo $kurslar["4"]["kurs"];


//Yani, satırdaki sütunları isimleriyle eşleştiren bir dizi döndürür.
//foreach(getDb()["Kurslar"] as  $kate):
    $categoriId="";
    $page=1;
    $keyword="";

  if(isset($_GET["categoryid"]) and is_numeric($_GET["categoryid"])){
    $categoriId=$_GET["categoryid"];
  }
  
  if(isset($_GET["q"])){
    $keyword=$_GET["q"];
  }

  if(isset($_GET["page"]) and is_numeric($_GET["page"])){
        $page=$_GET["page"];
  }

  $res=GetCoursesByFilter($categoriId,$keyword,$page);

  /*
  if(isset($_GET["categoryid"]) and is_numeric($_GET["categoryid"]))
{
    $kategori_id=$_GET["categoryid"];
    $kurslar=GetCoursesByCategorisById($kategori_id);
}
else if (isset($_GET["q"])){
   $keyword =$_GET["q"];
    $kurslar=GetCoursesByKeyword($keyword);
}

else{
  $kurslar=GetCourses(false,true);
}*/
  ?>

     
<?php require "viewes/_header.php"?>
<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  <div class="row">
    <div class="col-4">

  <?php include "viewes/_menu.php"?>
  
    </div>

    <div class="col-8">
    <?php include "viewes/_title.php"?>
    <?php if(mysqli_num_rows($res["data"])>0):?>

    <?php while($kurs = mysqli_fetch_assoc($res["data"])):?>

    <?php if($kurs["onay"]):?>
      <div class="card mb-3">
    <div class="row">
              <div class="col-3">
                <img src="img/<?php echo $kurs["resim"];?>" class="img-fluid rounded-start" alt="bulamadim" id="foto">
              </div>

              <div class="col-9">
                <div class="card-body text-dark bg-light mb-3">
                  <a href="courses-details.php?id=<?php echo $kurs["id"]?>">
                  <h5 class="card-title" ><?php echo $kurs["baslik"]?></h5>
                  </a>
                  <?php if(strlen($kurs["altBaslik"]>50)):?>
                    <p><?php echo altBaslikUznluk($kurs["altBaslik"])?></p>
                    <?php else:?>
                <p class="card-text"><?php echo $kurs["altBaslik"]?></p>
                <?php endif?>
                     <p class="card-text mx-2">
                    <?php if($kurs["begeniSayi"]>0): ?>    
                        <span class=" border rounded-pill bg-warning">
                          <?php echo$kurs["begeniSayi"]?>:Beğenı
                        </span>
                        <?php endif?>
                     <?php if($kurs["yorumSayisi"]>0):?>
                        <span  class=" border rounded-pill bg-primary" > 
                          Yorumlar:<?php echo $kurs["yorumSayisi"]?>
                        </span>
                        <?php else:?>
                          <span class=" border rounded-pill bg-info">
                            <br>
                              henüz yorum yapılmadı sen yorum bırak
                        </span>
                        <?php endif?>
                          </p>   
                    </div>

              </div>
              
      </div>

   </div>
   <?php endif?>
 
   <?php endwhile ?>
   <?php else:?>
   <div class="alert alert-warning">
      kurs bulunamadi
   </div>


   <?php endif?>


            <?php if($res["total_pages"]>1): ?>
          <nav aria-label="Page navigation example">
             <ul class="pagination">
              <?php for($x=0; $x<=$res["total_pages"] ;$x++): ?>
               <li class="page-item<?php if($page==$x) echo "active";?> "><a class="page-link"
                href="<?php
                $url="?page=".$x;
                if(!empty($categoriId)){
                  $url.="&categoryid=".$categoriIds;
                }

                if(!empty($keyword)){
                      $url="&q=".$keyword;
                }
                echo $url;
                ?>
                "><?php echo $x;?>
              </a></li>
                    <?php endfor;?>
                 </ul>
          </nav>
             <?php endif?>
    </div>
  </div>

</div>

<?php require "viewes/_footer.php"?>
