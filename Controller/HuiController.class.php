<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class HuiController extends Controller {
	public function test(){
      // $User = M('User');
      // $list = $User->select();
      // $this->assign('list',$list);
      $this->display('welcome');
	
  }
}