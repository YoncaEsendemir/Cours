<?php

if(isset($_GET["categoryid"]) and is_numeric($_GET["categoryid"]))
{
    $kategori_id=$_GET["categoryid"];
}

  $sonuc=CategoriesGet();
?>

<div class="card text-start" >
  <div class="card-header text-secondary ">
   Kategoriler
  </div>
<div class="list-group">

<a href="courses.php"  class="list-group-item list-group-item-action "> Tüm Kurslar</a>
  <?php while($kategori = mysqli_fetch_assoc($sonuc)):?>
 

  <a href="<?php echo "courses.php?categoryid=".$kategori["id"]?>" 
  class="list-group-item list-group-item-action <?php
    if($kategori_id==$kategori["id"])
    {
       echo "active";
    }
  ?>
  ">
  <?php echo $kategori["kategori_ad"]?></a>


<?php endwhile?>

</div>
</div>