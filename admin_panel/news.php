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
            case 'add_news' :
               include_once 'includes_admin/add_news.php';
               break;
            case 'edit_news' :
               include_once 'includes_admin/edit_news.php';
               break;
            default :
               include_once 'includes_admin/view_all_news.php';
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
