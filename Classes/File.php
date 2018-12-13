<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 01.11.2018
 * Time: 19:40
 */

namespace Clinic\Classes;


class File
{
   public $tmp_path; // temporary path to img
   public $upload_directory;
   public $type;
   public $size;
   public $filename;


   public function __construct($upload_directory, $image)
   {
      $this->upload_directory = $upload_directory;
      $this->setFile($image);
   }

   /**
    * @param $file - is $_FILES['uploaded_file'];
    * @return bool
    */
   private function setFile($file)
   {
      $ext = mb_strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $this->filename = mb_substr(md5($file['name'] . microtime()), 0, 10) . '.' . $ext;
      $this->tmp_path = $file['tmp_name'];
      $this->type = $file['type'];
      $this->size = $file['size'];
   }


   public function filePath()
   {
      return "admin_panel" . DS . "images" . DS . $this->upload_directory . DS . $this->filename;
   }


   public function save()
   {
      if (!empty($this->errors)) {
         return false;
      }

      if (empty($this->filename) or empty($this->tmp_path)) {
         $this->errors[] = 'Файл недоступний для збереження!';
         return false;
      }

      $targetPath = SITE_ROOT . DS . $this->filePath();

      if (move_uploaded_file($this->tmp_path, $targetPath)) {
         unset($this->tmp_path);
         return true;
      } else {
         $this->errors[] = "Файл не було збережено в місці призначення.";
         return false;
      }
   }

   public static function delete($fileName)
   {
      if(file_exists($fileName)){
         return unlink($fileName) ? true : false;
      }
   }


}