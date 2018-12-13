<?php require_once("includes_admin/admin_header.php"); ?>
    <!-- Header Nav -->
    <?php require_once("includes_admin/admin_header_nav.php"); ?>
    <!-- End of header -->
    <!-- Sidebar Nav -->
    <?php require_once("includes_admin/admin_sidebar_nav.php"); ?>
    <!-- End of sidebar Nav -->
    <!-- Main Content -->
<!-- Main Content -->
<?php
use Clinic\Classes\Message;
use Clinic\Classes\Review;
use Clinic\Classes\Category;
use Clinic\Classes\Service;
?>

<section id="main-content">
   <div class="content">
      <div class="row" >
         <div class="col-lg-12">
            <h2 class="admin-welcome-h2">
               Вітаємо в панелі адміністратора, <span> <?php echo $admin->admin_login; ?>!</span>
            </h2>
            <hr>
         </div>
      </div>

      <!--      First row       -->
      <div class="row" style="margin-top:15px">
         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="panel panel-red">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-3 info-panel">
                        <i class="fas fa-comment fa-4x"></i>
                     </div>
                     <div class="col-xs-9 text-right info-panel">
                        <div class="huge"><?php echo Review::countUnapproved()  ?></div>
                        <div>Відгуків</Відгуків></div>
                     </div>
                  </div>
               </div>
               <a href="reviews.php">
                  <div class="panel-footer">
                     <span class="pull-left">До відгуків</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                  </div>
               </a>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="panel panel-yellow">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-3 info-panel">
                        <i class="far fa-envelope fa-4x"></i>
                     </div>
                     <div class="col-xs-9 text-right info-panel">
                        <div class="huge"><?php echo Message::countItems() ?></div>
                        <div>Повідомлень</div>
                     </div>
                  </div>
               </div>
               <a href="messages.php">
                  <div class="panel-footer">
                     <span class="pull-left">До повідомлень</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                  </div>
               </a>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="panel panel-lightgreen">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-3 info-panel">
                        <i class="fas fa-notes-medical fa-4x"></i>
                     </div>
                     <div class="col-xs-9 text-right info-panel">
                        <div class="huge"><?php echo Category::countItems() ?></div>
                        <div>Категорій</div>
                     </div>
                  </div>
               </div>
               <a href="categories.php">
                  <div class="panel-footer">
                     <span class="pull-left">До категорій</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                  </div>
               </a>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="panel panel-lightblue">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-4 info-panel">
                        <i class="fas fa-list-ul fa-4x"></i>
                     </div>
                     <div class="col-xs-8 text-right info-panel">
                        <div class="huge"><?php echo Service::countItems() ?></div>
                        <div>Послуг</div>
                     </div>
                  </div>
               </div>
               <a href="services.php">
                  <div class="panel-footer">
                     <span class="pull-left">До послуг</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                  </div>
               </a>
            </div>
         </div>
      </div>
      <!--      First row       -->
      <!--      Second row       -->
      <div class="row" style="margin-top:50px;  padding-right: 15px;">
         <div class="col-xs-12 col-md-6 col-lg-4" id="add-buttons-admin">
            <div class="row">

               <div class="col-xs-12 add-admin-button-container">
                  <a href="news.php?route=add_news">
                     <div class="add-admin-button">
                        <span class="pull-left">
                           <i class="fas fa-file-alt fa-8x admin-add-button-i"></i>
                           <i class="fas fa-plus fa-2x admin-add-button-i-second"></i>
                        </span>
                        <span class="pull-right add-admin-button-title">
                           новина
                        </span>
                     </div>
                  </a>
               </div>

               <div class="col-xs-12 add-admin-button-container">
                  <a href="publications.php?route=add_publication">
                     <div class="add-admin-button">
                        <span class="pull-left">
                           <i class="far fa-newspaper fa-8x admin-add-button-i add-adm-i-three"></i>
                           <i class="fas fa-plus fa-2x admin-add-button-i-second"></i>
                        </span>
                        <span class="pull-right add-admin-button-title">
                           публікація
                        </span>
                     </div>
                  </a>
               </div>

               <div class="col-xs-12 add-admin-button-container">
                  <a href="services.php">
                     <div class="add-admin-button">
                        <span class="pull-left">
                           <i class="fas fa-list-ul fa-8x admin-add-button-i add-adm-i-three"></i>
                           <i class="fas fa-plus fa-2x admin-add-button-i-second"></i>
                        </span>
                        <span class="pull-right add-admin-button-title">
                           послуга
                        </span>
                     </div>
                  </a>
               </div>

               <div class="col-xs-12 add-admin-button-container">
                  <a href="categories.php?route=add_category">
                     <div class="add-admin-button">
                        <span class="pull-left">
                           <i class="fas fa-notes-medical fa-8x admin-add-button-i" ></i>
                           <i class="fas fa-plus fa-2x admin-add-button-i-second"></i>
                        </span>
                        <span class="pull-right add-admin-button-title">
                           категорія
                        </span>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <?php if(count(Service::getAll()) > 0): ?>
         <div class="col-xs-12 col-md-6 col-lg-8">
            <script type="text/javascript">
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Категорія', 'Послуги'],

                       <?php
                       $query = "SELECT categories.category_title, COUNT(*) AS count FROM `services` ";
                       $query .= "LEFT JOIN categories ON service_category_id = category_id GROUP BY category_id";
                       $categories = Category::selectByQuery($query);

                       foreach($categories as $item){
                          echo "['" . $item['category_title'] . "', " . $item['count'] . "],";
                       }
                       ?>
                    ]);

                    var options = {
                        chart: {
                            title: 'Кількість послуг в розрізі категорій'
                        },
                        backgroundColor: 'whitesmoke',
                        titleTextStyle: {
                           fontSize: 22,
                        },
                        bars: 'horizontal',
                        vAxis: {format: 'decimal'},
                    };

                    var chart = new google.charts.Bar(document.getElementById('chart_div'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="chart_div"></div>
         </div>
         <?php else: ?>
            <div class="col-xs-12 col-md-6 col-lg-8 no-services text-center">
               <h2>Кількість послуг в розрізі категорій</h2>
               <i class="far fa-frown fa-10x" style="margin-top: 30px; margin-bottom: 30px"></i>
               <div class="col-xs-12">
                  <span style="font-size:16px">Послуги відсутні. Інформація буде доступною після створення хоча б однієї послуги.</span>
               </div>
            </div>
         <?php endif; ?>
      </div>
   </div>


</section>
    <!-- End of Main Content section -->
<?php require_once("includes_admin/admin_footer.php"); ?>
