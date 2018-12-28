<?php require_once("includes/head.php"); ?>

<?php

use Clinic\Classes\Review;
use Clinic\Classes\Pagination;

if ($request->has('page')) {
   $currentPage = $request->getStringParam('page', true);
} else {
   $currentPage = 1;
}

$pagination = new Pagination('reviews.php', $currentPage, Review::countItems());

$query = "SELECT * FROM reviews WHERE review_status = 1 ORDER BY review_date DESC  LIMIT {$pagination->perPage} ";
$query .= "OFFSET {$pagination->offset()}";

$reviews = Review::selectByQuery($query);

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
               <h1>Відгуки</h1>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- Reviews -->
<section class="py-5" id="News">
   <h2 class="text-center py-5">Відгуки наших пацієнтів</h2>
   <div class="container">


      <?php
      $counter = 0;
      foreach ($reviews as $review) {
         $counter++;
         if ($counter == $pagination->perPage or $counter == count($reviews)) {
            ?>
            <div class="row">
               <div class="col-lg-12 col-md-12 col-xs-12 col-12 text-center">
                  <img src="http://placehold.it/75x75" class="pb-4">
                  <p class="reviews-p">
                     <?php echo $review->review_text; ?>
                  </p>
                  <small class="reviews-small-data">
                     <?php
                     $date = new DateTime($review->review_date);
                     echo $date->format('d-m-Y');
                     ?>
                  </small>
                  <small class="reviews-small">&#x2014; <?php echo $review->review_name ?></small>
               </div>
            </div>
            <?php
         } else {
            ?>

            <div class="row">
               <div class="col-lg-12 col-md-12 col-xs-12 col-12 text-center">
                  <img src="http://placehold.it/75x75" class="pb-4">
                  <p class="reviews-p">
                     <?php echo $review->review_text; ?>
                  </p>
                  <small class="reviews-small-data">
                     <?php
                     $date = new DateTime($review->review_date);
                     echo $date->format('d-m-Y');
                     ?>
                  </small>
                  <small class="reviews-small">&#x2014; <?php echo $review->review_name ?></small>
               </div>
            </div>
            <hr class="hr-custom">
         <?php }
      } ?>
      <div class="row d-flex justify-content-center" style="margin-top: 55px;">
         <div class="p-2"><?php echo $pagination->getLinks(); ?></div>
      </div>


      <!-- Review Modal -->
      <nav aria-label="Page navigation example">
         <ul class="pagination justify-content-center">
            <button type="button" class="btn btn-primary new-btn btn-lg" data-toggle="modal"
                    data-target=".bd-example-modal-lg" data-whatever="@mdo">
               Написати Відгук
            </button>
         </ul>
      </nav>

      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
           aria-hidden="true">

         <div class="modal-dialog modal-lg custom-modal-dialog">

            <form method="post" action="" id="review_us_form">

               <div class="modal-content" id="review-modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Новий Відгук</h5>
                     <button type="button btn-close-custom" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body" id="modal-review-body">
                     <div class="" id="create-error-problem"></div>
                     <div class="form-group">
                        <input type="text" class="form-control" id="recipient-name" name="name" placeholder="Ваше Імя"
                               required>
                        <div class="name-response-help"></div>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                     </div>

                     <div class="form-group">
                        <input type="text" class="form-control" id="recipient-email" name="email"
                               placeholder="Ваш email"
                               required>
                        <div class="email-response-help"></div>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                     </div>

                     <div class="form-group">
                <textarea class="form-control" name="text" id="message-text" rows="7" placeholder="Ваш Відгук"
                          required></textarea>
                        <div class="message-response-help"></div>
                     </div>

                     <h4>Ваша стать:</h4>

                     <div class="custom-control custom-radio">
                        <input class="form-check-input" type="radio" name="gender" id="gender_man" value="чоловік"
                               checked>
                        <label class="form-check-label" for="gender_man">Чоловік</label>
                     </div>
                     <div class="custom-control custom-radio mb-3">
                        <input class="form-check-input" type="radio" name="gender" id="gender_woman" value="жінка">
                        <label class="form-check-label" for="gender_woman">Жінка</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                     </div>

                     <div class="form-group">
                        <input type="hidden" name="review_sent" class="form-control form-custom" value="true">
                     </div>

                  </div>

                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                     <button type="button" type="submit" name="review_send" id="review_send" class="btn btn-primary">
                        Написати Відгук
                     </button>
                  </div>

               </div>
            </form>
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
