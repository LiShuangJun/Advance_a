<?php
// +----------------------------------------------------------------------
// | laychat-v3.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\laychatphone\controller;

class Chatlog extends Base
{
    //聊天记录
    public function index()
    {
        $this->assign([
            'perPage' => config('log_page')
        ]);
        return $this->fetch();
    }

    //聊天记录详情
    public function detail()
    {
        

            $perPage = 20;
            $id = input('id');
            $type = input('type');
            $flag = input('flag',0);  //此处为标识是否获取总数
             $current_page=input('page',0);
            $uid = session('f_user_id');

            $field = 'from_name username,from_id id,from_avatar avatar,timeline timestamp,content';
            if('friend' == $type) {

                $where = "((from_id={$uid} and to_id={$id}) or (from_id={$id} and to_id={$uid})) and type='friend'";

                if(!empty($flag)){
                    $result = db('cases_chatlog')->field('id')->where($where)->count();
                }else{
                    $result = db('cases_chatlog')->field($field)
                        ->where($where)->order('timeline desc')->paginate($perPage);
                }

                if(empty($result)) {
                    return json(['code' => -1, 'data' => '', 'msg' => '没有记录']);
                }

                return json(['code' => 1, 'data' => $result, 'msg' => 'success']);

            } else if('group' == $type) {
                 
                if(!empty($flag)){
                    $result = db('cases_chatlog')->field('id')->where("to_id={$id} and type='group'")->count();
                }else{
                    $result = db('cases_chatlog')->field($field)->where("to_id={$id} and type='group'")->order('timeline desc')
                        ->paginate($perPage,false,['page'=>$current_page]);
                }
      
                if(empty($result)) {
                    return json(['code' => -1, 'data' => '', 'msg' => '没有记录']);
                }

                return json(['code' => 1, 'data' =>$result, 'msg' => 'success']);
            }

    }
}