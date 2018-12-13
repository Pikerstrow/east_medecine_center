<?php
use Clinic\Classes\Category;
use Clinic\Classes\Image;
use Clinic\Classes\Form;

if($request->has('edit_category')){
   $category_id = $request->getStringParam('category_id', true, true);
   $token       = $request->getStringParam('token', true);

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      $category = Category::getByParam('category_id', $category_id);


      if($request->has('edit_category_confirmed')){
         $form = new Form($request, 'post');

         /*Checking for title image changing and setting form attributes according to result of checking*/
         if($request->has('image')){
            $requestImage = $request->getArrayParam('image');
         }

         if (isset($requestImage) and $requestImage['name'] != '' and !empty($requestImage['name'])) {
            $form->setAttributes([
               "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 1024, 'height' => 1024], 'preview' => true],
               "title" => ['maxlength' => 50, 'minlength' => 3],
               "body"  => ['minlength' => 15]
            ]);
         } else {
            $form->setAttributes([
               "title" => ['maxlength' => 50, 'minlength' => 3],
               "body"  => ['minlength' => 15]
            ]);
         }

         $form->validate();

         if ($form->hasErrors()) {
            $errors           = $form->getErrors();
            $data             = $form->getData();
            $editErrorMessage = "Форма редагування категорії містить помилки";
         } else {
            $data = $form->getData();

            /*If title image was changed*/
            if (array_key_exists('image', $data)) {

               $categoryImage = new Image('categories_title', $data['image']);
               $categoryImage->setSrc('admin_panel/images/categories_title');

               if ($categoryImage->save()) {
                  $data['image'] = $categoryImage->getSrc();

                  if ($category->update($data, 'category_id', $category->category_id)) {

                     /*deleting previous image*/
                     if($oldPhoto = $category->getTitleImage()){
                        Image::delete($oldPhoto);
                     }
                     /*Set success alert massage into current session*/
                     $successMessage = "Категорію №" . $category->category_id . " відредаговано.";
                     unset($data);
                     $category = Category::getByParam('category_id', $category_id);
                  } else {
                     $errorMessage = "Категорію не відредаговано, а саме - помилка збереження відредагованої категорії в базі даних.";
                  }
               } else {
                  $errorMessage = "Категорію не відредаговано, а саме - помилка збереження нового головного зображення категорії.";
               }
            } else {
               /*If title image wasn't changed*/
               if ($category->update($data, 'category_id', $category->category_id)) {
                  $successMessage = "Категорію №" . $category->category_id . " відредаговано.";
                  unset($data);
                  $category = Category::getByParam('category_id', $category_id);
               } else {
                  $errorMessage = "Категорію не відредаговано, а саме - помилка збереження відредагованої категорії в базі даних.";
               }
            }
         }
      }
   }
}

?>

<div class="col-12">
   <h2 class="h2-panel">
      Редагувати категорію
   </h2>
   <hr>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">
         <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
         <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>

         <form action="" method="post" class="category-form" enctype="multipart/form-data">

            <div class="form-group">
               <label>Назва </label>
               <?php echo((isset($errors['title'])) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['title'] . '</span>' : '') ?>
               <div class="input-group" style="width:100%">
                           <span class="input-group-addon addon-admin addon-category">
                              <i class="fas fa-file-medical"></i>
                           </span>
                  <input type="text" name="title" id="title" class="form-control input-admin input-category"
                         required="required" placeholder="Введіть назву" value="<?php echo $category->category_title; ?>">
               </div>
            </div>

            <div class="current_photo_container">
               <label>Поточне головне зображення категорії </label>
               <br>
               <img width="300" class="img-responsive" src="<?php echo $category->category_image; ?>" style="margin-bottom: 15px;">
            </div>

            <div class="form-group">
               <label>Змінити головне зображення </label>
               <?php echo isset($errors['image']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['image'] . '</span>' : '' ?>
               <div class="input-group">
                           <span class="input-group-addon addon-admin">
                              <i class="far fa-image"></i>
                           </span>
                  <input type="file" name="image" id="category_image"
                         class="form-control input-admin">
               </div>
            </div>

            <div class="form-group" id="category_body_description">
               <label>Опис </label>
               <?php echo isset($errors['body']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['body'] . '</span>' : '' ?>
               <textarea id="add_category_textarea" name="body"><?php echo $category->category_body; ?></textarea>
            </div>

            <div class="form-group">
               <button type="submit" class="form-control admin-sumb-button" name="edit_category_confirmed">Редагувати
                  категорію
               </button>
            </div>
            <hr>
         </form>

      </div>
   </div>

























