<!--
/*
if(!empty($_GET["q"]))
{
$key= $_GET["q"];
$kurslar=array_filter($kurslar,function($skurs) use($key){
 return stristr($skurs['kurs'],$key) or stristr($skurs['altBaslik'],$key);
});
}
*/
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand text-light" href="index.php">CourseApp</a>
<ul class="navbar-nav me-auto">
    <li class="nav-item ">
        <a class="nav-link" href="index.php">Anasayfa</a> 
    </li>
   <li class="nav-item ">
        <a class="nav-link" href="admin-categories.php">Admin  Categories</a> 
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="admin-courses.php">Admin  Courses</a> 
    </li>
</ul>

<ul class="navbar-nav me-5">
    <?php if(isset($_COOKIE["auth"])):?>
 <li class="nav-item ">
        <a class="nav-link" href="logout.php">Logout</a> 
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="login.php"><?php echo "Hoşgeldin,".$_COOKIE["auth"]["name"]?></a> 
    </li>
    <?php else:?>

  <li class="nav-item ">
        <a class="nav-link" href="login.php">Giriş Yap</a> 
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="register.php">Kullanıcı Oluştur</a> 
    </li>
    
    <?php endif;?>
</ul>

<form action="courses.php" method="get" class="d-flex">
   <input class="form-control me-2" type="text"  name="q" placeholder="Search" >
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
</div>
</nav>