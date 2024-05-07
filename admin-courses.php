<?php
require "libs/variables.php";
require "libs/function.php";


?>

<?php require "viewes/_header.php"?>
<?php include "viewes/_message.php"?>
<?php require "viewes/_navbar.php"?>


<div class="countainer m-3 ">

  <div class="row justify-content-md-center">
    <div class="col-12 mb-3">
    <div class="card-body mb-2 p-2 " style=" border: 1px solid black">
    <a href="course-creat.php" class="btn btn-primary btn-sm " style="width:100%" >Ekle</a>
        
    </div>

    <table class="table table-dark table-striped table-bordered ">
    <thead>
        <tr class="text-center">
            <th style="width: 70px;">Id</th>
            <th style="width: 150px;">Resim</th>
            <th>Başlik</th>
            <th style="width:250px">Kategori Ad</th>
            <th style="width: 70px;">Onay</th>
            <th style="width: 70px;">Ana Sayfa</th>
            <th style="width: 150px;"></th>
        </tr>
      </thead>
        <?php $sonuc=GetCourses(false,false); while($course= mysqli_fetch_assoc($sonuc)):?>
              <tr class="text-center">
              <td> <?php echo $course["id"]?></td>
              <td> <img class="img-fluid" src="img/<?php echo $course["resim"]?>" alt=""></td>
              <td> <?php echo $course["baslik"]?></td>
              <td> 
              <?php
              echo "<ul>";
                   $result=CategoriesGetId( $course["id"]);
                  if(mysqli_num_rows($result)>0)
                  {
                         while($category=mysqli_fetch_assoc($result)){
                          echo "<li>".$category["kategori_ad"]."</li>";
                         }
                  }
                  else{
                    echo "<li> Kategori Seçilmedi </li>";
                  }

                  echo "</ul>";    
              ?>       
              </td>
              <td> <?php if($course["onay"]):?>
                <i class="fa-solid fa-check"></i>
                <?php else: ?>
                <i class="fa-regular fa-circle-xmark"></i>
                <?php endif;?>
              </td>

              <td> <?php if($course["anasayfa"]):?>
                <i class="fa-solid fa-check"></i>
                <?php else: ?>
                <i class="fa-regular fa-circle-xmark"></i>
                <?php endif;?>
              </td>

              <td> <a href="courses-edit.php?id=<?php echo $course["id"]?>" class="btn btn-primary btn-sm"  data-bs-toggle="button">Edit</a>
              <a href="courses-delet.php?id=<?php echo $course["id"]?>" class="btn btn-danger btn-sm" data-bs-toggle="button">Delet</a>
            </td>
              </tr>
            <?php endwhile?>
      <tbody>

      </tbody>
    </table>
    
    </div>

  </div>

</div>

<?php require "viewes/_footer.php"?>
