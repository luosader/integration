<?PHP 
	//创瑞短信接口
	header("Content-Type: text/html; charset=UTF-8");

	$flag = 0; 
	$params='';//要post的数据 
	$verify = rand(123456, 999999);//获取随机验证码		
	$_SESSION['verifyreg'] = $verify;//
	//以下信息自己填以下
	$mobile=$_POST['phone'];//手机号
	$argv = array( 
		'name'=>'13721062013',     //必填参数。用户账号
		'pwd'=>'8A2CAEC8F7F7F960C1B6280BBAC4',     //必填参数。（web平台：基本资料中的接口密码）
		'content'=>'尊敬的：'.$mobile.'，您的验证码为：'.$verify.'，请勿泄露【寻辰威客】',   //必填参数。发送内容（1-500 个汉字）UTF-8编码
		'mobile'=>$mobile,   //必填参数。手机号码。多个以英文逗号隔开
		'stime'=>'',   //可选参数。发送时间，填写时已填写的时间发送，不填时为当前时间发送
		'sign'=>'',    //必填参数。用户签名。
		'type'=>'pt',  //必填参数。固定值 pt
		'extno'=>''    //可选参数，扩展码，用户定义扩展码，只能为数字
	); 
	//print_r($argv);exit;
	//构造要post的字符串 
	//echo $argv['content'];
	foreach ($argv as $key=>$value) { 
		if ($flag!=0) { 
			$params .= "&"; 
			$flag = 1; 
		} 
		$params.= $key."="; $params.= urlencode($value);// urlencode($value); 
		$flag = 1; 
	} 
	$url = "http://web.cr6868.com/asmx/smsservice.aspx?".$params; //提交的url地址
	$con= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态
	
	if($con == '0'){
		echo "<script>alert('发送成功!');</script>";
	}else{
		echo "<script>alert('发送失败!');history.back();</script>";
	}
	
	//GBK编码时需要转换
	function convertUTF8($str){
		if(empty($str)) return '';
		// return  iconv('GBK', 'UTF-8', $str);//转成UTF-8
		return $str;
	}

	/**
		示远科技
	*/
	function mysend_yoursms($mobile,$content,$captcha){
		$user_id = urlencode(C('mobile_username')); // 这里填写用户名
		$pass = urlencode(C('mobile_pwd')); // 这里填登陆密码
		if(!$mobile || !$content || !$user_id || !$pass) return false;
		if(is_array($mobile)) $mobile = implode(",",$mobile);
		$mobile=urlencode($mobile);
		//$content=$content."【我的网站】";
		$content=urlencode($content);
		// $pass =md5($pass);//MD5加密
		$url="http://send.18sms.com/msg/HttpBatchSendSM?account=".$user_id."&pswd=".$pass."&mobile=".$mobile."&msg=".$content."&needstatus=true";

// $url = "http://send.18sms.com/msg/HttpBatchSendSM?account=vr14e0&pswd=6D4xpE4i&mobile=18715511536&msg=您好，您的验证码：".$verify."&needstatus=true"; //提交的url地址
// http://pushUrl?receiver=admin&pswd=12345&msgid=12345&reportTime=1012241002&mobile=13900210021&status=DELIVRD;
// 	$url = "http://send.18sms.com/msg/QueryBalance?account=vr14e0&pswd=6D4xpE4i"; // 查余额
// 	echo "<pre>";
// 	$text = '20161008103826,0
// 4186886,20017';
// 	$a = explode(',', $text);
// 	// print_r($a);
// 	$b = substr($text, 15, 1);
// 	echo $b;
// 	echo file_get_contents($url);
// 	die;

		$res = substr( file_get_contents($url), 15, 1 );  //获取信息发送后的状态
		//return $res;
		$ok=$res=="0";
		if($ok){ return true; }
		return false;
	}

?>