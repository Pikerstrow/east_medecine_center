<?php require_once("includes/head.php"); ?>

<?php
use Clinic\Classes\Visitors\Admin;

if($session->check(['admin_auth', 'admin_login'])){
   redirect('admin_panel');
}

if($request->has('admin_login')){
   $login    = $request->getStringParam('login', true);
   $password = $request->getStringParam('password', true);

   $possibleErrors = Admin::verifyAndLogin($login, $password);
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

   <div class="container" style="height:100%" >
      <div class="row justify-content-center row-container-login-form">
         <div class="col-12 col-sm-8 col-md-5 col-lg-5 align-self-center  login-form-container">
            <div class="row justify-content-center">
               <div class="col-12">
                  <img class="login-logo" src="img/Logo/logo.png" title="yao wang">
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="panel">
                     <h2 class="h2-login">Авторизуйтесь, будь ласка!</h2>
                     <p class="small small-login">Введіть Ваш логін та пароль.</p>
                  </div>
                  <form id="Login" action="" method="post">
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text">
                                 <i class="fas fa-user"></i>
                              </span>
                           </div>
                        <?php echo isset($possibleErrors['login']) ? "<span class='invalid'></span>" : ''; ?>
                        <?php echo isset($login) ? "<span class='valid'></span>" : ''; ?>
                        <input type="login" name="login" class="form-control" id="email" placeholder="Логін"
                               required="required" value="<?php echo isset($login) ? $login : ''; ?>">
                           <?php if(isset($possibleErrors['login'])): ?>
                              <div class="invalid-feedback">
                                 <i class="far fa-frown"></i> <?php echo $possibleErrors['login']; ?>
                              </div>
                           <?php else: ?>
                              <div class="valid-feedback">
                                 <i class="far fa-smile"></i> Логін вірний
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
                           <?php echo isset($possibleErrors['password']) ? "<span class='invalid'></span>" : ''; ?>
                           <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                           <?php if(isset($possibleErrors['password'])): ?>
                              <div class="invalid-feedback">
                                 <i class="far fa-frown"></i> <?php echo $possibleErrors['password']; ?>
                              </div>
                           <?php else: ?>
                              <div class="valid-feedback">
                                 <i class="far fa-smile"></i> Пароль вірний
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>

                     <div class="forgot_pass">
                        <a href="forgot.php?forgot=true">Забули пароль?</a>
                     </div>

                     <button type="submit" name="admin_login" class="btn btn-primary col-12">Увійти</button>

                  </form>
               </div>
            </div>
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
