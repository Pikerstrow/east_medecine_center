<?php

require_once("../../init.php");

use Clinic\Classes\Form;
use Clinic\Classes\Review;
use Clinic\Classes\Avatar;

if ($request->has('review_sent') and $request->getStringParam('review_sent') === 'true') {

    $form = new Form($request, 'post');
    $form->setAttributes([
        'name' => ['maxlength' => 50, 'minlength' => 3],
        'email' => [],
        'gender' => ['possible_values' => ['чоловік', 'жінка']],
        'text' => ['maxlength' => 2500, 'minlength' => 10]
    ]);
    $form->validate();

    if ($form->hasErrors()) {
        echo json_encode(["errors" => $form->getErrors()], JSON_UNESCAPED_UNICODE);
    } else {
        $formData = $form->getData();
        $review = new Review();
        $avatar = new Avatar($formData['gender']);
        $formData['avatar'] = $avatar->setAvatar();
      if (!$review->create($formData, true)) {
          echo json_encode(["create_error" => "Упс... виникла помилка! Спробуйте будь ласка ще раз пізніше."], JSON_UNESCAPED_UNICODE);
      } else {
          $successDiv = <<<SUCCESS
<div class="alert alert-success pt-2 pb-2">
   <h2>Дякуємо!!!</h2>
   <h4>Ваш відгук було успішно відправлено!</h4>
   <i class="far fa-smile fa-10x mt-3"></i>
   <div class="col-12 mt-3">
      Відгук буде відображений на сайті найближчим часом.
   </div>
</div>
SUCCESS;
          echo $successDiv;
      }
   }

}

