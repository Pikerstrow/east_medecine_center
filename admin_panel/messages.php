<?php
require_once("includes_admin/admin_header.php");

use \Clinic\Classes\Message;
use \Clinic\Classes\Mailer;
use \Clinic\Classes\Log;
use \Clinic\Classes\Exceptions\MailException;

/*Delete message section*/
if ($request->has(['delete_message', 'token'])) {

   $message_id = $request->getStringParam('delete_message', true, true);
   $token = $request->getStringParam('token');

   if ($token != $session->getId()) {
      redirect('../login.php');
   } else {
      if(Message::delete('message_id', $message_id)){
         $successMessage = 'Повідомлення видалене!';
         $request->unsetParam(['delete_review', 'token']);
      } else {
         $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
      }
   }
}

/*Reply message section*/
if ($request->has('reply_send')) {
   $replyText = $request->getStringParam('reply_text');
   $replyEmail = $request->getStringParam('reply_email');

   $mail = new Mailer();
   $mail->setRecipient($replyEmail);
   $mail->setSubject("У відповідь на Ваше повідомлення на сайті центру Yao Wang!");

   $mailBody = response_mail_body($replyText);

   $mail->setMessage($mailBody);

   try {
      $mail->send();
      $request->unsetParam(['reply_message', 'token']);
      $successMessage = 'Відповідь відправлена!';
   } catch (MailException $e) {
      $errorMessage = "Повідомлення не відправлене. Спробуйте, будь ласка, ще раз. У випадку повторення даної помилки - повідомте розробників ресурсу";
      Log::addError($e);
   }
}

$messages = Message::getAll();

require_once("includes_admin/admin_header_nav.php");
require_once("includes_admin/admin_sidebar_nav.php");

?>
<section id="main-content">
   <div class="content">
      <div class="row">
         <div class="col-12">
            <h2 class="h2-panel">
               Повідомлення від відвідувачів сайту
            </h2>
            <hr>
            <?php if ($request->has(['reply_message', 'token'])): ?>
               <?php
               $message_id = $request->getStringParam('reply_message');
               $token = $request->getStringParam('token');

               if ($token != $session->getId()) {
                  redirect('../login.php');
               } else {
                  $message = Message::getByParam('message_id', $message_id);
               }
               ?>
               <div class="row">
                  <div class="col-12 col-md-4">
                     <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
                     <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>
                     <form action="" method="post" id="reply_message">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon addon-admin">
                                 @
                              </span>
                              <input type="email" class="form-control input-admin" value="<?php echo $message->message_email; ?> " disabled>
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="input-group">
                              <input type="hidden" name="reply_email" class="form-control input-admin" value="<?php echo $message->message_email; ?>">
                           </div>
                        </div>

                        <div class="form-group">
                           <input type="hidden" class="form-control input-admin" id="reply_text" name="reply_text">
                           <div id="reply_text_editor" class="input-admin">
                           </div>
                        </div>
                        <div class="form-group">
                           <button type="submit" class="form-control admin-sumb-button" name="reply_send">Відповісти</button>
                        </div>
                     </form>
                     <br>
                  </div>
                  <div class="col-12 col-md-8">
                     <div class="table-responsive">
                        <table class="table table-bordered table-admin">
                           <thead>
                           <tr>
                              <th>№</th>
                              <th>Відправник</th>
                              <th>Email</th>
                              <th>Телефон</th>
                              <th>Повідомлення</th>
                              <th>Дата</th>
                              <th style="text-align: center; width: 70px;" colspan="2">Дії</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php if (count($messages) > 0): ?>
                              <?php foreach ($messages as $message): ?>
                                 <tr>
                                    <td style="max-width:60px;"><?php echo $message->message_id ?></td>
                                    <td><?php echo $message->message_name ?></td>
                                    <td><?php echo $message->message_email ?></td>
                                    <td><?php echo $message->message_phone ?></td>
                                    <td style="max-width:350px;"><?php echo $message->message_text ?></td>
                                    <td style="min-width: 90px;">
                                       <?php
                                       $date = new DateTime($message->message_date);
                                       echo $date->format('d-m-Y');
                                       ?>
                                    </td>
                                    <td class="text-center" style="width:35px;">
                                       <a href="messages.php?reply_message=<?php echo $message->message_id; ?>&token=<?php echo $session->getId(); ?>"
                                          class="btn btn-xs btn-primary" title="Відповісти">
                                          <i class="fas fa-reply"></i>
                                       </a>
                                    </td>
                                    <td class="text-center" style="width:35px;">
                                       <a href="messages.php?delete_message=<?php echo $message->message_id; ?>&token=<?php echo $session->getId(); ?>"
                                          class="btn btn-xs btn-danger" title="Видалити">
                                          <i class="far fa-trash-alt"></i>
                                       </a>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           <?php else: ?>
                              <tr>
                                 <td colspan="7" class="text-center">
                                    Повідомлення від відвідувачів сайту відсутні
                                 </td>
                              </tr>
                           <?php endif; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            <?php else: ?>
            <div class="row">
               <div class="col-12">
                  <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>
                  <?php echo isset($rrorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
                  <div class="table-responsive">
                     <table class="table table-bordered table-admin">
                        <thead>
                        <tr>
                           <th>№</th>
                           <th>Відправник</th>
                           <th>Email</th>
                           <th>Телефон</th>
                           <th>Повідомлення</th>
                           <th>Дата</th>
                           <th style="text-align: center; width:70px" colspan="2">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($messages) > 0): ?>
                           <?php foreach ($messages as $message): ?>
                              <tr>
                                 <td style="max-width:60px;"><?php echo $message->message_id ?></td>
                                 <td><?php echo $message->message_name ?></td>
                                 <td><?php echo $message->message_email ?></td>
                                 <td><?php echo $message->message_phone ?></td>
                                 <td style="max-width:350px;"><?php echo $message->message_text ?></td>
                                 <td style="min-width: 90px;">
                                    <?php
                                    $date = new DateTime($message->message_date);
                                    echo $date->format('d-m-Y');
                                    ?>
                                 </td>
                                 <td class="text-center" style="width:35px;">
                                    <a href="messages.php?reply_message=<?php echo $message->message_id; ?>&token=<?php echo $session->getId(); ?>"
                                       class="btn btn-xs btn-primary" title="Відповісти">
                                       <i class="fas fa-reply"></i>
                                    </a>
                                 </td>
                                 <td class="text-center" style="width:35px;">
                                    <a href="messages.php?delete_message=<?php echo $message->message_id; ?>&token=<?php echo $session->getId(); ?>"
                                       class="btn btn-xs btn-danger" title="Видалити">
                                       <i class="far fa-trash-alt"></i>
                                    </a>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        <?php else: ?>
                           <tr>
                              <td colspan="7" class="text-center">
                                 Повідомлення від відвідувачів сайту відсутні
                              </td>
                           </tr>
                        <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End of Main Content section -->
<?php
require_once("includes_admin/admin_footer.php");
?>
