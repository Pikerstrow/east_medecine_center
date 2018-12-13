
<?php require_once("includes/head.php"); ?>

<body>

  <!-- Button To Top -->
  <a class="btn-top" style="display: none;">
    <i class="fa fa-arrow-up"></i>
  </a>

  <!-- PreLoader -->
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
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
            aute irure dolor
            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
            adipisicing
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
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
              <div class="carousel-item carousel-item2 active" style="background-image: url('http://placehold.it/500x300/m')"></div>
              <div class="carousel-item carousel-item2" style="background-image: url('http://placehold.it/500x300/m')"></div>
              <div class="carousel-item carousel-item2" style="background-image: url('http://placehold.it/500x300/m')"></div>
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
  <!--<section class="py-5" id="Servants">
    <h2 class="text-center py-5">Послуги</h2>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".4s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".5s">Servant 1</h1>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".3s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".6s">Servant 1</h1>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".2s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".7s">Servant 3</h1>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".1s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".8s">Servant 4</h1>
          </a>
        </div>
      </div>
    </div>
  </section>-->
  <section class="py-5" id="Servants">
    <h2 class="text-center py-5">Послуги</h2>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".4s">
          <a href="servants.html" class="a-custom">
            <div class="container-2">
              <img class="rounded img-fluid servants-img-hov image" src="http://placehold.it/200x200"  alt="Avatar" class="image">
              <div class="overlay rounded">
                <div class="text">Servants 1</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".3s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".6s">Servant 1</h1>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".2s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".7s">Servant 3</h1>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 text-center servants-images-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".1s">
          <a href="servants.html" class="a-custom">
            <img class="rounded img-fluid" src="http://placehold.it/200x200/m" alt="">
            <h1 class="pt-4 h1-custom wow fadeInLeft animated" data-wow-duration=".5" data-wow-delay=".8s">Servant 4</h1>
          </a>
        </div>
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

  <!-- News -->
  <section class="py-5" id="News">
    <h2 class="text-center py-5">Новини</h2>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5">
          <img class="img-fluid rounded" src="http://placehold.it/700x400" alt="">
        </div>
        <div class="col-lg-7 col-md-7 text-custom">
          <h1 class="h1-custom">News 1
            <small class="date-custom">01.01.2018</small>
          </h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor
            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
            adipisicing
            elit.
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

  <!-- Reviews -->
  <section class="py-5" id="Reviews">
    <h2 class="text-center py-5">Відгуки</h2>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div id="carouselExampleSlidesOnly3" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner pb-5">
              <div class="carousel-item carousel-item3 text-center active">
                <img src="http://placehold.it/75x75" class="pb-4">
                <p class="reviews-p">
                  1 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure
                  dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  <a href="reviews.php">Більше...</a>
                </p>
                <small class="reviews-small-data">01.01.2018</small>
                <small class="reviews-small">&#x2014; Vova Nikishun</small>
              </div>
              <div class="carousel-item carousel-item3 text-center">
                <img src="http://placehold.it/75x75" class="pb-4">
                <p class="reviews-p">
                  2 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure
                  dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  <a href="reviews.php">Більше...</a>
                </p>
                <small class="reviews-small-data">01.01.2018</small>
                <small class="reviews-small">&#x2014; Vova Nikishun</small>
              </div>
              <div class="carousel-item carousel-item3 text-center">
                <img src="http://placehold.it/75x75" class="pb-4">
                <p class="reviews-p">
                  3 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure
                  dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  <a href="reviews.php">Більше...</a>
                </p>
                <small class="reviews-small-data">01.01.2018</small>
                <small class="reviews-small">&#x2014; Vova Nikishun</small>
              </div>
              <div class="carousel-item carousel-item3 text-center">
                <img src="http://placehold.it/75x75" class="pb-4">
                <p class="reviews-p">
                  4 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure
                  dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  <a href="reviews.php">Більше...</a>
                </p>
                <small class="reviews-small-data">01.01.2018</small>
                <small class="reviews-small">&#x2014; Vova Nikishun</small>
              </div>
              <div class="carousel-item carousel-item3 text-center">
                <img src="http://placehold.it/75x75" class="pb-4">
                <p class="reviews-p">
                  5 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure
                  dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  <a href="reviews.php">Більше...</a>
                </p>
                <small class="reviews-small-data">01.01.2018</small>
                <small class="reviews-small">&#x2014; Vova Nikishun</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
