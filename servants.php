<?php

use Clinic\Classes\Category;
use Clinic\Classes\Service;

require_once("init.php") ?>

<?php

if ($request->has('category_id')) {
    $category_id = $request->getStringParam('category_id', true, true);
} else {
    $category_id = '';
}

$category = Category::getByParam('category_id', $category_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Katia - Servants</title>

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
<?php require_once("includes/navigation_prices.php"); ?>
<!-- FullScreen Image -->
<header id="Navbar">
   <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active parallax" style="background-image: url('http://placehold.it/1900x1080/')">
            <div class="text-center slider-text">
               <h1><?php echo $category->category_title ?></h1>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- Servants -->
<section class="py-5" id="AboutUs">
   <div class="container">
      <div class="row">
         <div class="col-12 pad-text-cont-2">
             <?php echo $category->category_body ?>
         </div>
      </div>
   </div>
</section>

<!-- Types of Servant -->
<section class="py-1" id="WhatTreat">
   <div class="container">
      <div class="row">
          <?php
          $services = Service::getAllWhere('service_category_id', $category_id);
          ?>
          <?php if ($services): ?>
         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <h2 class="p5-custom">Види послуг даної категорії, які ми Вам пропонуємо:</h2>
         </div>
      </div>
      <div class="row" style="margin-bottom: 50px;">
          <?php foreach ($services as $service): ?>
             <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
                <img class="rounded img-fluid small-custom-2" width="150" src="<?php echo $service->service_image ?>"
                     alt="">
                <h2 class="pt-4 small-custom"><?php echo $service->service_title ?></h2>
             </div>
          <?php endforeach; ?>
          <?php else: ?>
             <div class="col-12 text-center" style="margin-bottom: 50px;">
                <h2>Нажаль дана категорія поки не містить послуг</h2>
             </div>
          <?php endif; ?>
      </div>
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
