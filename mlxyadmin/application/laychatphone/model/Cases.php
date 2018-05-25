<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\laychatphone\model;
use think\Model;
use think\Db;
class Cases extends Model
{
    protected $name="cases_case";
    protected $autoWriteTimestamp = true;
    //根据条件获取case列表
    public function getList(array $arr=null){
        $arr['delete_time']=0;
        return $this->alias('c')->field("c.*,st.typename,cs.name")
                ->join('cases_case_type st','c.case_type=st.id')
                ->join('cases_case_status cs','c.case_status=cs.id')
            
                ->where($arr)->select();
    }
}