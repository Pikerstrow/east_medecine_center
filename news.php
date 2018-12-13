<?php require_once("includes/head.php"); ?>

<?php

use Clinic\Classes\News;
use Clinic\Classes\Pagination;

if ($request->has('page')) {
   $currentPage = $request->getStringParam('page', true);
} else {
   $currentPage = 1;
}

$pagination = new Pagination('news.php', $currentPage, News::countItems());


$query = "SELECT * FROM news ORDER BY news_date DESC LIMIT {$pagination->perPage} ";
$query .= "OFFSET {$pagination->offset()}";

$news = News::selectByQuery($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Katia - News</title>

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
               <a class="nav-link" href="#Navbar">Новини</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="prices.php">Ціни</a>
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
               <h1>Новини</h1>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- News -->
<section class="py-5" id="News">
   <h2 class="text-center py-5">Новини</h2>
   <div class="container">

      <?php
      $counter = 0;
      foreach ($news as $post) {
         $counter++;
         if ($counter == $pagination->perPage or $counter == count($news)) {
            ?>

            <div class="row">
               <div class="col-lg-5 col-md-5 text-custom">
                  <img class="img-fluid rounded" src="<?php echo $post->news_image ?>">
               </div>
               <div class="col-lg-7 col-md-7 text-custom">
                  <h1 class="h1-custom"><?php echo $post->news_title ?>
                     <br>
                     <small class="date-custom">
                        <?php
                        $date = new DateTime($post->news_date);
                        echo $date->format('d-m-Y');
                        ?>
                     </small>
                  </h1>

                  <?php
                  $quantity = mb_strpos($post->news_body, "</p>");
                  if ($quantity > 450) {
                     $quantity = 450;
                  }
                  echo str_replace(mb_substr($post->news_body, $quantity), ' ... ', $post->news_body);
                  ?>
                  &nbsp;&nbsp;<a href="news1.php?news_id=<?php echo $post->news_id; ?>">Читати далі >></a>
               </div>
            </div>
         <?php } else { ?>
            <div class="row">
               <div class="col-lg-5 col-md-5 text-custom">
                  <img class="img-fluid rounded" src="<?php echo $post->news_image ?>" alt="">
               </div>
               <div class="col-lg-7 col-md-7 text-custom">
                  <h1 class="h1-custom"><?php echo $post->news_title ?>
                     <br>
                     <small class="date-custom">
                        <?php
                        $date = new DateTime($post->news_date);
                        echo $date->format('d-m-Y');
                        ?>
                     </small>
                  </h1>
                  <?php
                  $quantity = mb_strpos($post->news_body, "</p>");
                  if ($quantity > 450) {
                     $quantity = 450;
                  }
                  echo str_replace(mb_substr($post->news_body, $quantity), ' ... ', $post->news_body);
                  ?>
                  &nbsp;&nbsp;<a href="news1.php?news_id=<?php echo $post->news_id; ?>">Читати далі >></a>
               </div>
               <hr class="hr-custom">
            </div>
         <?php }
      } ?>
      <div class="row d-flex justify-content-center" style="margin-top:65px;">
         <div class="p-2"><?php echo $pagination->getLinks(); ?></div>
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
