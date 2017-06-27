<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
import("customize.function",dirname(__FILE__),".php");//调用同目录下的customize\function.php类
import("customize.wechatDown",dirname(__FILE__),".php");
import('ORG.Net.Http');
class UserController extends Controller {
  ///test
  public function test(){
    $this->display('weixin');
  }
  //签名生成
  public function getUserInfo(){
    Check();
  }
  public function getTicket(){
      //传入执行地址
      $jtUrl="http://tv.zhbit.com/secondHand/Admin/User/getTicket";
      //获取签名和时间戳
      $testJsdk=getJsapi_ticket($jtUrl);
      $signature=$testJsdk['jsapi_ticket'];
      $time=$testJsdk['jsTime'];
      //生成微信签名信息
      $data['appId']=_APPID_;
      $data['time']=$time;
      $data['nonceStr']=_NONCESTR_;
      $data['signature']=$signature;
      $this->assign('data',$data);
      $this->display('jssdkTest');
  }
  public function getWecat(){
    $getWecat=$_POST["media_id"];//获取media_id
    var_dump($getWecat);
    gettConnection($getWecat);//进行素材获取
  }
    //视图模板的调用
   // public function add(){
   //    $this->display();
   //  }
    //  public function main(){
    //   $this->display();
    // }
    //数据的创建
    public function create(){
    	$user = M ('User'); //使用在名为think_php的dataes中的think_user表;
    	var_dump($user->create());//创建数据放入$uer中，以数组的形式打印出来;
    }
    //数据的新增
   
    public function addcont(){
    	$user = M ('User');//使用在名为think_php的dataes中的think_user表;
      $upload = new \Think\Upload();
    	$data=$user->create();//创建数据放入$uer中;
    	// $result =$user->add();//将$uer中的数据新增到thingk_user表中;
    	// echo "<p><a href=" {:U(Admin/User/main),'','')}"  >上传成功返回上级菜单</a></p>";//设置返回菜单
      // 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =     './Application/Admin/View/User/imgs/'; // 设置附件上传根目录
      $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
      $info   =   $upload->upload();
      $savePhoto=$info['photo']['savepath'].$info['photo']['savename'];
      $data['photo'] = $savePhoto;
      $result =$user->add($data);
   
       if($result){
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        $this->success('新增成功', 'main');
      } else {
          //错误页面的默认跳转页面是返回前一页，通常不需要设置
          $this->error('新增失败');
      }
    }
    //数据的读取
    
    public function select(){
      $user = M ('User');
      //$workout=$user->select();//打印所有的数据;
      // session_start();//建立session存储数据
      // $_SESSION["temp"]=$workout;//传递数组
      $list = $user->select();
      $this->assign('list',$list);
      //$this->display('test');
      $this->display('look');

      // var_dump($user->find());//搜索到的第一条数据;
      // var_dump($user->getField('user'));//获取第一条数据的user字段;
      // var_dump($user->getField('user',true));//获取所有数据的user字段;
      // var_dump($user->getField('id,user'),2);
    }
    //数据的修改
    // public function new(){
    //    $this->display('new');
    // }
    public function getid(){
      $map=$_GET['id'];
      $this->assign('map',$map);
      $this->display("new");
    }
    public function save(){
    	$user = M ('User');//使用在名为think_php的dataes中的think_user表;
      $map['id']=$_POST['id'];
      $upload = new \Think\Upload();
      $data=$user->create();//创建数据放入$uer中;
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =     './Application/Admin/View/User/imgs/'; // 设置附件上传根目录
      $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
      $info   =   $upload->upload();
      $savePhoto=$info['photo']['savepath'].$info['photo']['savename'];
      $data['photo'] = $savePhoto;
    	 $result=$user->where($map)->save($data);//保存修改内容
    // $this->success('修改成功', 'select');
    //	echo '<p><a href="_HTML_look.html">修改成功返回上级菜单</a></p>';//设置返回菜单
       if($result){
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        $this->success('修改成功', 'select');
      } else {
          //错误页面的默认跳转页面是返回前一页，通常不需要设置
          $this->error('修改失败');
      }
   }
   //数据的删除
   public function delete(){
   		$user = M ('User');
   		$map=$_GET['id'];//获取地址栏的id值
   		$result=$user->delete($map);//删除id为map的数据
      //$this->display('look');
   		// $user->delete('2,3');//删除id为2.3的数据
   		if($result){
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        $this->success('修改成功', 'select');
      } else {
          //错误页面的默认跳转页面是返回前一页，通常不需要设置
          $this->error('修改失败');
      }
   }
   //数据查询
   public function check(){
   		$user = M ('User');
   		$num=$_POST['select'];//传递select栏的value值
		$check=$_POST['check'];//获取文本内容
		if($num==0)//判断所查询的类别
			$map['user']=array('like',"%$check%");
		else 
			if($num==1)
				$map['title']=array('like',"%$check%");
			else 
				if($num==2){
					$map['content']=array('like',"%$check%");
				}		
				else
					$map['time']=array('like',"%$check%");

		//$workout=$user->where($map)->select();//进行模糊查询
     $list = $user->where($map)->select();
     // echo count($listt);
     // $this->assign('list',$list);
		if(empty($list))//进行搜索结果判断
			$this->error('无搜索结果','check',3);
		else{
			// session_start();//建立session存储数据
			// $_SESSION["temp"]=$workout;//传递数组
      $this->assign('list',$list);
			$this->display('look');//显示结果页面
		}
		//var_dump($workout);//结果输出
   }




   public function upload(){
      $user = M ('User');
      $upload = new \Think\Upload();
      $data=$user->create();//创建数据放入$uer中;
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =     './Application/Admin/View/User/imgs/'; // 设置附件上传根目录
      $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
      $info   =   $upload->upload();
      $savePhoto=$info['photo']['savepath'].$info['photo']['savename'];
      $data['photo'] = $savePhoto;
    }
}
