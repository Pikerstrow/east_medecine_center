<?php require_once("includes/head.php"); ?>

<?php

use Clinic\Classes\News;
use Clinic\Classes\Pagination;

if ($request->has('news_id')) {
   $news_id = $request->getStringParam('news_id', true, true);
} else {
   $news_id = '';
}

$post = News::getByParam('news_id', $news_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Anahata</title>

   <link rel="icon" href="img/icon/favicon.png" type="image/x-icon">

   <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

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
<div class="preloader"></div>

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

<!-- News -->
<div class="container pt-5 pb-5">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 col-12">
         <h2 class="h2-custom mt-4"><?php echo $post->news_title; ?>
            <br>
            <small class="date-custom">
               <?php
               $date = new DateTime($post->news_date);
               echo $date->format('d-m-Y');
               ?>
            </small>
         </h2>
         <hr>
         <img style="width:450px;" class="img-fluid rounded float-left mr-mb" src="<?php echo $post->news_image ?>"
              alt="">
         <div class="news-body">
            <?php echo $post->news_body; ?>
         </div>
      </div>
   </div>

</div>
<nav class="pb-5" aria-label="Page navigation example">
   <ul class="pagination justify-content-center">
      <li class="page-item"><a class="page-link new1-color" href="news.php">Назад до новин</a></li>
   </ul>
</nav>

<!-- Footer -->
<footer class="py-5 footer-bg" id="Contact">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-6 col-xs-12 col-12">
            <h3 class="py-3">ЗВ&#39;ЯЖИСЯ ЗІ МНОЮ</h3>
            <address>
               <ul class="ul-footer">
                  <li class="li-footer"><a href="#" class="a-custom"><i class="i-footer fa fa-envelope"
                                                                        aria-hidden="true"></i>support@support.com</a>
                  </li>
                  <li class="li-footer"><a href="#" class="a-custom"><i class="i-footer fa fa-phone"
                                                                        aria-hidden="true"></i>+380 99 008 0633</a></li>
                  <li class="li-footer"><a href="#" class="a-custom"><i class="i-footer fa fa-map-marker"
                                                                        aria-hidden="true"></i> Луцьк, вул. Винниченка,
                        67А</a></li>
               </ul>
               <ul class="ul-social">
                  <li><a href="#" class="a-socail"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                  <li><a href="#" class="a-socail"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
               </ul>
            </address>
         </div>
         <div class="col-lg-6 col-md-6 col-xs-12 col-12">
            <iframe class="py-3" src="https://snazzymaps.com/embed/101332" width="100%" height="300px"
                    style="border:none;"></iframe>
         </div>
      </div>
      <div class="copyright-area text-center">
         Design by <a href="http://www.poniwebstudio.com" target="_blank">Po | Ni</a> web studio
      </div>
   </div>
</footer>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/wow.js"></script>
<script src="js/index.js"></script>
</body>

</html>
