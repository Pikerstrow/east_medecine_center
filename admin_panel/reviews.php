<?php require_once("includes_admin/admin_header.php"); ?>


<?php
use Clinic\Classes\Review;

/*Delete reviews section*/
if ($request->has(['delete_review', 'token'])) {

   $review_id = $request->getStringParam('delete_review', true);
   $token = $request->getStringParam('token', true);

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      if(Review::delete('review_id', $review_id)){
         $successMessage = 'Відгук видалено!';
         $request->unsetParam(['delete_review', 'token']);
      } else {
         $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
      }
   }
}

/*Approve reviews section*/
if ($request->has(['approve_review', 'token'])) {

   $review_id = $request->getStringParam('approve_review');
   $token = $request->getStringParam('token');

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      if(Review::approve($review_id)){
         $successMessage = 'Відгук затверджено! Тепер він відображається на сайті.';
         $request->unsetParam(['approve_review', 'token']);
      } else {
         $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
      }
   }
}


$reviews = Review::getAll();

require_once("includes_admin/admin_header_nav.php");
require_once("includes_admin/admin_sidebar_nav.php");
?>


<section id="main-content">
   <div class="content">
      <div class="row">
         <div class="col-12">
            <h2 class="h2-panel">
               Відгуки пацієнтів
            </h2>
            <hr>


            <div class="row">
               <div class="col-12">
                  <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>
                  <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
                  <div class="table-responsive">
                     <table class="table table-bordered table-admin">
                        <thead>
                        <tr>
                           <th>№</th>
                           <th>Автор</th>
                           <th>Email</th>
                           <th>Відгук</th>
                           <th>Дата</th>
                           <th>Статус</th>
                           <th style="text-align: center" colspan="2">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($reviews) > 0): ?>
                           <?php foreach ($reviews as $review): ?>
                              <tr>
                                 <td style="max-width:60px;"><?php echo $review->review_id ?></td>
                                 <td><?php echo $review->review_name ?></td>
                                 <td><?php echo $review->review_email ?></td>
                                 <td style="max-width:350px;"><?php echo $review->review_text ?></td>
                                 <td style="min-width: 90px;">
                                    <?php
                                    $date = new DateTime($review->review_date);
                                    echo $date->format('d-m-Y');
                                    ?>
                                 </td>
                                 <td>
                                    <?php
                                       if($review->review_status == 1){
                                          echo "<span style='color:darkgreen'>Опублікований</span>";
                                       } else {
                                          echo "<span style='color:darkred'>На модерації</span>";
                                       }
                                    ?>
                                 </td>
                                 <td class="text-center" style="max-width:60px;">
                                    <a href="reviews.php?approve_review=<?php echo $review->review_id; ?>&token=<?php echo $session->getId(); ?>"
                                       class="btn btn-xs btn-success" title="Опублікувати">
                                       <i class="far fa-thumbs-up"></i>
                                    </a>
                                 </td>
                                 <td class="text-center" style="max-width:60px;">
                                    <a href="reviews.php?delete_review=<?php echo $review->review_id; ?>&token=<?php echo $session->getId(); ?>"
                                       class="btn btn-xs btn-danger" title="Видалити">
                                       <i class="far fa-trash-alt"></i>
                                    </a>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        <?php else: ?>
                           <tr>
                              <td colspan="7" class="text-center">
                                 На даний момент жоден із Ваших клієнтів не залишив відгук.
                              </td>
                           </tr>
                        <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>



         </div>
      </div>
   </div>
</section>





<!-- End of Main Content section -->
<?php
require_once("includes_admin/admin_footer.php");
?>
