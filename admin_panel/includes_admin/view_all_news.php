<?php


use Clinic\Classes\News;

/*Delete news section*/
if ($request->has(['delete_news', 'token'])) {

   $news_id = $request->getStringParam('delete_news', true, true);
   $token = $request->getStringParam('token');

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      $news = News::getByParam('news_id', $news_id);


      if(News::delete('news_id', $news_id)){
         if ($news->unlinkImages()) {
            $successMessage = 'Новину видалено!';
            $request->unsetParam(['delete_news', 'token']);
         } else{
            $errorMessage = 'Сталася помилка видалення даних: не були видалені зображення новини! Спробуйте, будь ласка, ще раз.';
         }
      } else {
         $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
      }

   }
}

$news = News::getAll();


?>


<div class="col-12">
   <h2 class="h2-panel">
      Опубліковані новини
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
               <?php if (count($news) > 0): ?>
                  <?php foreach ($news as $post): ?>
                     <tr>
                        <td style="max-width:60px;"><?php echo $post->news_id ?></td>
                        <td><img width="90" src="<?php echo $post->news_image ?>"></td>
                        <td><?php echo $post->news_title ?></td>
                        <td class="admin-table-news-body">
                           <?php
                           $quantity = mb_strpos($post->news_body, "</p>");
                           if ($quantity > 150) {
                              $quantity = 150;
                           } else {
                              $quantity = 150;
                           }
                           echo str_replace(mb_substr($post->news_body, $quantity), ' ... ', $post->news_body);
                           ?>
                        </td>
                        <td style="min-width: 90px;">
                           <?php
                           $date = new DateTime($post->news_date);
                           echo $date->format('d-m-Y');
                           ?>
                        </td>
                        <td class="text-center" style="max-width:60px;">
                           <a href="../news1.php?news_id=<?php echo $post->news_id; ?>"
                              class="btn btn-xs btn-primary" title="Переглянути">
                              <i class="far fa-eye"></i>
                           </a>
                        </td>
                        <td class="text-center" style="max-width:60px;">
                           <a href="news.php?route=edit_news&edit_news=true&news_id=<?php echo $post->news_id; ?>&token=<?php echo $session->getId(); ?>"
                              class="btn btn-xs btn-warning" title="Редагувати">
                              <i class="far fa-edit"></i>
                           </a>
                        </td>
                        <td class="text-center" style="max-width:60px;">
                           <a href="news.php?delete_news=<?php echo $post->news_id; ?>&token=<?php echo $session->getId(); ?>"
                              class="btn btn-xs btn-danger" title="Видалити">
                              <i class="far fa-trash-alt"></i>
                           </a>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="7" class="text-center">
                        Опубліковані новини на сайті відсутні
                     </td>
                  </tr>
               <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
