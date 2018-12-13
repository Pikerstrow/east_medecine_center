<?php
use Clinic\Classes\Message;
use Clinic\Classes\Review;
?>
<aside>
   <div id="sidebar-nav">
      <ul class="sidebar-menu">
         <li><a href="index.php"><span class="i-wrap"><i class="fas fa-tachometer-alt"></i></span>&nbsp;<span
                  class="nav-a-text"> Головна</span></a></li>
         <li><a href="messages.php"><span class="i-wrap"><i class="far fa-envelope-open"></i></span>&nbsp;
               <span class="nav-a-text">
                  Повідомлення
                  <?php
                  $messagesQuantity = Message::countItems();
                  echo $messagesQuantity ? "<span class='label label-danger badge-pill'>$messagesQuantity</span>" : '';
                  ?>
               </span>
            </a>
         </li>
         <li><a href="reviews.php">
               <span class="i-wrap">
                  <i class="far fa-comment"></i>
               </span>
               <span class="nav-a-text">&nbsp;
                  Відгуки
                  <?php
                  $reviewsQuantity = Review::countUnapproved();
                  echo $reviewsQuantity ? "<span class='label label-danger badge-pill'>$reviewsQuantity</span>" : '';
                  ?>
               </span>
            </a>
         </li>

         <li class="dropdown">
            <a href="javascript:;" click="event.preventDefault();" class="drop-toggle">
               <span class="i-wrap">
                  <i class="fas fa-notes-medical"></i>
               </span>
               <span class="nav-a-text">&nbsp; Категорії &nbsp;&nbsp;</span>
               <i class="fas fa-angle-right"></i>
            </a>
            <ul class="sidebar_submenu">
               <li><a href="categories.php?route=view_all_categories"><span class="i-wrap"><i class="fas fa-eye"></i></span><span class="nav-a-text"></span>
                     Переглянути </a></li>
               <li><a href="categories.php?route=add_category"><span class="i-wrap"><i class="fas fa-plus"></i></span><span class="nav-a-text"></span>
                     Додати </a></li>
            </ul>
         </li>

         <li><a href="services.php"><span class="i-wrap">
                  <i class="fas fa-list-ul"></i>
               </span>&nbsp;
               <span class="nav-a-text"> Послуги</span>
            </a>
         </li>

         <li class="dropdown">
            <a href="javascript:;" click="event.preventDefault();" class="drop-toggle"><span class="i-wrap"><i
                     class="fas fa-file-alt"></i></span><span class="nav-a-text">&nbsp; Новини &nbsp;&nbsp;</span><i
                  class="fas fa-angle-right"></i></a>
            <ul class="sidebar_submenu">
               <li><a href="news.php?route=view_all_news"><span class="i-wrap"><i class="fas fa-eye"></i></span><span
                        class="nav-a-text"> Переглянути </span></a></li>
               <li><a href="news.php?route=add_news"><span class="i-wrap"><i class="fas fa-plus"></i></span><span
                        class="nav-a-text"> Додати </span></a></li>
            </ul>
         </li>
         <li class="dropdown">
            <a href="javascript:;" click="event.preventDefault();" class="drop-toggle"><span class="i-wrap">
                  <i class="far fa-newspaper"></i></span><span class="nav-a-text">&nbsp; Публікації &nbsp;&nbsp;</span><i
                  class="fas fa-angle-right"></i></a>
            <ul class="sidebar_submenu">
               <li><a href="publications.php?route=view_all_publications"><span class="i-wrap"><i class="fas fa-eye"></i></span><span
                        class="nav-a-text"> Переглянути </span></a></li>
               <li><a href="publications.php?route=add_publication"><span class="i-wrap"><i class="fas fa-plus"></i></span><span
                        class="nav-a-text"> Додати </span></a></li>
            </ul>
         </li>
      </ul>
   </div>
</aside>