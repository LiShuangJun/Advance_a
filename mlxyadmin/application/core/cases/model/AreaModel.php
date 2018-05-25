<?php
namespace core\cases\model;

use core\Model;

class AreaModel extends Model
{

    /**
     * 去前缀表名
     *
     * @var unknown
     */
    protected $name = 'cases_area';

    /**
     * 自动写入时间戳
     *
     * @var unknown
     */
    protected $autoWriteTimestamp = true;

  
/*
 * 定义别名变量
 */
   public $alias_name=[
       'province',
       'city',
       'district'
       ];
  
public function getlist($where=''){
    return $this->where($where)->select();
}
}