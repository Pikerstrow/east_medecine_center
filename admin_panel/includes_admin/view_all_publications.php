<?php


use Clinic\Classes\Publication;

/*Delete news section*/
if ($request->has(['delete_publication', 'token'])) {

   $publication_id = $request->getStringParam('delete_publication', true, true);
   $token = $request->getStringParam('token');

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      $publication = Publication::getByParam('publication_id', $publication_id);


      if(Publication::delete('publication_id', $publication_id)){
         if ($publication->unlinkImages()) {
            $successMessage = 'Публікацію видалено!';
            $request->unsetParam(['delete_publication', 'token']);
         } else{
            $errorMessage = 'Сталася помилка видалення даних: не були видалені зображення публікації! Спробуйте, будь ласка, ще раз.';
         }
      } else {
         $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
      }

   }
}

$publications = Publication::getAll();


?>


<div class="col-12">
   <h2 class="h2-panel">
      Опубліковані публікації
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
                  <th>Зображення</th>
                  <th>Заголовок</th>
                  <th>Текст</th>
                  <th>Дата</th>
                  <th style="text-align: center" colspan="3">Дії</th>
               </tr>
               </thead>
               <tbody>
               <?php if (count($publications) > 0): ?>
                  <?php foreach ($publications as $publication): ?>
                     <tr>
                        <td style="max-width:60px;"><?php echo $publication->publication_id ?></td>
                        <td><img width="90" src="<?php echo $publication->publication_image ?>"></td>
                        <td><?php echo $publication->publication_title ?></td>
                        <td class="admin-table-news-body">
                           <?php
                           $quantity = mb_strpos($publication->publication_body, "</p>");
                           if ($quantity > 150) {
                              $quantity = 150;
                           } else{
                              $quantity = 150;
                           }
                           echo str_replace(mb_substr($publication->publication_body, $quantity), ' ... ', $publication->publication_body);
                           ?>
                        </td>
                        <td style="min-width: 90px;">
                           <?php
                           $date = new DateTime($publication->publication_date);
                           echo $date->format('d-m-Y');
                           ?>
                        </td>
                        <td class="text-center" style="max-width:60px;">
                           <a href="../publication.php?publication_id=<?php echo $publication->publication_id; ?>"
                              class="btn btn-xs btn-primary" title="Переглянути">
                              <i class="far fa-eye"></i>
                           </a>
                        </td>
                        <td class="text-center" style="max-width:60px;">
                           <a href="publications.php?route=edit_publication&edit_publication=true&publication_id=<?php echo $publication->publication_id; ?>&token=<?php echo $session->getId(); ?>"
                              class="btn btn-xs btn-warning" title="Редагувати">
                              <i class="far fa-edit"></i>
                           </a>
                        </td>
                        <td class="text-center" style="max-width:60px;">
                           <a href="publications.php?delete_publication=<?php echo $publication->publication_id; ?>&token=<?php echo $session->getId(); ?>"
                              class="btn btn-xs btn-danger" title="Видалити">
                              <i class="far fa-trash-alt"></i>
                           </a>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="7" class="text-center">
                        Опубліковані публікації на сайті відсутні
                     </td>
                  </tr>
               <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
