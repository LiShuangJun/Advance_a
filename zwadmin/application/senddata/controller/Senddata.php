<?php
namespace app\senddata\controller;


use think\Request;
use think\Db;
use core\cases\model\CaseTypeModel;
class Senddata extends Base
{
    public function index() {
        Db::connect('mlxy_data');
        $type=db('cases_case_type')->select();
        $model= CaseTypeModel::getInstance()->select();

    } 
     
}