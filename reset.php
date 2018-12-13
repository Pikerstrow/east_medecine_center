<?php
require_once("includes/head.php");

use Clinic\Classes\Visitors\Admin;
use Clinic\Classes\Form;


if(!$request->has('email') or !$request->has('token')){
   redirect('index.php');
} else {
   $data = $errors = [];

   $email = $request->getStringParam('email', true);
   $token = $request->getStringParam('token', true);

   $admin = Admin::getByParam('admin_token', $token);

   if(!$admin){
      $errorMessage = "Переданий токен не зареєстрований в системі!!!";
   } else {
      if($request->has('confirm_new_pass')){

         $form = new Form($request, 'post');
         $form->setAttributes([
            'password'=>['maxlength'=>50, 'minlength'=>6]
         ]);
         $form->validate();

         if($form->hasErrors()){
            $errors = $form->getErrors();
         } else {
            $data = $form->getData();

            if($data['password'] != $request->getStringParam('password_confirm', true)){
               $errors['password_confirm'] = "Введені паролі не співпадають!";
            } else {
               $admin->admin_password = $data['password'];

               if(!$admin->update(['token' => '', 'password' => $admin->hashPassword()], 'admin_id', $admin->admin_id, true)){
                  $errorMessage = "Помилка оновлення даних! Спробуйте будь ласка ще раз трішки пізніше.";
               } else {
                  $successMessage = "Пароль успішно оновлено!";
               }
            }
         }
      }
   }
}
?>

<body id="login_form">
<!-- PreLoader -->
<div class="preloader">
   <div class="container">
      <div class="row">
         <div class="loader">
            Yao Wang
            <span></span>
            <span></span>
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>

<div class="container" style="height:100%">
   <div class="row justify-content-center row-container-login-form">
      <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5 align-self-center  login-form-container">
         <div class="row justify-content-center">
            <div class="col-12">
               <?php if (isset($errorMessage)): ?>
                  <p class="error-span text-center">
                     <i class='far fa-frown fa-4x'></i>
                  </p>
                  <p class="text-center"><span
                        class="error-span text-center"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span>
                  </p>
               <?php endif; ?>
               <img class="login-logo" src="img/Logo/logo.png" title="yao wang">
            </div>
         </div>

         <?php if (!isset($successMessage)): ?>
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="panel">
                     <h2 class="h2-login">Відновлення паролю</h2>
                     <p class="small small-login">Введіть новий пароль та підтведіть його.</p>
                  </div>
                  <form id="forgot" action="" method="post">
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text">
                                 <i class="fas fa-key"></i>
                              </span>
                           </div>
                           <?php echo isset($errors['password']) ? "<span class='invalid'></span>" : ''; ?>
                           <?php echo isset($data['password']) ? "<span class='valid'></span>" : ''; ?>
                           <input type="password" name="password" class="form-control" id="password" placeholder="Введіть новий пароль"
                                  required="required" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>">
                           <?php if (isset($errors['password'])): ?>
                              <div class="invalid-feedback">
                                 <i class="far fa-frown"></i> <?php echo $errors['password']; ?>
                              </div>
                           <?php else: ?>
                              <div class="valid-feedback">
                                 <i class="far fa-smile"></i> Новий пароль відповідає вимогам безпеки!
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text">
                                 <i class="fas fa-key"></i>
                              </span>
                           </div>
                           <?php echo isset($errors['password_confirm']) ? "<span class='invalid'></span>" : ''; ?>
                           <input type="password" name="password_confirm" class="form-control" id="password_confirm"
                                  placeholder="Підтвердіть пароль" required="required">
                           <?php if (isset($errors['password_confirm'])): ?>
                              <div class="invalid-feedback">
                                 <i class="far fa-frown"></i> <?php echo $errors['password_confirm']; ?>
                              </div>
                           <?php endif; ?>
                        </div>
                        <div class="help-block pass-conf-help-block mt-1"></div>
                     </div>

                     <p class="small text-justify">
                        <b>Важливо!</b> Пароль повинен складатися із літер латинського алфавіту та має містити мінімум
                        одну цифру та один спецсимвол (наприклад * тощо). Мінімальна довжина паролю - 6 символів. Масимальна - 50.
                     </p>
                     <button type="submit" name="confirm_new_pass" class="btn btn-primary col-12">Готово</button>

                  </form>
               </div>
            </div>
         <?php else: ?>
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="panel text-center">
                     <p>
                        <i class="far fa-smile fa-10x"></i>
                     </p>
                     <h2 class="h2-login">Вітаємо!!!</h2>
                     <p class="small small-login"><?php echo $successMessage; ?></p>
                  </div>
                  <p>
                     <a href="login.php" class="btn btn-primary col-12">Перейти на сторінку авторизації</a>
                  </p>
               </div>
            </div>
         <?php endif; ?>

      </div>
   </div>
</div>
<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/wow.js"></script>
<script src="js/index.js"></script>
</body>
</html>
