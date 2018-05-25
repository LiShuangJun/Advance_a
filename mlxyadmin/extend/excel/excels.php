<?php
namespace excel;
use think\Loader;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('PHPEXCEL_ROOT')) {
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/');
    require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}
class excels
{
    
public function phpexcel() {

   
     return $data=new \PHPExcel();
     
}
public function loaderexcel5() {
    Loader::import('excel.PHPExcel.Reader.Excel5');
}
 public function loaderexcel2007() {
    Loader::import('excel.PHPExcel.Reader.Excel2007');
}   
    
    
}

