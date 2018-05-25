<?php
namespace message;

class mess{
 
   
    public function send($tel,$content){
        set_time_limit(0);
	
	/**
	 * 定义程序绝对路径
	 */
	define('SCRIPT_ROOT',  dirname(__FILE__).'/');
	require_once SCRIPT_ROOT.'includes/Client.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        /**
 * 网关地址
 */	
$gwUrl = 'http://hprpt2.eucp.b2m.cn:8080/sdk/SDKService?wsdl';


/**
 * 序列号,请通过亿美销售人员获取
 */
$serialNumber = '8SDK-EMY-6699-RDULT';

/**
 * 密码,请通过亿美销售人员获取
 */
$password = '890205';

/**
 * 登录后所持有的SESSION KEY，即可通过login方法时创建
 */
$sessionKey = '890205';

/**
 * 连接超时时间，单位为秒
 */
$connectTimeOut = 2;

/**
 * 远程信息读取超时时间，单位为秒
 */ 
$readTimeOut = 10;

/**
	$proxyhost		可选，代理服务器地址，默认为 false ,则不使用代理服务器
	$proxyport		可选，代理服务器端口，默认为 false
	$proxyusername	可选，代理服务器用户名，默认为 false
	$proxypassword	可选，代理服务器密码，默认为 false
*/	
	$proxyhost = false;
	$proxyport = false;
	$proxyusername = false;
	$proxypassword = false; 

    $client = new \Client($gwUrl,$serialNumber,$password,$sessionKey,$proxyhost,$proxyport,$proxyusername,$proxypassword,$connectTimeOut,$readTimeOut);
    $client->setOutgoingEncoding("utf-8");
    $client->login();
    if($client->getBalance()<=100){
        $client->sendSMS(array('18616696490'),'【蜜柚网】：您当前忆美账户已不大于100元，请及时充值');

    }
    $client->sendSMS(array($tel),$content);
      
    
    
    
   }  
/**
 * 接口调用错误查看 用例
 */
function chkError($client)
{

	
	$err = $client->getError();
	if ($err)
	{
		/**
		 * 调用出错，可能是网络原因，接口版本原因 等非业务上错误的问题导致的错误
		 * 可在每个方法调用后查看，用于开发人员调试
		 */
		
		echo $err;
	}
	
}

/**
 * 登录 用例
 */
function login($client)
{
	
	
	/**
	 * 下面的操作是产生随机6位数 session key
	 * 注意: 如果要更换新的session key，则必须要求先成功执行 logout(注销操作)后才能更换
	 * 我们建议 sesson key不用常变
	 */
	//$sessionKey = $client->generateKey();
	//$statusCode = $client->login($sessionKey);
	
	$statusCode = $client->login();
	
	echo "处理状态码:".$statusCode."<br/>";
	if ($statusCode!=null && $statusCode=="0")
	{
		//登录成功，并且做保存 $sessionKey 的操作，用于以后相关操作的使用
		echo "登录成功, session key:".$client->getSessionKey()."<br/>";
	}else{
		//登录失败处理
		echo "登录失败,返回:".$statusCode;
	}
	 
}

/**
 * 注销登录 用例
 */
function logout($client)
{


	$statusCode = $client->logout();
	echo "处理状态码:".$statusCode;
}

/**
 * 获取版本号 用例
 */
function getVersion($client)
{

	
	echo "版本:". $client->getVersion();
	
}
	
	
/**
 * 取消短信转发 用例
 */	
function cancelMOForward($client)
{

	

	$statusCode = $client->cancelMOForward();
	echo "处理状态码:".$statusCode;
}

/**
 * 短信充值 用例
 */
function chargeUp($client)
{

	
	/**
	 * $cardId [充值卡卡号]
	 * $cardPass [密码]
	 * 
	 * 请通过亿美销售人员获取 [充值卡卡号]长度为20内 [密码]长度为6
	 * 
	 */
	 
	$cardId = 'EMY01200810231542008';
	$cardPass = '123456';
	$statusCode = $client->chargeUp($cardId,$cardPass);
	echo "处理状态码:".$statusCode;
}


/**
 * 查询单条费用 用例
 */
function getEachFee($client)
{

	$fee = $client->getEachFee();
	echo "费用:".$fee;
}


/**
 * 企业注册 用例
 */
function registDetailInfo($client)
{

	
	$eName = "xx公司";
	$linkMan = "陈xx";
	$phoneNum = "010-1111111";
	$mobile = "159xxxxxxxx";
	$email = "xx@yy.com";
	$fax = "010-1111111";
	$address = "xx路";
	$postcode = "111111";
	
	/**
	 * 企业注册  [邮政编码]长度为6 其它参数长度为20以内
	 * 
	 * @param string $eName 	企业名称
	 * @param string $linkMan 	联系人姓名
	 * @param string $phoneNum 	联系电话
	 * @param string $mobile 	联系手机号码
	 * @param string $email 	联系电子邮件
	 * @param string $fax 		传真号码
	 * @param string $address 	联系地址
	 * @param string $postcode  邮政编码
	 * 
	 * @return int 操作结果状态码
	 * 
	 */
	$statusCode = $client->registDetailInfo($eName,$linkMan,$phoneNum,$mobile,$email,$fax,$address,$postcode);
	echo "处理状态码:".$statusCode;
	
}

/**
 * 更新密码 用例
 */
function updatePassword($client)
{

	
	/**
	 * [密码]长度为6
	 * 
	 * 如下面的例子是将密码修改成: 654321
	 */
	$statusCode = $client->updatePassword('654321');
	echo "处理状态码:".$statusCode;
}

/**
 * 短信转发 用例
 */
function setMOForward($client)
{
	


	/**
	 * 向 159xxxxxxxx 进行转发短信
	 */	
	$statusCode = $client->setMOForward('159xxxxxxxx');
	echo "处理状态码:".$statusCode;
}

/**
 * 得到上行短信 用例
 */
function getMO($client)
{

	$moResult = $client->getMO();
	echo "返回数量:".count($moResult);
	foreach($moResult as $mo)
	{
		//$mo 是位于 Client.php 里的 Mo 对象
		// 实例代码为直接输出
	 	echo "发送者附加码:".$mo->getAddSerial();
	 	echo "接收者附加码:".$mo->getAddSerialRev();
	 	echo "通道号:".$mo->getChannelnumber();
	 	echo "手机号:".$mo->getMobileNumber();
	 	echo "发送时间:".$mo->getSentTime();
	 	
	 	/**
	 	 * 由于服务端返回的编码是UTF-8,所以需要进行编码转换
	 	 */
	 	echo "短信内容:".iconv("UTF-8","GBK",$mo->getSmsContent());
	 	
	 	// 上行短信务必要保存,加入业务逻辑代码,如：保存数据库，写文件等等
	}
		
}

/**
 * 短信发送 用例
 */
function sendSMS($client)
{

	/**
	 * 下面的代码将发送内容为 test 给 159xxxxxxxx 和 159xxxxxxxx
	 * $client->sendSMS还有更多可用参数，请参考 Client.php
	 */
	$statusCode = $client->sendSMS(array('159xxxxxxxx','159xxxxxxxx'),"test2测试");
	echo "处理状态码:".$statusCode;
}

/**
 * 发送语音验证码 用例
 */
function sendVoice($client)
{

	/**
	 * 下面的代码将发送验证码123456给 159xxxxxxxx 
	 * $client->sendSMS还有更多可用参数，请参考 Client.php
	 */
	$statusCode = $client->sendVoice(array('159xxxxxxxx'),"123456");
	echo "处理状态码:".$statusCode;
}

/**
 * 余额查询 用例
 */
function getBalance($client)
{

	$balance = $client->getBalance();
	echo "余额:".$balance;
}

/**
 * 短信转发扩展 用例
 */
function setMOForwardEx($client)
{
 

	/**
	 * 向多个号码进行转发短信
	 * 
	 * 以数组形式填写手机号码
	 */	
	$statusCode = $client->setMOForwardEx(
		array('159xxxxxxxx','159xxxxxxxx','159xxxxxxxx')
	);
	echo "处理状态码:".$statusCode;
}
}

    
 