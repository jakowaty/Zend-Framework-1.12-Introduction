<?php

/**
 * class Paginator
 * 
 * 
 * @property array $data Internal, Parsed result obtained from passed data
 * @property boolean $object Indicating wheter original data passed to paginator is object
 * @property boolean $array Indicating wheter original data passed to paginator is array
 * @property object | array $__d Original data passed to Paginator Object
 * 
 * @method public setupPaginator(Iterable | Array $data) function for object initialization
 * must be passed object to iterate or array. Redirects passed data for checks, sets internal variables;
 * 
 */
class Jak_Paginator
{
   private $data    = false;
   private $object  = false;
   private $array   = false;
   private $__d     = false;
   
   public function setupPaginator($data)
   {
       if (!is_object($data) && !is_array($data)) {
           throw new Exception('Invalid data object');
       }
       
       if (is_object($data) && !($data instanceof Iterator)) {
           
       }
   }
}