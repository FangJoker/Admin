<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class WelcomeController extends Controller {
    public function welcome(){
	  $this->display('charts');

    }

    public function Login(){
       
       $Admin=D('admin');
       if ($data=$Admin->create()) {
       	 
       	 if ($Admin->add($date) ) {
         	 $this->success('注册成功', '', 3);
         } else{
         	$this->error('注册失败', '', 3);
         }

       }
      
       $this->display();
    }

    public function verify(){

    $Verify = new \Think\Verify();
    $verify->fontSize =20;
    $verify->expire=60;
    $Verify->length   = 4;
   
    $Verify->entry();
    
  
    }


    public function denglu(){
      $Admin=D('admin');

     if (!empty($_POST)) {
        $nm=$_POST['Admin_name'];
      $domain = strstr($nm, "'");
           if ($domain) {
              $this->error('含有非法字符', '/secondHand/Admin/welcome/login',2);
                     
           }
     else{ 
      $info=$Admin->where("admin_name='$nm'")->find();  }
      //根据nm 判断用户名是否存在
        //有则返回信息 没有就返回null

      $Verify = new \Think\Verify();
      if ($Verify->check($_POST['verify'])) {

           $domain = strstr($nm, "'");
           if ($domain) {
              $this->error('含有非法字符', '/secondHand/Admin/welcome/login',2);
             
           }
       
           if ($info['admin_password']==$_POST['Admin_password']) {

            //session($name, $value) 持久化用户信息， 跳转到后台
            session('Admin_id', $info['admin_id']);
            session('Admin_name', $info['admin_name']);
            session('Status', $info['status']);
          

            $online=$_POST['online'];
            session('Online', $online);       
            //redirect('/secondHand/index.php/admin/Index');
            $this->success('','/secondHand/index.php/Admin/Index');
            
           
          }else{
            $this->error('用户名或者密码错误');
        
       }
            
   }else{
       $this->error('验证码错误');
    }
   
     }else{
       $this->error("内容不能为空");
     }
}

 


  public function Down(){
      session('Admin_name', null);
      session('Admin_id', null);
       $this->success('正在退出...','/secondHand/Admin/welcome/login',2);
         $time=time();
            $t=date('Y-m-d-H:i:s' , $time);
            session('time', $t);
   }

  public function change_list(){
     $user=$_GET['user'];
     session('user', $user);
     $this->display();

  }
  
  public function change_password(){
    $User=D('admin'); $Verify = new \Think\Verify();
    
    $nm=session('user'); $name="'$nm'";
     
     $info=$User->where("admin_name='$nm'")->find();  
      
      if ($Verify->check($_POST['verify']) ) {
         
           if ( $info['admin_password']==$_POST['admin_password'] ){
                
                 if ($_POST[New_admin_password]==$_POST['New_admin_password2']) {
                    
                    $User->Admin_password=$_POST[New_admin_password];
                     if ( !( strlen($_POST['New_admin_password']) >16 ) ) {
                         
                         if ($User->where('Admin_name='.$name)->save()) {
                       
                            $this->success('修改成功！', '/secondHand/Admin/welcome/login',3);
                               
                                session('user', null);
                     }else{                                                                                                                       
                            $this->error('修改失败！', '/secondHand/Admin/welcome/change_list?user='.$nm, 3);
                    }
         
                 }else{
                        $this->error('密码长度不能大于16位', '/secondHand/Admin/welcome/change_list?user='.$nm, 3);
                 }
 
                    
          }else{
            $this->error('确认密码不一致！','/secondHand/Admin/welcome/change_list?user='.$nm, 3);
            
          }
    }   else{
          $this->error('原始密码错误！','/secondHand/admin/welcome/change_list?user='.$nm,3);
    }

   }else{
       //$this->error('验证码错误');

    }

}
  


}

