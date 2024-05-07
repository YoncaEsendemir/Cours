<?php
require "libs/variables.php";
require "libs/function.php";


?>

<?php require "viewes/_header.php"?>
<?php include "viewes/_message.php"?>
<?php require "viewes/_navbar.php"?>


<div class="countainer m-3">

  <div class="row">
    <div class="col-12">
    <div class="card-body mb-2 p-2 " style=" border: 1px solid black">
    <a href="category-creat.php" class="btn btn-primary btn-sm " style="width:100%" >Ekle</a>
        
    </div>

    <table class="table table-dark table-striped table-bordered">
    <thead>
        <tr >
            <th style="width: 50px;"> Id</th>
            <th> Kategori</th>
            <th style="width: 130px;"> </th>
        </tr>
      </thead>
        <?php $sonuc=CategoriesGet(); while($categori= mysqli_fetch_assoc($sonuc)):?>
              <tr>
              <td> <?php echo $categori["id"]?></td>
              <td> <?php echo $categori["kategori_ad"]?></td>
              <td> <a href="category-edit.php?id=<?php echo $categori["id"]?>" class="btn btn-primary btn-sm"  data-bs-toggle="button">Edit</a>
              <a href="category-delet.php?id=<?php echo $categori["id"]?>" class="btn btn-danger btn-sm" data-bs-toggle="button">Delet</a>
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
