<?php require_once("includes/head_publications.php"); ?>

<?php

use Clinic\Classes\News;
use Clinic\Classes\Pagination;
use Clinic\Classes\Publication;

if ($request->has('page')) {
   $currentPage = $request->getStringParam('page', true);
} else {
   $currentPage = 1;
}

$pagination = new Pagination('publications.php', $currentPage, Publication::countItems());


$query = "SELECT * FROM publications ORDER BY publication_date DESC LIMIT {$pagination->perPage} ";
$query .= "OFFSET {$pagination->offset()}";

$publications = Publication::selectByQuery($query);


?>



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
               <h1>Публікації</h1>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- News -->
<section class="py-5" id="News">
   <div class="container">

      <?php
      $counter = 0;
      foreach ($publications as $publication) {
         $counter++;
         if ($counter == $pagination->perPage or $counter == count($publications)) {
            ?>

            <div class="row">
               <div class="col-lg-5 col-md-5 text-custom">
                  <img class="img-fluid rounded" src="<?php echo $publication->publication_image ?>">
               </div>
               <div class="col-lg-7 col-md-7 text-custom">
                  <h1 class="h1-custom"><?php echo $publication->publication_title ?>
                     <br>
                     <small class="date-custom">
                        <?php
                        $date = new DateTime($publication->publication_date);
                        echo $date->format('d-m-Y');
                        ?>
                     </small>
                  </h1>

                  <?php
                  $quantity = mb_strpos($publication->publication_body, "</p>");
                  if ($quantity > 450) {
                     $quantity = 450;
                  }
                  echo str_replace(mb_substr($publication->publication_body, $quantity), ' ... ', $publication->publication_body);
                  ?>
                  &nbsp;&nbsp;<a href="publication1.php?publication_id=<?php echo $publication->publication_id; ?>">Читати далі >></a>
               </div>
            </div>
         <?php } else { ?>
            <div class="row">
               <div class="col-lg-5 col-md-5 text-custom">
                  <img class="img-fluid rounded" src="<?php echo $publication->publication_image ?>" alt="">
               </div>
               <div class="col-lg-7 col-md-7 text-custom">
                  <h1 class="h1-custom"><?php echo $publication->publication_title ?>
                     <br>
                     <small class="date-custom">
                        <?php
                        $date = new DateTime($publication->publication_date);
                        echo $date->format('d-m-Y');
                        ?>
                     </small>
                  </h1>
                  <?php
                  $quantity = mb_strpos($publication->publication_body, "</p>");
                  if ($quantity > 450) {
                     $quantity = 450;
                  }
                  echo str_replace(mb_substr($publication->publication_body, $quantity), ' ... ', $publication->publication_body);
                  ?>
                  &nbsp;&nbsp;<a href="publication1.php?publication_id=<?php echo $publication->publication_id; ?>">Читати далі >></a>
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
