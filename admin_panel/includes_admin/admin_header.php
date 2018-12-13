<?php
require_once("../init.php");

use \Clinic\Classes\Visitors\Admin;

checkAuth($session);

if ($request->has('logout') and $request->getStringParam('logout') == 'true') {
   Admin::logOut();
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Медичний центр Yao Wang в м.Луцьк</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
   <link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css"/>
   <link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap-theme.css"/>

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
         integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
   <!-- Quill editor -->
   <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" media="screen" href="css/main.css"/>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>