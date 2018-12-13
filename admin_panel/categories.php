<?php require_once("includes_admin/admin_header.php"); ?>
<!-- Header Nav -->
<?php require_once("includes_admin/admin_header_nav.php"); ?>
<!-- End of header -->
<!-- Sidebar Nav -->
<?php require_once("includes_admin/admin_sidebar_nav.php"); ?>
<!-- End of sidebar Nav -->
<!-- Main Content -->

<section id="main-content">
   <div class="content">
      <div class="row">
         <?php
         if ($request->has('route')) {
            $route = $request->getStringParam('route', true);
         } else {
            $route = '';
         }
         switch ($route) {
            case 'add_category' :
               include_once 'includes_admin/add_category.php';
               break;
            case 'edit_category' :
               include_once 'includes_admin/edit_category.php';
               break;
            default :
               include_once 'includes_admin/view_all_categories.php';
               break;
         }
         ?>

      </div>
   </div>
</section>

<!-- End of Main Content section -->
<?php
require_once("includes_admin/admin_footer.php");
?>
