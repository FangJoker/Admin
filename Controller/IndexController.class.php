<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){

     $login = session('Admin_name');
     $Status = session('Status');
     $Online = session('Online');
      if (empty($login)){
           $this->redirect('admin/welcome/login');
     }else{
           switch ($Status) {
           case  '1': 
           $this->display(); if ($Online=='yes') {
             break; 
           } else{
               session('Admin_name', null);break;
           } 
           case  '2': $this->display('index2');if ($Online=='yes') {
               break;
           }else{
             session('Admin_name', null);break;
           }         
           
           default: $this->display('NotFound');break;           
         }
     } 
   
}


  
}