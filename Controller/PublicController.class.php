<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function _header(){
	  $this->display();
	}

   public function _footer(){
   	 $this->display();
    }

    public function _menu(){
    	$this->display();
    }

    public function _meta(){
    	$this->display(); 
    }
   
   
  
}