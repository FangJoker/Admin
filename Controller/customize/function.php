<?php 
	//作者：Gavin Github:https://github.com/PowerDos
	// function testF(){
	// 	echo "123";
	// }  //测试
	//检测用户信息
	function Check(){
		if(!session("?userOpenid")){
			$data=getOpenid();
			session('userOpenid',$data);
		}else{
			$data=session('userOpenid');
		}
		$model=M();
		if($rst=$model->table('wUserInfo')->where("openid='{$data}'")->select()){
			//设置SESSION
			setSession($rst[0]);
			return true;
		}else{
			//设置临时变量
			if(!session("?status")){
				unset($_GET['code']);
				session("status","1");
			}
			//获取用户所以信息
			getUserInfo();
		}
	}

	//获取用户openid
	function getOpenid(){
		if(!$_GET['code']){
			//获取当前的url地址
			$rUrl="http://"._URL_.__ACTION__;
			$rUrl=urlencode($rUrl);
			$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid="._APPID_."&redirect_uri=".$rUrl."&response_type=code&scope=snsapi_base&state=123456#wechat_redirect";
			//跳转页面
			redirect($url,0);
		}else{
			$aUrl="https://api.weixin.qq.com/sns/oauth2/access_token?appid="._APPID_."&secret="._APPSECRET_."&code=".$_GET['code']."&grant_type=authorization_code";
			//获取网页授权access_token和openid等
			$data=getHttp($aUrl);
			return $data['openid'];
		}
	}

	//获取用户详细信息
	function getUserInfo(){
		if(!$_GET['code']){
			//获取当前的url地址
			$rUrl="http://"._URL_.__ACTION__;
			$rUrl=urlencode($rUrl);
			$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid="._APPID_."&redirect_uri=".$rUrl."&response_type=code&scope=snsapi_userinfo&state=123456#wechat_redirect";
			//跳转页面
			redirect($url,0);
		}else{
			$getOpenidUrl="https://api.weixin.qq.com/sns/oauth2/access_token?appid="._APPID_."&secret="._APPSECRET_."&code=".$_GET['code']."&grant_type=authorization_code";
			//获取网页授权access_token和openid等
			$data=getHttp($getOpenidUrl);
			$getUserInfoUrl="https://api.weixin.qq.com/sns/userinfo?access_token=".$data['access_token']."&openid=".$data['openid']."&lang=zh_CN";
			//获取用户数据
			$userInfo=getHttp($getUserInfoUrl);
			//默认设置头像是132*132的
			$userInfo['headimgurl']=substr($userInfo['headimgurl'],0,strlen($userInfo['headimgurl'])-1);
			$userInfo['headimgurl']=$userInfo['headimgurl'].'132';
			// 将信息插入数据库
			$userInfo['addtime']=date("Y-m-d H:i:s");
			//删除language元素
			unset($userInfo['language']);
			$model=M();
			if($model->table('wUserInfo')->data($userInfo)->add()){
				setSession($userInfo);
				session("status",null);
			}else{
				echo "验证错误";
			}
		}
	}

	//设置SESSION
	function setSession($data){
		session('userOpenid',$data['openid']);
		session('userNickname',$data['nickname']);
		session('userSex',$data['sex']);
		session('userHeadimgurl',$data['headimgurl']);
		session('userID',$data['stuID']);
	}

	//获取access_token
	function getAccess_token(){
		//检查access_token是否存在
		if(!S('access_token'))
		{
			//URL
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid="._APPID_."&secret="._APPSECRET_;
			//get请求
			$data=getHttp($url);
			//缓存access_token
			S('access_token',$data['access_token'],7000);
			return S('access_token');
		}else{
			return S('access_token');
		}	
	}
	//获取jsapi_ticket
	function getJsapi_ticket($jsUrl){
		//检查jsapi_ticket是否存在
		 if(!S('jsapi_ticket')){
			//获取access_token
			$access_token=getAccess_token();
			//jsapi_ticket获取地址
			$jsdkUrl="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
			//获取jsapi_ticket
			$jsapi_ticket=getHttp($jsdkUrl);
			//随机字符串
			$noncestr=_NONCESTR_;
			//时间戳获取
			$time=time();
			//jsapi_ticket签名生成
			$str="jsapi_ticket={$jsapi_ticket['ticket']}&noncestr={$noncestr}&timestamp={$time}&url={$jsUrl}";
			$str=sha1($str);
			//缓存签名
			S('jsapi_ticket',$str,7000);
			//缓存签名生成时间
			S('jsTime',$time,7000);
			//返回签名与时间戳
			$workOut['jsapi_ticket']=S('jsapi_ticket');
			$workOut['jsTime']=S('jsTime');
			return $workOut;
		}else{
			$workOut['jsapi_ticket']=S('jsapi_ticket');
			$workOut['jsTime']=S('jsTime');
			return $workOut;
			}	
	}
	//获取素材
	function gettConnection($media_id){
		//遍历media_id
		foreach ($media_id as $key) {
	    //获取地址拼接
		$access_token=getAccess_token();
		$url="https://api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$key}";
		echo $url;
		echo "<br>";
		//获取素材信息
		$Connection=getHttp($url);
 		//设置请求的下载文件的url
      	$riqi = date("Y-m-d");
        $Lpath = _PHOTODOWN_.$riqi;
        if (!file_exists($Lpath)){
            mkdir($Lpath,0777); 
        }  
        //以时间戳为命名
        $time=time();
        //保存到本地的文件路径
        $path = $Lpath."/{$time}.jpg";
        echo $path;
        //初始化请求，设置请求，获取回复,关闭会话
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        //将文件内容写入本地文件
        file_put_contents($path, $data);
        //延时100微秒避免时间戳相同
	    usleep(100);
	    }
		

	}
	function getTest(){
		$url ="https://api.weixin.qq.com/cgi-bin/media/get?access_token=as4bW8vxJaY4R9opfcBM680LauUb_LPZDY1NvohjRw7FjWnD65Id2zQGzX20t3Sg9axBetMTIgRLxh8-MxjKOJ_LJiCY8q_EKQsF8UfrlqR5-zkz6lhFDgtL_agp0nHmKLNiAIABCE&media_id=7znme4YPotkN6F_HeMWTtSd4enY-RLk0zqKbB_IV8aUbwRO8VQrHbXITefLs6Erb";
        //保存到本地的文件路径
        $path ="./Application/Admin/View/User/imgs/321.jpg";
        echo $path;
        //初始化请求，设置请求，获取回复,关闭会话
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        //将文件内容写入本地文件
        file_put_contents($path, $data);
	}
	//get请求
	function getHttp($url){
		$ch=curl_init();
		//设置传输地址
		curl_setopt($ch, CURLOPT_URL, $url);
		//设置以文件流形式输出
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//接收返回数据
		$data=curl_exec($ch);
		curl_close($ch);
		$jsonInfo=json_decode($data,true);
		return $jsonInfo;
	}
	
	//post请求
	function postHttp($url,$json){
		$ch=curl_init();
		//设置传输地址
		curl_setopt($ch, CURLOPT_URL, $url);
		//设置以文件流形式输出
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//设置已post方式请求
	 	curl_setopt($ch, CURLOPT_POST, 1);
	 	//设置post文件
 	 	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		$data=curl_exec($ch);
		curl_close($ch);
		$jsonInfo=json_decode($data,true);
		return $jsonInfo;
	}
