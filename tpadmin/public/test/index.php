<?php

/* $caseid = [10,12,16];

echo json_encode($caseid); */


$arr = array(array("case_id" => 10,"case_type" => "wangjin"),array("case_id" => 12,"case_type" => "zhangsan"));
//echo $arr;
echo json_encode($arr);//编码为JSON字符串
?>