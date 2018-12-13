<?php require_once("includes/head.php"); ?>

<?php

use Clinic\Classes\Service;
use Clinic\Classes\Category;
use Clinic\Classes\Pagination;


if ($request->has('page')) {
   $currentPage = $request->getStringParam('page', true);
} else {
   $currentPage = 1;
}

$pagination = new Pagination('prices.php', $currentPage, Category::countItems());

$query = "SELECT c.category_title, GROUP_CONCAT(DISTINCT s.service_title SEPARATOR ',') AS services, GROUP_CONCAT(s.service_price SEPARATOR ',') AS prices FROM categories ";
$query .= "AS c LEFT JOIN `services` AS s ON c.category_id = s.service_category_id GROUP BY c.category_id DESC LIMIT {$pagination->perPage} OFFSET {$pagination->offset()}";

$allInfo = Category::selectByQuery($query);

$services = array();

for($i=0; $i<count($allInfo); $i++){
   $services[$allInfo[$i]['category_title']] = array_combine(explode(",", $allInfo[$i]['services']), explode(",", $allInfo[$i]['prices']));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Katia - Price</title>

   <!-- Styles -->
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/hamburgers.css">
   <link rel="stylesheet" href="css/animate.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</head>

<body>

<!-- Button To Top -->
<a class="btn-top" style="display: none;">
   <i class="fa fa-arrow-up"></i>
</a>

<!-- PreLoader -->
<div class="preloader">
   <div class="container">
      <div class="loader">
         Yao Wang
         <span></span>
         <span></span>
         <span></span>
         <span></span>
      </div>
   </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
   <div class="container">
      <a class="navbar-brand" href="index.php">Yao Wang</a>
      <button class="navbar-toggler hamburger hamburger--spin" type="button" data-toggle="collapse"
              data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
              aria-label="Toggle navigation" style="outline:none;">
        <span class="navbar-toggler-icon hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="index.php">Головна<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#AboutUs">Про нас</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="index.php#Servants" id="navbarDropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Послуги</a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="index.php#Servants">Послуга 1</a>
                  <a class="dropdown-item" href="index.php#Servants">Масаж</a>
                  <a class="dropdown-item" href="index.php#Servants">Послуга 3</a>
                  <a class="dropdown-item" href="index.php#Servants">Послуга 4</a>
                  <a class="dropdown-item" href="index.php#Servants">Послуга 5</a>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#News">Новини</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#Navbar">Ціни</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#Reviews">Відгуки</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#Contact">Контакти</a>
            </li>
         </ul>
      </div>
   </div>
</nav>

<!-- FullScreen Image -->
<header id="Navbar">
   <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active parallax" style="background-image: url('http://placehold.it/1900x1080/')">
            <div class="text-center slider-text">
               <h1>Ціни</h1>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- Prices -->
<section class="py-5" id="News">
   <h2 class="text-center py-5">Вартість Медичних Послуг</h2>
   <div class="container">

      <?php foreach($services as $category => $service){
         $counter = 1;
      ?>
      <div class="row">
         <div class="col-lg-12">
            <h2 class="text-center p-5"><?php echo $category ?></h2>
            <table class="table">
               <tbody>
               <?php
               foreach($service as $name => $price){?>
               <tr>
                  <th scope="row" class="text-center th-left"><?php echo $counter ?></th>
                  <td ><?php echo $name ?></td>
                  <td class="td-right"><?php echo $price ?></td>
               </tr>
               <?php
                  $counter++;
               }
               ?>
               </tbody>
            </table>
         </div>
      </div>
      <?php } ?>

<!--      <div class="row">-->
<!--         <div class="col-lg-12">-->
<!--            <h2 class="text-center p-5">Масаж 2</h2>-->
<!--            <table class="table">-->
<!--               <tbody>-->
<!--               <tr>-->
<!--                  <th scope="row" class="text-center th-left">1</th>-->
<!--                  <td colspan="2">Масаж 1</td>-->
<!--                  <td class="td-right">600 грн</td>-->
<!--               </tr>-->
<!--               <tr>-->
<!--                  <th scope="row" class="text-center th-left">2</th>-->
<!--                  <td colspan="2">Масаж 2</td>-->
<!--                  <td class="td-right">300 грн</td>-->
<!--               </tr>-->
<!--               <tr>-->
<!--                  <th scope="row" class="text-center th-left">3</th>-->
<!--                  <td colspan="2">Масаж 3</td>-->
<!--                  <td class="td-right">268 грн</td>-->
<!--               </tr>-->
<!--               </tbody>-->
<!--            </table>-->
<!--         </div>-->
<!--      </div>-->
<!--      <div class="row">-->
<!--         <div class="col-lg-12">-->
<!--            <h2 class="text-center p-5">Масаж 3</h2>-->
<!--            <table class="table">-->
<!--               <tbody>-->
<!--               <tr>-->
<!--                  <th scope="row" class="text-center th-left">1</th>-->
<!--                  <td colspan="2">Масаж 1</td>-->
<!--                  <td class="td-right">600 грн</td>-->
<!--               </tr>-->
<!--               <tr>-->
<!--                  <th scope="row" class="text-center th-left">2</th>-->
<!--                  <td colspan="2">Масаж 2</td>-->
<!--                  <td class="td-right">300 грн</td>-->
<!--               </tr>-->
<!--               <tr>-->
<!--                  <th scope="row" class="text-center th-left">3</th>-->
<!--                  <td colspan="2">Масаж 3</td>-->
<!--                  <td class="td-right">268 грн</td>-->
<!--               </tr>-->
<!--               </tbody>-->
<!--            </table>-->
<!--         </div>-->
<!--      </div>-->
   </div>
</section>

<!-- Footer -->
<?php require_once("includes/footer.php"); ?>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/wow.js"></script>
<script src="js/index.js"></script>
</body>

</html>
