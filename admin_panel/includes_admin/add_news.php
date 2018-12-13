
<?php
use Clinic\Classes\Form;
use Clinic\Classes\Image;
use Clinic\Classes\News;


if($request->has('add_news')){

   $form = new Form($request, 'post');
   $form->setAttributes([
      "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 700, 'height' => 400], 'preview' => true],
      "title" => ['maxlength' => 150, 'minlength' => 5],
      "body"  => ['minlength' => 15],
   ]);

   $form->validate();

   if($form->hasErrors()) {
      $errors = $form->getErrors();
      $data = $form->getData();
      $errorMessage = "Форма створення новини містить помилки";
   } else {
      $data = $form->getData();
      $previewPhoto = new Image('news_title', $data['image']);
      $previewPhoto->setSrc('admin_panel/images/news_title');

      if($previewPhoto->save()){
         $news = new News();
         $data['image'] = $previewPhoto->getSrc();

         if($news->create($data)){
            $successMessage = "Новину створено.";
            unset($data);
         } else {
            $errorMessage = "Новину не створено, а саме - помилка збереження новини в базі даних.";
         }
      } else{
         $errorMessage = "Новину не створено, а саме - помилка збереження головного фото новини.";
      }

   }

}


?>



<div class="col-12">
   <h2 class="h2-panel">
      Додати новину
   </h2>
   <hr>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">
         <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
         <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>

         <form action="" method="post" role="form" id="add_news" enctype="multipart/form-data">

            <div class="form-group">
               <label>Заголовок </label>
               <?php echo isset($errors['title']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['title'] . '</span>' : '' ?>
               <div class="input-group" style="width:100%">
                  <input type="text" class="form-control input-admin" name="title"
                      placeholder="Заголовок новини" value="<?php echo (isset($data['title']) ? $data['title'] : '') ?>">
               </div>
            </div>

            <div class="form-group">
               <label>Головне фото </label>
               <?php echo isset($errors['image']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['image'] . '</span>' : '' ?>
               <div class="input-group">
                  <span class="input-group-addon addon-admin">
                     <i class="far fa-image"></i>
                  </span>
                  <input type="file" name="image" id="news_photo"
                         class="form-control input-admin">
               </div>
            </div>

            <div class="form-group">
               <label>Текст </label>
               <?php echo isset($errors['body']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['body'] . '</span>' : '' ?>
               <textarea id="add_news_textarea" name="body"><?php echo (isset($data['body']) ? $data['body'] : '') ?></textarea>
            </div>

            <div class="form-group">
               <button type="submit" class="form-control admin-sumb-button" name="add_news">Опублікувати</button>
            </div>
         </form>

      </div>
   </div>
