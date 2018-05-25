<?php
namespace app\advance\controller;

use think\Config;
use cms\Controller;
use cms\Response;
use app\manage\service\ViewService;
use app\common\App;
use think\Request;

use core\cases\validate\CaseValidate;
use core\cases\model\CaseModel;
use core\cases\logic\CaseTypeLogic;
use core\cases\model\AreaModel;
use core\cases\model\ChatUserModel;
use core\manage\model\FileModel;
use app\common\sendemail\SendUser;
use core\cases\logic\ChatUserLogic;
class Index extends Controller
{
    /**
     * 网站标题
     *
     * @var unknown
     */
    protected $siteTitle;
    
    
      /**
     *
     * {@inheritdoc}
     *
     * @see Controller::_initialize()
     */
    public function _initialize()
    {

        parent::_initialize();
        
        //记录当前url
        $this->savebackurl();
        //获取服务列表
        $this->getServiceList();
        
                    //获取省列表
            $this->assignProvinceList();
            //获取国家列表
            $this->getCountryList();
            
            //获取当前用户信息
            $userid=cookie('phone_user_id')? cookie('phone_user_id'):0;
            $this->assign('userid', $userid);
            $chatuser=ChatUserModel::getInstance();
            $cuname=$chatuser->alias_name;
            if($userid){
                $where=[
                   $cuname. '.id'=>$userid
                    ];
            }else{
                $where=[];
            }
            $this->getUserList($where);

    }
    protected function getUserList($where){
        $chatuser=ChatUserModel::getInstance();
        $data=$chatuser->getUserlist($where)->find();
        $this->assign('minedata',$data);
    }
    //获取国家数组
    protected function getCountryList(){
         
         $logic =CaseTypeLogic::getInstance();
         $country_list=$logic->getSelectCountry();
         $this->assign('country_list',$country_list);
     }
         //省市区联动
     protected function assignProvinceList(){
        
    	//地区
    	$area= AreaModel::all(['parent_id'=>0]);
    	$this->assign('area',$area);

     }
    /*
     * 记录当前url
     */
    public function savebackurl() {
        $request = Request::instance();
        $url=$request->url(true);
        
        cookie('amback', $url);
    }
    /**
     * 首页
     *
     * @return string
     */
    public function index()
    {
        
       $this->siteTitle = 'advance|medical首页';

        return $this->fetch();
    }
    
    
    public function getServiceList($where=null) {
        
        $service_list=db('cases_case_type')->where($where)->order('sort desc')->select();
        
        $this->assign('service_list', $service_list);
    }
        /**
     * 服务详情页
     *
     * @return string
     */
    public function service_details($id=1)
    {
        $arr=explode(',','1');
        
       if(!in_array($id, $arr)){
           $id=1;
       }
      
       $this->assign('service_id', $id);
        
        return $this->fetch();
    }

    
    /*
     * mobile form
     */
    public function mobile_form($id) {
        $this->siteTitle = 'advance|medical填写case';
        $this->assign('service_id', $id);;
        return $this->fetch();
    }
    
    /*
     * 添加case
     * 
     */
    public function addCase(Request $request) {
         if ($request->isPost()) {
            $data = [
                'username' => str_replace(' ', '',$request->param('username')),
                'birthday' => $request->param('birthday'),
                'sex' => $request->param('sex'),
                'isme' => $request->param('isme'),
                'relationship' => $request->param('relationship'),
                'applicant_name' => str_replace(' ', '',$request->param('applicant_name')),
                'address' => $request->param('address'),
                'province' => $request->param('province',110000),
                'city' => $request->param('city',110100),
                'district' => $request->param('district',110101),
                'zip_code' => $request->param('zip_code'),
                'preferred_phone' => $request->param('preferred_phone'),
                'standby_phone' => $request->param('standby_phone'),
                'preferred_time' => $request->param('preferred_time'),
                'illness' => $request->param('illness'),
                'treatment_doctor' => $request->param('treatment_doctor'),
                'treatment_hospital' => $request->param('treatment_hospital'),
                 'specialty' => $request->param('specialty'),
                 'case_type' => 1,
                'sort' => $request->param('sort',0), 
                'country'=>$request->param('country',1),
                'email'=>str_replace(' ', '',$request->param('email')),
                'e_province' => $request->param('e_province'),
               
            ];
             if(empty($data['province'])){
               $data['province']=110000;
           }
           if(empty($data['city'])){
               $data['city']=110100;
           }
           if(empty($data['district'])){
               $data['district']=110101;
           }
            if($request->param('options')){
                $file=FileModel::getInstance()->where(['file_url'=>$request->param('options')])->find();
                if(!empty($file)){
                    $data['options']=$file['id'];
                }
            }
            if(cookie('phone_user_id')){
                $data['userid']= cookie('phone_user_id');
               // 动态绑定属性
                Request::instance()->bind('userid',$data['userid']);
            }else{
                $msg['error']=2;
                $msg['msg']='请登录';
                echo $this->error($msg); 
                exit;
            }
        
       $case_validate=CaseValidate::getInstance();
        $result =$case_validate->scene('add')->check($data);
        $msg=[];
        if ($result!==true) {
            $msg['error']=1;
            $msg['msg']=$case_validate->getError(); 
             echo $this->error($msg);  
        }else{
                        // 添加
            $model = CaseModel::getInstance();
            $status = $model->save($data);
            
            $msg['error']=0;
            $msg['msg']='新增成功';
              echo $this->success($msg);  
        }
          
          

            
            
          
         }
    }
       /**
     *
     * {@inheritdoc}
     *
     * @see Controller::beforeViewRender()
     */
    protected function beforeViewRender()
    {
        // 网站标题
        $this->assign('site_title', $this->siteTitle);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Controller::getView()
     */
    protected function getView()
    {
        return ViewService::getSingleton()->getView();
    }
}
 