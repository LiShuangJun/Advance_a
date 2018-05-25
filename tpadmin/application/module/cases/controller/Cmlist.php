<?php
namespace module\cases\controller;



use think\Request;
use think\Session;
use think\config;
use core\cases\logic\ChatUserLogic;
use core\cases\logic\CaseLogic;
use core\cases\model\ChatUserModel;
class Cmlist extends Base
{

    /**
     * casemanager推荐页面
     *
     * @param Request $request            
     * @return string
     */
    public function index(Request $request)
    {
        $this->siteTitle = 'casemanager推荐列表';
        if(!$request->param('caseid')){
             $this->error('非法操作', self::JUMP_REFERER);
             exit;
        }else{
            $this->assign('caseid', $request->param('caseid'));
        }
        $this->assginIndex();
        return $this->fetch(); 
        
    }
    
    /*
     * 根据条件查询数据
     * 
     */
    protected function assginIndex() {
        $map=[];
         $request = Request::instance();
       $useralias=ChatUserModel::getInstance()->alias_name;
        // 查询条件-关键词
        $keyword = $request->param('keyword');
        if ($keyword != '') {
            $map[$useralias.'.nickname'] = [
                'like',
                '%' . $keyword . '%'
            ];
        }
     
         $this->assign('keyword', $keyword);
        
        $this->getManagerList($map);
    }
    
           //获取casemanage数组
    protected function getManagerList($map=null){
         
         $usedata=ChatUserLogic::getInstance()->getCasemanager($map);
         $this->_page($usedata);
       
        
     }
     
         /**
     * casemanager推荐分页列表
     *
     * @param Model $model            
     * @param integer $rowNum            
     * @param Closure $perform            
     * @return void
     */
    protected function _page($model, $rowNum = null, \Closure $perform = null)
    {
        $rowNum || $rowNum = Config::get('manage_row_num');
        $rowNum || $rowNum = 10;
        
      $model = $this->buildModel($model);
        
        $list = $model->paginate($rowNum);
        $perform && $perform($list);
        //查询当前case的信息
        $caseid= Request::instance()->param('caseid');
        $casedata=CaseLogic::getInstance()->casesById($caseid);
        if(empty($casedata)){
            $this->error('未查询到该id的有效信息', module_url('case_list/index'));
            exit;
        }
        if($casedata['case_status']!=1){
            $this->assign('allow_zd', 0);  //不允许指定
//            $this->redirect(module_url('case_list/index'));
           
        }else{
            $this->assign('allow_zd', 1);
        }
        //查询条件 语言排序
        $language=Request::instance()->param('language');
        $language || $language=1;
        $ar1=[];
        $ar2=[];
        $ar3=[];
        $ar4=[];
        //排序整合(排序规则：符合科室优先->当前负责case最少->解决case最多)
        
        foreach ($list as $key => $value) {
            $list[$key]['tuijian']=0;
            $ksname=[];
            $ksarr=[];
            $langname=[];
            $langarr=[];
            $map=[];
            $count=0;
            //整合擅长语言
            foreach($value->langarr as $k=>$v){
                if($v['id']==$language){
                   $langname[$v['id']]='<span style="color:green;">'.$v['l_name'].'</span>'; 
                   $list[$key]['tuijian']=1;
                }else{
                   $langname[$v['id']]=$v['l_name']; 
                   
                }
                $langarr[]=$v['id'];
            }
            //整合科室
            foreach($value->ksarr as $k=>$v){
                if($v['ks_id']==$casedata['ks_type']){
                   $ksname[$v['ks_id']]='<span style="color:green;">'.$v['ks_name'].'</span>'; 
                   $list[$key]['tuijian']=1;
                }else{
                   $ksname[$v['ks_id']]=$v['ks_name']; 
                   
                }
             
             $ksarr[]=$v['ks_id'];
            }
            $langstr=implode(',', $langname);
            if($langstr==''){
                $langstr='未选择';
            }
            $list[$key]['langstr']=$langstr;
            $r0= in_array($language, $langarr);
            $ksstr=implode(',', $ksname);
            $list[$key]['ksstr']=$ksstr;
            $r1= in_array($casedata['ks_type'], $ksarr);
            $map['case_manager'] = $list[$key]['managerid'];
            $map['case_status'] = ['in','2,5'];
            $count=CaseLogic::getInstance()->getCaseCount($map); //当前负责case次数
            $r2=$count;
            $list[$key]['case_count']=$count;
            if(!empty($value->worker)){
                
                $r3=$value->worker->complete_count;
            }else{
                $r3=0;
            }
            $ar0[]=$r0?0:1;
            $ar1[]=$r1?0:1;
            $ar2[]=$r2?0:1;
            $ar3[]=$r3;
            $ar4[]=$list[$key]['sort'];
         
        }
        $listdata=json_decode(json_encode($list),true); //转换数组
        $userlist=$listdata['data'];
        array_multisort($ar0,$userlist);
        array_multisort($ar1, $ar2,$userlist);
        array_multisort($ar3,SORT_DESC,$ar4,SORT_DESC,$userlist);
        
        
        $this->assign('userlist', $userlist);
        $this->assign('_page', $list->render());
        $this->assign('_total', $list->total());
    }

}