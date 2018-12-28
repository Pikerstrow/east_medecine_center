<?php

use Clinic\Classes\Category;

$categories = Category::getAll();
?>

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
                   <?php foreach ($categories as $category): ?>
                      <a class="dropdown-item"
                         href="servants.php?category_id=<?php echo $category->category_id ?>"><?php echo $category->category_title ?></a>
                      <!--                  <a class="dropdown-item" href="index.php#Servants">Масаж</a>-->
                      <!--                  <a class="dropdown-item" href="index.php#Servants">Послуга 3</a>-->
                      <!--                  <a class="dropdown-item" href="index.php#Servants">Послуга 4</a>-->
                      <!--                  <a class="dropdown-item" href="index.php#Servants">Послуга 5</a>-->
                   <?php endforeach; ?>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#News">Новини</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#Publications">Публікації</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="prices.php">Ціни</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#Reviews">Відгуки</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index.php#Contact">Контакти</a>
            </li>
         </ul>
      </div>
   </div>
</nav>
