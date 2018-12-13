<?php

use Clinic\Classes\Form;
use Clinic\Classes\Image;
use Clinic\Classes\Publication;


if ($request->has('edit_publication')) {

   $publication_id = $request->getStringParam('publication_id', true, true);
   $token = $request->getStringParam('token', true);

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {

      $publication = Publication::getByParam('publication_id', $publication_id);

      if ($request->has('edit_publication_confirmed')) {

         $form = new Form($request, 'post');

         /*Checking for title image changing and setting form attributes according to result of checking*/
         if($request->has('image')){
            $requestImage = $request->getArrayParam('image');
         }

         if (isset($requestImage) and $requestImage['name'] == '' or empty($requestImage['name'])) {
            $form->setAttributes([
               "title" => ['maxlength' => 150, 'minlenght' => 5],
               "body" => ['minlength' => 15],
            ]);
         } else {
            $form->setAttributes([
               "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 700, 'height' => 400], 'preview' => true],
               "title" => ['maxlength' => 150, 'minlenght' => 5],
               "body" => ['minlength' => 15],
            ]);
         }

         $form->validate();

         if ($form->hasErrors()) {
            $errors = $form->getErrors();
            $data = $form->getData();
            $errorMessage = "Форма редагування публікації містить помилки";
         } else {
            $data = $form->getData();

            /*If title photo was changed*/
            if (array_key_exists('image', $data)) {
               $previewPhoto = new Image('publications_title', $data['image']);
               $previewPhoto->setSrc('admin_panel/images/publications_title');

               if ($previewPhoto->save()) {
                  $data['image'] = $previewPhoto->getSrc();

                  if ($publication->update($data, 'publication_id', $publication->publication_id)) {
                     $successMessage = "Публікацію відредаговано.";
                     $oldPhoto = $publication->getTitleImage();
                     Image::delete($oldPhoto[0]);
                     unset($data);
                     $publication = Publication::getByParam('publication_id', $publication_id);
                  } else {
                     $errorMessage = "Публікацію не відредаговано, а саме - помилка збереження відредагованої публікації в базі даних.";
                  }
               } else {
                  $errorMessage = "Публікацію не відредаговано, а саме - помилка збереження нового головного фото публікації.";
               }
            } else {
               /*If title photo wasn't changed*/
               if ($publication->update($data, 'publication_id', $publication->publication_id)) {
                  $successMessage = "Публікацію відредаговано. Нижче у формі Вже відображується поточна редакція публікації";
                  unset($data);
                  $publication = Publication::getByParam('publication_id', $publication_id);
               } else {
                  $errorMessage = "Публікацію не відредаговано, а саме - помилка збереження відредагованої публікації в базі даних.";
               }
            }
         }
      }
   }
}


?>


<div class="col-12">
   <h2 class="h2-panel">
      Редагування публікації
   </h2>
   <hr>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">
         <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
         <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>

         <form action="" method="post" role="form" id="add_news" enctype="multipart/form-data">

            <div class="form-group">
               <label>Заголовок </label>
               <?php echo '<br><span>' . ((isset($errors['title'])) ? '<span class="error-span"><b>Помилка: </b>' . $errors['title'] . '</span></span>' : '') ?>
               <div class="input-group" style="width:100%">
                  <input type="text" class="form-control input-admin" name="title"
                         value='<?php echo isset($publication->publication_title) ? $publication->publication_title : '' ?>'>
               </div>
            </div>

            <div class="current_photo_container">
               <label>Поточне головне фото </label>
               <br>
               <img width="450" src="<?php echo $publication->publication_image; ?>" style="margin-bottom: 15px;">
            </div>
            <div class="form-group">
               <label>Вибрати інше головне фото </label>
               <?php echo '<br><span>' . ((isset($errors['image'])) ? '<span class="error-span"><b>Помилка: </b>' . $errors['image'] . '</span></span>' : '') ?>
               <div class="input-group">
                  <span class="input-group-addon addon-admin">
                     <i class="far fa-image"></i>
                  </span>
                  <input type="file" name="image"
                         class="form-control input-admin">
               </div>
            </div>

            <div class="form-group">
               <label>Текст </label>
               <?php echo isset($errors['body']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['body'] . '</span>' : '' ?>
               <textarea id="add_news_textarea" name="body"><?php echo isset($publication->publication_body) ? $publication->publication_body : '' ?></textarea>
            </div>

            <div class="form-group">
               <button type="submit" class="form-control admin-sumb-button" name="edit_publication_confirmed">Редагувати</button>
            </div>
         </form>

      </div>
   </div>
