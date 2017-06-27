<?php
namespace Admin\Model;

class AdminModel extends \Think\Model {
 
	
	


	public function checkUser($nm,$psw){
  //根据nm 判断用户名是否存在
  //有则返回信息 没有就返回null

  $info=$this->where("Admin_name='$nm'")->find();
  if ($info) {
  	 if ($info['Admin_password']===$psw) {
  	 	 return $info;
  	 }else{
  	 	return NULL;
  	 }
  }
}


}




