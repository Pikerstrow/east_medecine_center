<?php
use Clinic\Classes\Service;
use Clinic\Classes\Category;
use Clinic\Classes\Form;
use Clinic\Classes\Image;

if($request->has('edit_service')){
   $service_id = $request->getStringParam('service_id', true, true);
   $token = $request->getStringParam('token', true);

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      $service = Service::getByParam('service_id', $service_id);

      if ($request->has('edit_service_confirmed')) {

         $form = new Form($request, 'post');

         /*Checking for title image changing and setting form attributes according to result of checking*/
         if($request->has('image')){
            $requestImage = $request->getArrayParam('image');
         }

         if (isset($requestImage) and $requestImage['name'] == '' or empty($requestImage['name'])) {
            $form->setAttributes([
               "title" => ['maxlength' => 50, 'minlenght' => 3],
               "price"  => [],
               "category_id" => [],
            ]);
         } else {
            $form->setAttributes([
               "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 1024, 'height' => 1024], 'preview' => true],
               "title" => ['maxlength' => 50, 'minlenght' => 3],
               "category_id" => [],
               "price"  => []
            ]);
         }

         $form->validate();

         if ($form->hasErrors()) {
            $errors = $form->getErrors();
            $data = $form->getData();
            $errorMessage = "Форма редагування послуги містить помилки";
         } else {
            $data = $form->getData();

            /*If title photo was changed*/
            if (array_key_exists('image', $data)) {
               $previewPhoto = new Image('services_title', $data['image']);
               $previewPhoto->setSrc('admin_panel/images/services_title');

               if ($previewPhoto->save()) {
                  $data['image'] = $previewPhoto->getSrc();

                  if ($service->update($data, 'service_id', $service->service_id)) {
                     $oldPhoto = $service->getTitleImage();
                     Image::delete($oldPhoto[0]);
                     $sessionSuccessMessage = "Послугу відредаговано.";
                     $session->add('successActionMassage', $sessionSuccessMessage);
                     unset($data);
                     redirect('services.php');
                     exit;
                  } else {
                     $errorMessage = "Послугу не відредаговано, а саме - помилка збереження інформації в базі даних.";
                  }
               } else {
                  $errorMessage = "Послугу не відредаговано, а саме - помилка збереження нового головного зображення послуги.";
               }
            } else {
               /*If title photo wasn't changed*/
               if ($service->update($data, 'service_id', $service->service_id)) {
                  $sessionSuccessMessage = "Послугу відредаговано.";
                  $session->add('successActionMassage', $sessionSuccessMessage);
                  unset($data);
                  redirect('services.php');
                  exit;
               } else {
                  $errorMessage = "Новину не відредаговано, а саме - помилка збереження відредагованої новини в базі даних.";
               }
            }
         }
      }
   }
}

?>

<h4>Редагування послуги</h4>

<?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
<?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>

<form action="" method="post" class="category-form" enctype="multipart/form-data">

   <div class="form-group">
      <label>Назва </label>
      <?php echo isset($errors['title']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['title'] . '</span>' : '' ?>
      <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-file-medical"></i>
                              </span>
         <input type="text" name="title" id="title"
                class="form-control input-admin input-category"
                required="required" placeholder="Введіть назву" value="<?php echo isset($service->service_title) ? $service->service_title : '' ?>">
      </div>
   </div>


   <div class="form-group ">
      <label>Категорія</label>
      <?php echo isset($errors['category_id']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['category_id'] . '</span>' : '' ?>
      <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-file-medical"></i>
                              </span>
         <select class="form-control input-admin input-category" name="category_id" id="category_id" required="required">
            <option value=''>Виберіть категорію</option>
            <?php
            if (isset($service->service_category_id)) {
               Category::getAllForOptions($service->service_category_id);
            } else {
               Category::getAllForOptions();
            }
            ?>
         </select>
      </div>
   </div>

   <div class="current_photo_container">
      <label>Поточне головне фото </label>
      <br>
      <img width="250" src="<?php echo isset($service->service_image) ? $service->service_image : '' ?>" style="margin-bottom: 15px;">
   </div>

   <div class="form-group">
      <label>Вибрати інше головне зображення </label>
      <?php echo isset($errors['image']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['image'] . '</span>' : '' ?>
      <div class="input-group">
                              <span class="input-group-addon addon-admin">
                                 <i class="far fa-image"></i>
                              </span>
         <input type="file" name="image" id="category_image"
                class="form-control input-admin">
      </div>
   </div>

   <div class="form-group">
      <label>Ціна, грн </label>
      <?php echo((isset($errors['price'])) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['price'] . '</span>' : '') ?>
      <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-dollar-sign"></i>
                              </span>
         <input type="text" name="price" id="price"
                class="form-control input-admin input-category"
                required="required" placeholder="Введіть ціну" value="<?php echo isset($service->service_price) ? $service->service_price : '' ?>">
      </div>
      <small><b>Примітка:</b> використання пробільних символів не допускається. Якщо ціна зазначається із копійками, то розділовим знаком повинна бути крапка.
         Наприклад, 1250.50
      </small>
   </div>

   <div class="form-group">
      <button type="submit" class="form-control admin-sumb-button" name="edit_service_confirmed">Редагувати</button>
   </div>
   <hr>
</form>