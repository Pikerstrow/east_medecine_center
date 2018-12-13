<?php
require_once("includes/head.php");

use Clinic\Classes\Mailer;
use Clinic\Classes\ForgotPassword;
use Clinic\Classes\Visitors\Admin;
use Clinic\Classes\Exceptions\MailException;
use Clinic\Classes\Log;


if(!$request->has('forgot')){
   redirect('index.php');
}

if($request->has('forgot_submit')){
   $forgot = new ForgotPassword();
   $email = $request->getStringParam('email', true);
   $admin = Admin::getByParam("admin_email", $email);

   if(!$admin){
      $errorEmail = "Вказана email адреса не зареєстрована в системі!";
   } else {
      $token = $forgot->getToken();

      if ($admin->update(['token' => $token], 'admin_id', $admin->admin_id, true)){
         $mail = new Mailer();
         $mail->setRecipient($admin->admin_email);
         $mail->setSubject("Відновелння паролю для досутупу до ресурсу");
         $message = forgot_mail_body($admin->admin_email, $token);

         $mail->setMessage($message);

         try{
            $mail->send();
            $successMessage = "Подальші інструкції для відновлення паролю відправлені на Вашу email адресу.";
         } catch(MailException $e){
            $errorMessage = "Помилка! Повідомлення не відправлене. У випадку повторення даної помилки - повідомте розробників ресурсу";
            Log::addError($e);
         }
      } else {
         $errorMessage = "Помилка з'єднання із базою даних! Спробуйте будь ласка ще раз.";
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
                     <h2 class="h2-login">Забули пароль?</h2>
                     <p class="small small-login">Ви можете відновити його на даній сторінці.</p>
                  </div>
                  <form id="forgot" action="" method="post">
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text">
                                 @
                              </span>
                           </div>
                           <input type="email" name="email"
                                  class="form-control <?php echo isset($errorEmail) ? 'is-invalid' : ''; ?>" id="email"
                                  placeholder="Введіть Вашу Email адресу" required="required">
                           <?php if (isset($errorEmail)): ?>
                              <div class="invalid-feedback">
                                 <i class="far fa-frown"></i> <?php echo $errorEmail; ?>
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>
                     <p class="small text-justify"><b>Важливо!</b> Введена email адреса повинна співпадати із
                        зареєстрованою в системі! </p>
                     <button type="submit" name="forgot_submit" class="btn btn-primary col-12">Далі</button>

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
                     <h2 class="h2-login">Супер!!!</h2>
                     <p class="small small-login"><?php echo $successMessage; ?></p>
                  </div>
                  <p>
                     <a href="index.php" class="btn btn-primary col-12">Повернутися на головну сторінку</a>
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
