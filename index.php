<?php use Clinic\Classes\Avatar;
use Clinic\Classes\News;
use Clinic\Classes\Review;
use Clinic\Classes\Service;
use Clinic\Classes\Publication;
use Clinic\Classes\Category;

require_once("includes/head.php"); ?>

<body>

<!-- Button To Top -->
<a class="btn-top" style="display: none;">
   <i class="fa fa-arrow-up"></i>
</a>

<!-- PreLoader-->
<div class="preloader">
   <div class="container">
      <div class="row">
         <div class="loader">
            Yao Wang
            <span></span>
            <span></span>
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>

<!-- Navigation -->
<?php require_once("includes/navigation.php") ?>

<!-- Slider -->
<header id="Navbar">
   <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item parallax active" style="background-image: url('img/MainSlider/bg.jpg')">
            <div class="carousel-caption d-md-block">
               <div class="slider-text-center">
                  <img src="img/Logo/logo.png" class="img-fluid" alt="">
                  <p class="p-slider-custom">Центр традиційної</p>
                  <p class="p-slider-custom">китайської медецини</p>
               </div>
            </div>
         </div>
         <div class="carousel-item parallax" style="background-image: url('http://placehold.it/1900x1080/m')"></div>
         <div class="carousel-item parallax" style="background-image: url('http://placehold.it/1900x1080/')"></div>
      </div>
   </div>
</header>

<!-- About Us -->
<section class="py-5" id="AboutUs">
   <h2 class="text-center p-5">Про нас</h2>
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-6 pad-text-cont">
            <p class="text-justify">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
               dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
               ex ea commodo consequat. Duis
               aute irure dolor
               in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
               cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor
               sit amet, consectetur
               adipisicing
               elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
               nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
               reprehenderit in voluptate
               velit
               esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
               culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
               adipisicing elit, sed do eiusmod tempor
               incididunt
               ut labore et dolore magna aliqua.
            </p>
         </div>
         <div class="col-lg-6 col-md-6 text-custom">
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item carousel-item2 active"
                       style="background-image: url('http://placehold.it/500x300/m')"></div>
                  <div class="carousel-item carousel-item2"
                       style="background-image: url('http://placehold.it/500x300/m')"></div>
                  <div class="carousel-item carousel-item2"
                       style="background-image: url('http://placehold.it/500x300/m')"></div>
               </div>
               <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Our Doctors -->
<section class="py-5" id="Doctors">
   <h2 class="text-center p-5">Наші лікарі</h2>
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center">
            <a href="doctor.html" class="a-custom">
               <img class="rounded-circle img-fluid" src="http://placehold.it/200x200" alt="">
            </a>
            <a href="doctor.html" class="a-custom">
               <h1 class="pt-4 h1-custom">Anton Lorem
                  <small class="small-custom">Job Title</small>
               </h1>
            </a>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center">
            <a href="doctor.html" class="a-custom">
               <img class="rounded-circle img-fluid" src="http://placehold.it/200x200" alt="">
            </a>
            <a href="doctor.html" class="a-custom">
               <h1 class="pt-4 h1-custom">Anton Lorem
                  <small class="small-custom">Job Title</small>
               </h1>
            </a>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center">
            <a href="doctor.html" class="a-custom">
               <img class="rounded-circle img-fluid" src="http://placehold.it/200x200" alt="">
            </a>
            <a href="doctor.html" class="a-custom">
               <h1 class="pt-4 h1-custom">Anton Lorem
                  <small class="small-custom">Job Title</small>
               </h1>
            </a>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center">
            <a href="doctor.html" class="a-custom">
               <img class="rounded-circle img-fluid" src="http://placehold.it/200x200" alt="">
            </a>
            <a href="doctor.html" class="a-custom">
               <h1 class="pt-4 h1-custom">Anton Lorem
                  <small class="small-custom">Job Title</small>
               </h1>
            </a>
         </div>
      </div>
   </div>
</section>

<!-- What We Treating -->
<section class="py-5" id="WhatTreat">
   <h2 class="text-center p-5">Що ми лікуємо</h2>
   <div class="container">
      <div class="row">
         <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
            <img class="rounded img-fluid" src="http://placehold.it/150x150" alt="">
            <h2 class="pt-4 small-custom">Treating 1</h2>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
            <img class="rounded img-fluid" src="http://placehold.it/150x150/m" alt="">
            <h2 class="pt-4 small-custom">Treating 2</h2>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
            <img class="rounded img-fluid" src="http://placehold.it/150x150" alt="">
            <h2 class="pt-4 small-custom">Treating 3</h2>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
            <img class="rounded img-fluid" src="http://placehold.it/150x150/m" alt="">
            <h2 class="pt-4 small-custom">Treating 4</h2>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
            <img class="rounded img-fluid" src="http://placehold.it/150x150" alt="">
            <h2 class="pt-4 small-custom">Treating 5</h2>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
            <img class="rounded img-fluid" src="http://placehold.it/150x150/m" alt="">
            <h2 class="pt-4 small-custom">Treating 6</h2>
         </div>
      </div>
   </div>
</section>

<!-- Servants -->
<section class="py-5" id="Servants">
   <h2 class="text-center py-5">Послуги</h2>
   <div class="container">

      <div class="row">
          <?php
          $categories = Category::getAllWithLimit(4);
          ?>
         <?php foreach($categories as $category): ?>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated"
              data-wow-duration=".5" data-wow-delay=".4s" >
            <a href="servants.php?category_id=<?php echo $category->category_id ?>" class="a-custom">
               <div class="container-2 mx-auto">
                  <img style="width:100%;" class="rounded img-fluid servants-img-hov image" src="<?php echo $category->category_image ?>" alt="Avatar"
                       class="image">
                  <div class="overlay rounded">
                     <div class="text"><?php echo $category->category_title ?></div>
                  </div>
               </div>
            </a>
         </div>
         <?php endforeach; ?>
<!--         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated"-->
<!--              data-wow-duration=".5" data-wow-delay=".3s">-->
<!--            <a href="servants.html" class="a-custom">-->
<!--               <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">-->
<!--               <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".6s">Servant-->
<!--                  1</h1>-->
<!--            </a>-->
<!--         </div>-->
<!--         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated"-->
<!--              data-wow-duration=".5" data-wow-delay=".2s">-->
<!--            <a href="servants.html" class="a-custom">-->
<!--               <img class="rounded img-fluid" src="http://placehold.it/200x200/" alt="">-->
<!--               <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".7s">Servant-->
<!--                  3</h1>-->
<!--            </a>-->
<!--         </div>-->
<!--         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated"-->
<!--              data-wow-duration=".5" data-wow-delay=".1s">-->
<!--            <a href="servants.html" class="a-custom">-->
<!--               <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">-->
<!--               <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".8s">Servant-->
<!--                  4</h1>-->
<!--            </a>-->
<!--         </div>-->
      </div>
   </div>
</section>

<!-- Partners -->
<section class="py-5 partners-bg" id="Partners">
   <h2 class="text-center py-5">Наші партнери</h2>
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center mb-4">
            <img class="rounded img-fluid" src="http://placehold.it/200x200" alt="">
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center mb-4">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center mb-4">
            <img class="rounded img-fluid" src="http://placehold.it/200x200" alt="">
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center mb-4">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">
         </div>
      </div>
   </div>
</section>


<!-- Reviews -->
<section class="py-5" id="Reviews">
   <h2 class="text-center py-5">Відгуки наших пацієнтів</h2>
   <div class="container">
       <?php
       $reviews = Review::getWithLimitByParam(5, 'review_status', 1);
       ?>
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div id="carouselExampleSlidesOnly3" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner pb-5">
                   <?php foreach ($reviews as $key => $review) {
                       if ($key == 0) {
                           ?>
                          <div class="carousel-item carousel-item3 text-center active">
                             <img width="80" src="<?php echo $review->review_avatar ?>" class="pb-4">
                             <p class="reviews-p">
                                 <?php echo $review->review_text ?>
                                <a href="reviews.php">Більше...</a>
                             </p>
                             <small class="reviews-small-data">
                                 <?php
                                 $date = new DateTime($review->review_date);
                                 echo $date->format('d-m-Y');
                                 ?>
                             </small>
                             <small class="reviews-small">&#x2014; <?php echo $review->review_name ?></small>
                          </div>
                           <?php
                       } else {
                           ?>
                          <div class="carousel-item carousel-item3 text-center ">
                             <img width="80" src="<?php echo $review->review_avatar ?>" class="pb-4">
                             <p class="reviews-p">
                                 <?php echo $review->review_text ?>
                                <a href="reviews.php">Більше...</a>
                             </p>
                             <small class="reviews-small-data">
                                 <?php
                                 $date = new DateTime($review->review_date);
                                 echo $date->format('d-m-Y');
                                 ?>
                             </small>
                             <small class="reviews-small">&#x2014; <?php echo $review->review_name ?></small>
                          </div>
                       <?php } ?>
                   <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>



<!-- News -->
<section class="py-5" id="News">
   <h2 class="text-center py-5">Новини</h2>
   <div class="container">
       <?php
       $news = News::getLast('news_date');
       ?>
      <div class="row">
         <div class="col-lg-5 col-md-5">
            <img class="img-fluid rounded" src="<?php echo $news->news_image ?>" alt="<?php echo $news->news_title ?>">
         </div>
         <div class="col-lg-7 col-md-7 text-custom">
            <h1 class="h1-custom"><?php echo $news->news_title ?>
               <small class="date-custom">
                   <?php
                   $date = new DateTime($news->news_date);
                   echo $date->format('d-m-Y');
                   ?>
               </small>
            </h1>
            <p>
                <?php echo $news->getFirstParagraph(); ?>
            </p>
         </div>
      </div>
   </div>
   <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
         <a class="btn btn-outline-primary new-btn btn-lg" href="news.php" role="button">Більше Новин</a>
      </ul>
   </nav>
</section>

<!-- Publications -->
<section class="py-5" id="Publications">
   <h2 class="text-center py-5">Публікації</h2>
   <div class="container">
       <?php
       $publication = Publication::getLast('publication_date');
       ?>
      <div class="row">
         <div class="col-lg-5 col-md-5">
            <img class="img-fluid rounded" src="<?php echo $publication->publication_image ?>" alt="<?php echo $publication->publication_title ?>">
         </div>
         <div class="col-lg-7 col-md-7 text-custom">
            <h1 class="h1-custom"><?php echo $publication->publication_title ?>
               <small class="date-custom">
                   <?php
                   $date = new DateTime($publication->publication_date);
                   echo $date->format('d-m-Y');
                   ?>
               </small>
            </h1>
            <p>
                <?php echo $publication->getFirstParagraph(); ?>
            </p>
         </div>
      </div>
   </div>
   <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
         <a class="btn btn-outline-primary new-btn btn-lg" href="publications.php" role="button">Більше Публікацій</a>
      </ul>
   </nav>
</section>

<!-- Map -->
<section class="map-mt" id="Map">
   <h2 class="text-center pb-5">Наша Адреса</h2>
   <iframe src="https://snazzymaps.com/embed/72468" width="100%" height="500px" style="border:none;"></iframe>
</section>

<!-- Footer -->
<?php require_once("includes/footer.php"); ?>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/wow.js"></script>
<script src="js/index.js"></script>
</body>

</html>
