<?php require_once("init.php"); ?>

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

   <title><?php echo $post->news_title ?></title>

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
<?php require_once("includes/navigation_prices.php"); ?>
<!-- News -->
<div class="container pt-5 pb-5">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12 col-12">
         <h2 class="h2-custom mt-4"><?php echo $post->news_title; ?>
            <br>
            <small class="date-custom">
               <?php
               $date = new DateTime($post->news_date);
               echo "Новина додана: " . $date->format('d-m-Y');
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
<?php require_once("includes/footer.php"); ?>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/wow.js"></script>
<script src="js/index.js"></script>
</body>

</html>
