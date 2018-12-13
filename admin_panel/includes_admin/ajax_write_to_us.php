<?php

require_once("../../init.php");
use Clinic\Classes\Form;
use Clinic\Classes\Message;


if($request->has('message_sent') and $request->getStringParam('message_sent') === 'true'){

   $form = new Form($request, 'post');
   $form->setAttributes([
      'name'=>['maxlength'=>50, 'minlength'=>3],
      'email'=>[],
      'phone'=>[],
      'text'=>['maxlength'=>1500, 'minlength'=>10]
   ]);
   $form->validate();

   if($form->hasErrors()){
      echo json_encode(["errors" => $form->getErrors()], JSON_UNESCAPED_UNICODE);
   } else {
      $message = new Message();
      if(!$message->create($form->getData(), true)){
         echo json_encode(["create_error" => "Упс... виникла помилка! Спробуйте будь ласка ще раз пізніше."], JSON_UNESCAPED_UNICODE);
      } else {
         $successDiv = <<<SUCCESS
<div class="alert alert-success pt-2 pb-2">
   <h2>Дякуємо!!!</h2>
   <h4>Ваше повідомелння було успішно відправлене!</h4>
   <i class="far fa-smile fa-10x mt-3"></i>
   <div class="col-12 mt-3">
      Ми зв'яжемося з Вами найближчим часом!
   </div>
</div>
SUCCESS;
         echo $successDiv;
      }
   }

}