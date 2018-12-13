<?php

$rootForImage      = 'C:' . DIRECTORY_SEPARATOR . 'wamp64' . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . "east_medicine_center" . DIRECTORY_SEPARATOR;
$siteURL           = 'http://localhost/east_medicine_center';
$imagesNewsBodyURL =  $siteURL . "/admin_panel/images/news_body/";


if(isset($_FILES['image'])){
   $image = $_FILES['image'];

   $ext = mb_strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
   $fileName = mb_substr(md5($image['name'] . microtime()), 0, 10) . '.' . $ext;

   $targetPath = $rootForImage . "admin_panel" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "news_body" . DIRECTORY_SEPARATOR;
   $result = move_uploaded_file($image['tmp_name'], $targetPath . $fileName);

   if($result)
      echo json_encode(["default" => $imagesNewsBodyURL . $fileName]);
   else
      echo json_encode(["default" => $imagesNewsBodyURL . 'upload_error.jpg']);
}
