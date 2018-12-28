<?php require_once("includes/head_price.php"); ?>

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

for ($i = 0; $i < count($allInfo); $i++) {
    $services[$allInfo[$i]['category_title']] = array_combine(explode(",", $allInfo[$i]['services']), explode(",", $allInfo[$i]['prices']));
}

/*If some category has no services yet - piece of code below removes such categories from the $services array*/
foreach ($services as $key => $value) {
    foreach ($value as $k => $v) {
        if (empty($k) or $k == '') {
            echo "got";
            unset($services[$key]);
        }
    }
}

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

       <?php foreach ($services as $category => $service) {
           $counter = 1;
           if (true) {
               ?>
              <div class="row">
                 <div class="col-lg-12">
                    <h2 class="text-center p-5"><?php echo $category ?></h2>
                    <table class="table">
                       <tbody>
                       <?php
                       foreach ($service as $name => $price) {
                           ?>
                          <tr>
                             <td class="text-center th-left" style="width:60px;"><?php echo $counter ?></td>
                             <td><?php echo $name ?></td>
                             <td class="text-right td-right"><?php echo number_format($price, 2, '.', ' ') ?> грн.</td>
                          </tr>
                           <?php
                           $counter++;
                       }
                       ?>
                       </tbody>
                    </table>
                 </div>
              </div>
           <?php }
       } ?>

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
