<?php


use Clinic\Classes\Category;
use Clinic\Classes\Image;

/*DELETE CATEGORY*/
if ($request->has(['delete_category', 'token'])) {

   $category_id = $request->getStringParam('delete_category', true, true);
   $token       = $request->getStringParam('token');

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      $category = Category::getByParam('category_id', $category_id);

      if ($category->unlinkImages()) {
         if (Category::delete('category_id', $category_id)) {
            $successMessage = "Категорію №" . $category->category_id . " видалено.";
            $request->unsetParam(['delete_category', 'token']);
         } else {
            $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
         }
      } else {
         $errorMessage = 'Сталася помилка видалення даних: не були видалені зображення категорії! Спробуйте, будь ласка, ще раз.';
      }
   }
}

$categories = Category::getAll();

?>


<div class="col-12">
   <h2 class="h2-panel">
      Існуючі категорії
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
                  <th>Назва</th>
                  <th>Опис</th>
                  <th style="text-align: center; width:80px;" colspan="2">Дії</th>
               </tr>
               </thead>
               <tbody>
               <?php if (count($categories) > 0): ?>
                  <?php foreach ($categories as $category): ?>
                     <tr>
                        <td style="width:50px;"><?php echo $category->category_id ?></td>
                        <td style="width:90px;"><img width="90" src="<?php echo $category->category_image ?>"></td>
                        <td><?php echo $category->category_title ?></td>
                        <td>
                           <?php
                           $quantity = mb_strpos($category->category_body, "</p>");
                           if ($quantity > 150) {
                              $quantity = 150;
                           } else {
                              $quantity = 150;
                           }
                           echo str_replace(mb_substr($category->category_body, $quantity), ' ... ', $category->category_body);
                           ?>
                        </td>
                        <td class="text-center" style="width:40px;">
                           <a href="categories.php?route=edit_category&category_id=<?php echo $category->category_id; ?>&token=<?php echo $session->getId(); ?>&edit_category=true"
                              class="btn btn-sm btn-warning" title="Редагувати">
                              <i class="far fa-edit fa-lg"></i>
                           </a>
                        </td>
                        <td class="text-center" style="width:40px;">
                           <a href="categories.php?delete_category=<?php echo $category->category_id; ?>&token=<?php echo $session->getId(); ?>"
                              class="btn btn-sm btn-danger" title="Видалити">
                              <i class="far fa-trash-alt fa-lg"></i>
                           </a>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="7" class="text-center">
                        На даний момент категорії відсутні.
                     </td>
                  </tr>
               <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
