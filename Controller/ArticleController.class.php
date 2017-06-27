<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {
   
    function ArticleList(){
      $this->display();
    }

    function ArticleAdd(){
    	$this->display();
    }
}