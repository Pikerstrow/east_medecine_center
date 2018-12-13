<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 30.10.2018
 * Time: 20:16
 */

namespace Clinic\Classes;


class Pagination
{

   public $currentPage;
   public $perPage;
   public $totalItems;
   public $totalPages;
   public $onEachSides;
   public $pageName;


   public function __construct($pageName, $page, $totalItems, $perPage = 6, $onEachSides = 1)
   {
      $this->pageName    = $pageName;
      $this->currentPage = $page;
      $this->totalItems  = $totalItems;
      $this->perPage     = $perPage;
      $this->totalPages  = ceil($totalItems / $perPage);
      $this->onEachSides = $onEachSides;
   }


   public function next()
   {
      return $this->currentPage + 1;
   }


   public function previous()
   {
      return $this->currentPage - 1;
   }

   /**
    *Check if the previous page exists;
    */
   public function has_previous(){
      return $this->previous() >= 1 ? true : false;
   }

   /**
    * Check if the next page exists;
    */
   public function has_next(){
      return $this->next() <= $this->totalPages ? true : false;
   }


   public function offset(){
      return ($this->currentPage - 1) * $this->perPage;
   }


   private function createPaginationLinks()
   {
      $addDots   = true;
      $htmlLinks = '';

      if($this->totalPages <= 1){
         $htmlLinks = '';
      } else {

         $htmlLinks = "<ul class='pagination'>";

         if ($this->currentPage == 1) {
            $htmlLinks .= "<li class='page-item disabled'><a class='page-link' href='#'> &laquo; </a></li>";
         } else {
            $page = $this->currentPage - 1;
            $htmlLinks .= "<li class='page-item'><a class='page-link' href='" . SITE_URL . "/{$this->pageName}?page={$page}' tabindex='-1'>&laquo;</a></li>";
         }

         for ($i = 1; $i <= $this->totalPages; $i++) {
            if ($i == $this->currentPage) {
               $htmlLinks .= "<li class='page-item active'><a class='page-link' href='" . SITE_URL . "/{$this->pageName}?page={$i}'>{$i}<span class='sr-only'>(current)</span></a></li>";
               $addDots = true;
            } else if ($i == 1 || $i == 2 || $i == $this->totalPages || $i == ($this->totalPages - 1) || ($i >= $this->currentPage - $this->onEachSides && $i <= $this->currentPage + $this->onEachSides)) {
               $htmlLinks .= "<li class='page-item'><a class='page-link' href='" . SITE_URL . "/{$this->pageName}?page={$i}'>{$i}<span class='sr-only'>(current)</span></a></li>";
               $addDots = true;
            } else {
               if ($addDots) {
                  $htmlLinks .= "<li class='page-item disabled'> <a class='page-link' href='#'>... </a></li>";
                  $addDots = false;
               }
            }
         }

         if ($this->currentPage == $this->totalPages) {
            $htmlLinks .= "<li class='page-item disabled'><a class='page-link' href='#'> &raquo; </a></li>";
         } else {
            $page = $this->currentPage + 1;
            $htmlLinks .= "<li class='page-item'><a class='page-link' href='" . SITE_URL . "/{$this->pageName}?page={$page}'>&raquo;</a></li>";
         }

         $htmlLinks .= "</ul>";

      }
      return $htmlLinks;
   }


   public function getLinks()
   {
      return $this->createPaginationLinks();
   }

}