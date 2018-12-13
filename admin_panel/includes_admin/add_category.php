
<?php
use Clinic\Classes\Form;
use Clinic\Classes\Image;
use Clinic\Classes\Category;

/*CREATE CATEGORY*/
if ($request->has('add_category')) {

   $form = new Form($request, 'post');

   /*Checking for image and setting form attributes according to result of checking*/
   if($request->has('image')){
      $imgFromRequest = $request->getArrayParam('image');
   }

   if (isset($imgFromRequest) and $imgFromRequest['name'] != '' and !empty($imgFromRequest['name'])) {
      $form->setAttributes([
         "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 1024, 'height' => 1024], 'preview' => true],
         "title" => ['maxlength' => 50, 'minlength' => 3],
         "body"  => ['minlength' => 15]
      ]);
      $form->validate();

      if ($form->hasErrors()) {
         $errors = $form->getErrors();
         $data = $form->getData();
         $addErrorMessage = "Форма створення категорії містить помилки";

      } else {
         $data = $form->getData();
         $categoryImage = new Image('categories_title', $data['image']);
         $categoryImage->setSrc('admin_panel/images/categories_title');

         if ($categoryImage->save()) {
            $category = new Category();
            $data['image'] = $categoryImage->getSrc();

            if ($category->create($data)) {
               $addSuccessMessage = "Нову категорію створено.";
               $request->unsetParam('image');
               unset($data);
            } else {
               $addErrorMessage = "Категорію не створено, а саме - помилка збереження категорії в базі даних.";
            }
         } else {
            $addErrorMessage = "Категорію не створено, а саме - помилка збереження зображення категорії.";
         }
      }
   } else {
      $form->setAttributes([
         "title" => ['maxlength' => 50, 'minlenght' => 3],
         "body"  => ['minlength' => 15]
      ]);
      $form->validate();

      if ($form->hasErrors()) {
         $data = $form->getData();
         $errors = $form->getErrors();
         $addErrorMessage = "Форма створення категорії містить помилки";
      } else {
         $data = $form->getData();
         $data['image'] = SITE_URL . "/admin_panel/images/categories_title/service_has_no_photo.jpg";

         $category = new Category();

         if ($category->create($data)) {
            $addSuccessMessage = "Категорію створено.";
            unset($data);
         } else {
            $addErrorMessage = "Категорію не створено, а саме - помилка збереження категорії в базі даних.";
         }
      }
   }
}

?>



<div class="col-12">
   <h2 class="h2-panel">
      Додати категорію
   </h2>
   <hr>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">
         <?php echo isset($addErrorMessage) ? showInfoBlock($addErrorMessage, 'danger') : '' ?>
         <?php echo isset($addSuccessMessage) ? showInfoBlock($addSuccessMessage, 'success') : '' ?>

         <form action="" method="post" class="category-form" enctype="multipart/form-data">

            <div class="form-group">
               <label>Назва </label>
               <?php echo((isset($errors['title'])) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['title'] . '</span>' : '') ?>
               <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-file-medical"></i>
                              </span>
                  <input type="text" name="title" id="title"
                         class="form-control input-admin input-category"
                         required="required" placeholder="Введіть назву" value="<?php echo isset($data['title']) ? $data['title'] : '' ?>">
               </div>
            </div>

            <div class="form-group">
               <label>Головне зображення </label>
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
               <textarea id="add_category_textarea" name="body"><?php echo isset($data['body']) ? $data['body'] : '' ?></textarea>
            </div>

            <div class="form-group">
               <button type="submit" class="form-control admin-sumb-button" name="add_category">Додати
                  категорію
               </button>
            </div>
            <hr>
         </form>

      </div>
   </div>
