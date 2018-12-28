<?php require_once("includes_admin/admin_header.php"); ?>
<!-- Header Nav -->
<?php require_once("includes_admin/admin_header_nav.php"); ?>
<!-- End of header -->
<!-- Sidebar Nav -->
<?php require_once("includes_admin/admin_sidebar_nav.php"); ?>
<!-- End of sidebar Nav -->
<!-- Main Content -->

<?php

use Clinic\Classes\Service;
use Clinic\Classes\Form;
use Clinic\Classes\Image;
use Clinic\Classes\Category;

/*CREATE SERVICE SECTION*/
if ($request->has('add_service')) {
    $form = new Form($request, 'post');

    /*Checking for image and setting form attributes according to result of checking*/
    if ($request->has('image')) {
        $imgFromRequest = $request->getArrayParam('image');
    }

    if (isset($imgFromRequest) and $imgFromRequest['name'] != '' and !empty($imgFromRequest['name'])) {
        $form->setAttributes([
            "image" => ['maxsize' => 2097153, 'parameters' => ['width' => 1024, 'height' => 1024], 'preview' => true],
            "title" => ['maxlength' => 80, 'minlenght' => 3],
            "category_id" => [],
            "price" => []
        ]);
        $form->validate();

        if ($form->hasErrors()) {
            $errors = $form->getErrors();
            $data = $form->getData();
            $addErrorMessage = "Форма створення послуги містить помилки";
        } else {
            $data = $form->getData();

            $serviceImage = new Image('services_title', $data['image']);
            $serviceImage->setSrc('admin_panel/images/services_title');

            if ($serviceImage->save()) {
                $service = new Service();
                $data['image'] = $serviceImage->getSrc();

                if ($service->create($data)) {
                    $addSuccessMessage = "Нову послугу створено.";
                    $request->unsetParam('image');
                    unset($data);
                } else {
                    $addErrorMessage = "Послугу не створено, а саме - помилка збереження інформації в базі даних.";
                }
            } else {
                $addErrorMessage = "Послугу не створено, а саме - помилка збереження зображення послуги.";
            }
        }
    } else {
        $form->setAttributes([
            "title" => ['maxlength' => 80, 'minlenght' => 3],
            "price" => [],
            "category_id" => [],
        ]);
        $form->validate();

        if ($form->hasErrors()) {
            $errors = $form->getErrors();
            $data = $form->getData();
            $addErrorMessage = "Форма створення послуги містить помилки";
        } else {
            $data = $form->getData();
            $data['image'] = SITE_URL . "/admin_panel/images/services_title/service_has_no_photo.jpg";

            $service = new Service();

            if ($service->create($data)) {
                $addSuccessMessage = "Нову послугу створено.";
                unset($data);
            } else {
                $addErrorMessage = "Послугу не створено, а саме - помилка збереження інформації в базі даних.";
            }
        }
    }
}

/*DELETE SERVICE SECTION*/
if ($request->has(['delete_service', 'token'])) {
    $service_id = $request->getStringParam('delete_service', true, true);
    $token = $request->getStringParam('token');

    if ($token != $session->getId()) {
        redirect('../login.php');
    } else {
        $service = Service::getByParam('service_id', $service_id);
        $serviceTitleImage = $service->getTitleImage();

        if (Service::delete('service_id', $service_id)) {
            if (Image::delete($serviceTitleImage)) {
                $sessionSuccessMessage = "Послугу видалено.";
                $session->add('successActionMassage', $sessionSuccessMessage);
                unset($data);
                redirect('services.php');
                exit;
            } else {
                $errorMessage = 'Сталася помилка видалення даних: не було видалене головне зображення послуги! Спробуйте, будь ласка, ще раз.';
            }
        } else {
            $errorMessage = 'Сталася помилка видалення даних! Спробуйте, будь ласка, ще раз.';
        }

    }
}

?>

<section id="main-content">
   <div class="content">
      <div class="row">
         <div class="col-12">
            <h2 class="h2-panel">
               Послуги
            </h2>
            <hr>

            <?php if (Category::countItems()): ?>
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-lg-4">

                   <?php
                   if ($request->has('edit_service')) {
                       include_once("includes_admin/edit_service.php");
                   } else {
                       ?>

                      <h4 style="margin:0; margin-bottom:10px;">Додати послугу</h4>
                       <?php echo isset($addErrorMessage) ? showInfoBlock($addErrorMessage, 'danger') : '' ?>
                       <?php echo isset($addSuccessMessage) ? showInfoBlock($addSuccessMessage, 'success') : '' ?>

                      <form action="" method="post" class="category-form" enctype="multipart/form-data">

                         <div class="form-group">
                            <label>Назва </label>
                             <?php echo isset($errors['title']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['title'] . '</span>' : '' ?>
                            <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-file-signature"></i>
                              </span>
                               <input type="text" name="title" id="title"
                                      class="form-control input-admin input-category"
                                      required="required" placeholder="Введіть назву"
                                      value="<?php echo(isset($data['title']) ? $data['title'] : '') ?>">
                            </div>
                         </div>


                         <div class="form-group ">
                            <label>Категорія</label>
                             <?php echo isset($errors['category_id']) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['category_id'] . '</span>' : '' ?>
                            <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-file-medical"></i>
                              </span>
                               <select class="form-control input-admin input-category" name="category_id"
                                       id="category_id" required="required">
                                  <option value=''>Виберіть категорію</option>
                                   <?php
                                   if (isset($data['category_id'])) {
                                       Category::getAllForOptions($data['category_id']);
                                   } else {
                                       Category::getAllForOptions();
                                   }
                                   ?>
                               </select>
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

                         <div class="form-group">
                            <label>Ціна, грн </label>
                             <?php echo((isset($errors['price'])) ? '<br><span class="error-span"><b>Помилка: </b>' . $errors['price'] . '</span>' : '') ?>
                            <div class="input-group" style="width:100%">
                              <span class="input-group-addon addon-admin addon-category">
                                 <i class="fas fa-dollar-sign"></i>
                              </span>
                               <input type="text" name="price" id="price"
                                      class="form-control input-admin input-category"
                                      required="required" placeholder="Введіть ціну"
                                      value="<?php echo(isset($data['price']) ? $data['price'] : '') ?>">
                            </div>
                            <small><b>Примітка:</b> використання пробільних символів не допускається. Якщо ціна
                               зазначається із копійками, то розділовим знаком повинна бути крапка.
                               Наприклад, 1250.50
                            </small>
                         </div>

                         <div class="form-group">
                            <button type="submit" class="form-control admin-sumb-button" name="add_service">Додати
                            </button>
                         </div>
                         <hr>
                      </form>
                       <?php
                   }
                   ?>

               </div>
               <div class="col-xs-12 col-sm-12 col-lg-8">
                   <?php
                   /*Filter via categories*/
                   if ($request->has('filter_apply')) {
                       $categoryId = $request->getStringParam("category_id", true, true);
                       $services = Service::getAllWithFilter($categoryId);
                   } else {
                       $services = Service::getAllWithFilter();
                   }
                   /*end filter*/
                   ?>

                   <?php echo isset($errorMessage) ? showInfoBlock($errorMessage, 'danger') : '' ?>
                   <?php echo isset($successMessage) ? showInfoBlock($successMessage, 'success') : '' ?>

                   <?php
                   /*Success action notification*/
                   if ($session->check('successActionMassage')) {
                       showInfoBlock($session->get('successActionMassage'), 'success');
                       $session->remove('successActionMassage');
                   }
                   /*end of success action notification*/
                   ?>
                  <div class="row">
                     <div class="col-xs-12 col-sm-6 text-left" style="padding-left:0">
                        <h4 style="margin:0; margin-bottom:10px;">Наявні послуги</h4>
                     </div>
                     <div class="col-xs-12 col-sm-6 text-right" style="padding-right:0">

                        <form class="form-inline" action="" method="post" style="margin-bottom: 5px;">
                           <div class="form-group">
                              <label for="category_id" style="font-size:18px; font-weight: lighter">Фільтр: </label>
                              <div class="input-group">
                                 <div class="input-group-addon addon-admin-filter">
                                    <i class="fas fa-notes-medical"></i>
                                 </div>
                                 <select class="form-control input-admin input-category" name="category_id"
                                         id="category_id" required="required" style="height:30px;">
                                    <option value=''>Виберіть категорію</option>
                                     <?php
                                     if (isset($categoryId)) {
                                         Category::getAllForOptions($categoryId);
                                     } else {
                                         Category::getAllForOptions();
                                     }
                                     ?>
                                 </select>
                                 <div class="input-group-btn">
                                    <button type="submit" name="filter_apply"
                                            class="btn btn-success btn-sm text-center">
                                       <i class="fas fa-check"></i>
                                    </button>
                                     <?php echo ($request->has('filter_apply')) ? "<a style='height:30px; width:30px; padding-top:5px; margin-left: 8px; border-radius: 0;' class='btn btn-danger btn-xs' href='./services.php'><i class=\"fas fa-times\"></i></a>" : ""; ?>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>

                  <div class="table-responsive">
                     <table class="table table-bordered table-admin">
                        <thead>
                        <tr>
                           <th>№</th>
                           <th>Категорія</th>
                           <th>Зображення</th>
                           <th>Назва</th>
                           <th>Ціна, грн</th>
                           <th style="text-align: center; width:80px;" colspan="2">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($services) > 0): ?>
                            <?php foreach ($services as $service): ?>
                              <tr>
                                 <td style="width:50px;"><?php echo $service->service_id ?></td>
                                 <td
                                    style="width:50px;"><?php echo $service->getCategory($service->service_category_id) ?></td>
                                 <td style="width:90px;"><img width="90" src="<?php echo $service->service_image ?>">
                                 </td>
                                 <td><?php echo $service->service_title ?></td>
                                 <td><?php echo number_format($service->service_price, 2, '.', ' ') ?></td>
                                 <td class="text-center" style="width:40px;">
                                    <a href="services.php?edit_service=true&service_id=<?php echo $service->service_id; ?>&token=<?php echo $session->getId(); ?>"
                                       class="btn btn-sm btn-warning" title="Редагувати">
                                       <i class="far fa-edit fa-lg"></i>
                                    </a>
                                 </td>
                                 <td class="text-center" style="width:40px;">
                                    <a href="services.php?delete_service=<?php echo $service->service_id; ?>&token=<?php echo $session->getId(); ?>"
                                       class="btn btn-sm btn-danger" title="Видалити">
                                       <i class="far fa-trash-alt fa-lg"></i>
                                    </a>
                                 </td>
                              </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                           <tr>
                              <td colspan="7" class="text-center">
                                 На даний момент Ви ще не додали жодної послуги.
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
               <div class="col-xs-12 no-services text-center">
                  <h2>Увага!!!</h2>
                  <i class="far fa-frown fa-10x" style="margin-top: 30px; margin-bottom: 30px"></i>
                  <div class="col-xs-12">
                     <span style="font-size:16px">Для того, щоб мати змогу створювати послуги, необхідно спочатку створити хоча б одну категорію</span>
                  </div>
                  <div style="margin-top: 45px;">
                     <a href="categories.php?route=add_category" class="btn btn-primary btn-sm">Додати категорію?</a>
                  </div>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</section>

<!-- End of Main Content section -->
<?php
require_once("includes_admin/admin_footer.php");
?>
