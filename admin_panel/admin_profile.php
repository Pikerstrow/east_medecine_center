<?php require_once("includes_admin/admin_header.php"); ?>
<!-- Header Nav -->
<?php require_once("includes_admin/admin_header_nav.php"); ?>
<!-- End of header -->
<!-- Sidebar Nav -->
<?php require_once("includes_admin/admin_sidebar_nav.php"); ?>
<!-- End of sidebar Nav -->
<!-- Main Content -->

<?php

use Clinic\Classes\Visitors\Admin;
use Clinic\Classes\Form;
use Clinic\Classes\Image;

/*Admin current data retrieved from db in admin_header.php*/

if($request->has('edit_profile_confirmed')){
   $form = new Form($request, 'post');

   /*Checking for title image changing and setting form attributes according to result of checking*/
   if($request->has('image')){
      $requestImage = $request->getArrayParam('image');
   }

   if (isset($requestImage) and $requestImage['name'] != '' and !empty($requestImage['name'])) {
      $form->setAttributes([
         "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 500, 'height' => 500], 'preview' => true],
         "login" => ['maxlength' => 15, 'minlength' => 5],
         "email"  => []
      ]);
   } else {
      $form->setAttributes([
         "login" => ['maxlength' => 15, 'minlength' => 5],
         "email"  => []
      ]);
   }

   $form->validate();

   if ($form->hasErrors()) {
      $errors           = $form->getErrors();
      $data             = $form->getData();
      $errorMessage = "Форма містить помилки";
   } else {
      $data = $form->getData();

      /*If title image was changed*/
      if (array_key_exists('image', $data)) {

         $adminImage = new Image('admin_avatar', $data['image']);
         $adminImage->setSrc('admin_panel/images/admin_avatar');

         if ($adminImage->save()) {
            $data['image'] = $adminImage->getSrc();

            if ($admin->update($data, 'admin_id', $admin->admin_id)) {

               /*deleting previous image*/
               if($oldPhoto = $admin->getAvatar()){
                  Image::delete($oldPhoto);
               }
               /*Set success alert massage into current session*/
               $sessionSuccessMessage = "Профіль відредаговано.";
               $session->add('successActionMassage', $sessionSuccessMessage);
               $session->update("admin_login", $data['login']);
               unset($data);
               redirect('admin_profile.php');
               exit;
            } else {
               $errorMessage = "Профіль не відредаговано, а саме - помилка збереження відредагованої інформації в базі даних.";
            }
         } else {
            $errorMessage = "Профіль не відредаговано, а саме - помилка збереження нового зображення аватару.";
         }
      } else {
         /*If title image wasn't changed*/
         if ($admin->update($data, 'admin_id', $admin->admin_id)) {
            $sessionSuccessMessage = "Профіль відредаговано.";
            $session->add('successActionMassage', $sessionSuccessMessage);
            $session->update("admin_login", $data['login']);
            unset($data);
            redirect('admin_profile.php');
            exit;
         } else {
            $errorMessage = "Профіль не відредаговано, а саме - помилка збереження відредагованої інформації в базі даних.";
         }
      }
   }
}



?>

<section id="main-content">
   <div class="content">
      <div class="row">
         <div class="col-lg-12">
            <h2 class="h2-panel">
               <span>Особисті дані</span>
            </h2>
            <hr>
            <?php if(!$request->has('edit_profile')){ ?>
               <div class="row">
                  <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                     <!-- Begin user profile -->
                     <?php
                     if($session->check('successSessionMassage')){

                        $massage = $session->get('successSessionMassage');
                        echo showInfoBlock($massage, 'success');
                        $session->remove('successSessionMassage');
                     }
                     ?>
                     <div class="box-info text-center user-profile-2">
                        <div class="header-cover">
                        </div>
                        <div class="user-profile-inner">
                           <h4 class="white"><?php echo isset($admin->admin_login) ? $admin->admin_login : ''; ?></h4>
                           <img src="<?php echo isset($admin->admin_image) ? $admin->admin_image : ''; ?>" class="img-circle profile-avatar" alt="User avatar">
                           <hr>
                           <table class="">
                              <tr>
                                 <td class="profile-table"><b>Логін:</b></td>
                                 <td class="profile-table-td-two"><?php echo isset($admin->admin_login) ? $admin->admin_login : ''; ?></td>
                              </tr>
                              <tr>
                                 <td class="profile-table"><b>Email:</b></td>
                                 <td class="profile-table-td-two"><?php echo isset($admin->admin_email) ? $admin->admin_email : ''; ?></td>
                              </tr>
                           </table>
                           <!-- User button -->
                           <div class="user-button">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <a href="admin_profile.php?edit_profile=true&admin_login=<?php echo isset($admin->admin_login) ? $admin->admin_login : ''; ?>"
                                       class="btn btn-sm btn-block btn-profile-edit"> Редагувати профіль</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <?php } else {
               $admin_login = $request->getStringParam('admin_login', true);
               $admin = Admin::getByParam('admin_login', $admin_login);
               ?>
               <div class="row">

                  <!-- edit user data form -->
                  <div class="col-sx-12 col-md-6">
                     <h3 class="admin_profile_h3">Форма редагування особистих даних</h3>
                     <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
                     <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>

                     <form action="" method="post" role="form" id="add_news" enctype="multipart/form-data">

                        <div class="form-group">
                           <label>Логін </label>
                           <?php echo '<br><span>' . ((isset($errors['login'])) ? '<span class="error-span"><b>Помилка: </b>' . $errors['login'] . '</span></span>' : '') ?>
                           <div class="input-group" style="width:100%">
                              <input type="text" class="form-control input-admin" name="login"
                                     value='<?php echo isset($admin->admin_login) ? $admin->admin_login : '' ?>'>
                           </div>
                        </div>

                        <div class="current_photo_container">
                           <label>Поточний аватар </label>
                           <br>
                           <img width="200" src="<?php echo isset($admin->admin_image) ? $admin->admin_image : '' ?>" style="margin-bottom: 15px;">
                        </div>
                        <div class="form-group">
                           <label>Вибрати інше зображення</label>
                           <?php echo '<br><span>' . ((isset($errors['image'])) ? '<span class="error-span"><b>Помилка: </b>' . $errors['image'] . '</span></span>' : '') ?>
                           <div class="input-group">
                              <span class="input-group-addon addon-admin">
                                 <i class="far fa-image"></i>
                              </span>
                              <input type="file" name="image" class="form-control input-admin">
                           </div>
                        </div>

                        <div class="form-group">
                           <label>Email</label>
                           <?php echo isset($errors['email']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['email'] . '</span>' : '' ?>
                           <div class="input-group">
                              <span class="input-group-addon addon-admin">
                                 @
                              </span>
                              <input type="email" class="form-control input-admin" name="email"
                                     value='<?php echo isset($admin->admin_email) ? $admin->admin_email : '' ?>'>
                           </div>
                        </div>

                        <div class="form-group">
                           <button type="submit" class="form-control admin-sumb-button" name="edit_profile_confirmed">Змінити дані</button>
                        </div>
                     </form>
                  </div>
                  <!-- edit user data form -->

                  <div class="col-xs-12 col-md-6">
                     <!-- Begin user profile -->
                     <h3 class="admin_profile_h3">Поточні дані</h3>
                     <div class="box-info text-center user-profile-2">
                        <div class="header-cover">
                        </div>
                        <div class="user-profile-inner">
                           <h4 class="white"><?php echo isset($admin->admin_login) ? $admin->admin_login : '' ?></h4>
                           <img src="<?php echo isset($admin->admin_image) ? $admin->admin_image : '' ?>" class="img-circle profile-avatar" alt="Admin avatar">
                           <hr>
                           <table class="">
                              <tr>
                                 <td class="profile-table"><b>Логін:</b></td>
                                 <td class="profile-table-td-two"><?php echo isset($admin->admin_login) ? $admin->admin_login : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="profile-table"><b>Email:</b></td>
                                 <td class="profile-table-td-two"><?php echo isset($admin->admin_email) ? $admin->admin_email : '' ?></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>

            <?php } ?>
         </div>
      </div>

   </div>
</section>

<!-- End of Main Content section -->
<?php
require_once("includes_admin/admin_footer.php");
?>
