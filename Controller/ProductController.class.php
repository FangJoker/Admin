<?php
namespace Admin\Controller;
header('Content-Type:text/html;charset=utf-8');  // php中文说明
error_reporting( 0 );

class ProductController extends \Think\Controller {
	
  

  public function product_brand(){
		$this->display();
	}

	public function product_category(){
		$this->display();
	}

	public function product_category_add(){
		$this->display();
	}

//商品展示
	public function product_list(){
		 
     if (!empty($_SESSION['Admin_id'])) {
       $goods=M('goods');
      $total=$goods->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->select();
     /* //1.获得总页数
     $total=$goods->count(); $per=3; 
      
       
     //2.实例化分页类对象
       $page_obj=new \Think\Page($total, $per);

      //4.分页显示输出
       $page=$page_obj->show();

     //3.获得每一页信息
     $list=$goods->order('goods_id desc')->limit($page_obj->firstRow, $page_obj->listRows)->select();
      
     
      //5.给模板赋值
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->assign('total', $total);
        */
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display();

     }else{
       $this->redirect('admin/welcome/login');
     }
      
			
	}

  public function product_list_cailiao(){
      if (!empty($_SESSION['Admin_id'])) {
       
      $goods=M('goods');
      $where="'材料与环境学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
   
        
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
      
      
  }
	
  public function product_list_gongye(){
       
       if (!empty($_SESSION['Admin_id'])) {
      $goods=D('goods'); 
     $where="'工业自动化学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      } 
      
      
  }
  public function product_list_hangkong(){
    
      if (!empty($_SESSION['Admin_id'])) {
       $goods=M('goods');
      $where="'航空学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }

      

      
  }
  
   public function product_list_kuaijin(){
    
     if (!empty($_SESSION['Admin_id'])) {
          $goods=M('goods');
      $where="'会计与金融学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }

   

      
  }

  public function product_list_computer(){
    
       if (!empty($_SESSION['Admin_id'])) {
         $goods=M('goods');
      $where="'计算机学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
       $this->assign('total', $total);
       $this->display('product_list');


      }else{
        $this->redirect('admin/welcome/login');
      }


  }
  
  public function product_list_falv(){
    
     if (!empty($_SESSION['Admin_id'])) {
       
  $goods=M('goods');
      $where="'民商法律学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
    

      
  }

  public function product_list_shang(){
    
     if (!empty($_SESSION['Admin_id'])) {
       
    $goods=M('goods');
      $where="'商学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
  

      
  }
  
 public function product_list_sheji(){
    
     if (!empty($_SESSION['Admin_id'])) {
       $goods=M('goods');
      $where="'设计与艺术学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }
      

      
  }

  public function product_list_shuli(){
    
       if (!empty($_SESSION['Admin_id'])) {
       
   $goods=M('goods');
      $where="'数理与土木工程学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }

      
  }

  public function product_list_waiguoyu(){
    
     if (!empty($_SESSION['Admin_id'])) {
       
  $goods=M('goods');
      $where="'外国语学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }
    
      
  }
 
 public function product_list_xinxi(){
    
      if (!empty($_SESSION['Admin_id'])) {
       
  $goods=M('goods');
      $where="'信息学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
     
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }


      
  }

  public function product_list_bulaiente(){
    
       if (!empty($_SESSION['Admin_id'])) {
       
   $goods=M('goods');
      $where="'布莱恩特学院'";
      $total=$goods->where('goods_belong='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goods_belong='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }


      
  }
    public function product_list_gaoshu(){
     if (!empty($_SESSION['Admin_id'])) {
       
$goods=M('goods');
      $where="'高数'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }
      
      
  }
   public function product_list_tongyong(){
    
      $goods=M('goods');
      $where="'通用'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      
  }
   public function product_list_sizeng(){
     if (!empty($_SESSION['Admin_id'])) {
       
  $goods=M('goods');
      $where="'思政'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
    

      
  }
   public function product_list_zhuanye(){
     if (!empty($_SESSION['Admin_id'])) {
        $goods=M('goods');
      $where="'专业'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }
     

      
  }
   public function product_list_yingyu(){
     if (!empty($_SESSION['Admin_id'])) {
       
 $goods=M('goods');
      $where="'英语'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
     

      
  }

    public function product_list_wuli(){
     if (!empty($_SESSION['Admin_id'])) {
       
  $goods=M('goods');
      $where="'物理'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }
    
      
  }

    public function product_list_xiaoshuo(){
     if (!empty($_SESSION['Admin_id'])) {
       
$goods=M('goods');
      $where="'小说'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
      
      
  }

    public function product_list_wenxue(){
     if (!empty($_SESSION['Admin_id'])) {
       
  $goods=M('goods');
      $where="'文学'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');
      }else{
        $this->redirect('admin/welcome/login');
      }
    

      
  }

    public function product_list_qita(){
     if (!empty($_SESSION['Admin_id'])) {
        $goods=M('goods');
      $where="'其他'";
      $total=$goods->where('goodskinds='.$where)->count();
      $p=getpage($total,6);
      $list=$goods->order('goods_id desc')->limit($p->firstRow, $p->listRows)->where('goodskinds='.$where)->select();
   
       $page=$p->show();
       $this->assign('page', $page);
       $this->assign('list', $list);
      $this->assign('total', $total);
       $this->display('product_list');

      }else{
        $this->redirect('admin/welcome/login');
      }
     
      
  }

  //增加商品信息
	public function product_add(){
		 if (!empty($_SESSION['Admin_id'])) {
      $Picturetime=0;
        session('Picturetime', $Picturetime);    
            $this->display();
      }else{
        $this->redirect('admin/welcome/login');
      }
		
		  
	}
	public function add(){
		 
      $goods= D('goods');
        if (!empty($_POST)) {  

          if ($_SESSION['bigPicture']) {
             
           $shuju=$goods->create();          
        
         if ($shuju) {
           
            if ($id=$goods->add($shuju)) {
                   
                session('id',$id);
                  
                       $time=time();           
                  $creat_time=date('Y-m-d-H-i-s' , $time);  //获得商品创建时间
                  $lastId=$goods->getLastInsId();   //获得最后插入ID
                  $goods->goods_creat_date=$creat_time; //把发布时间写入数据库
                  $goods->where('goods_id='.$lastId)->save();      //AR方式修改。
            
                  $this->writepicture();
                  session('bigPicture', null);
                  session('bigPicture', null);
                   session('goodsSmallimg', null);
                   session('picture', null);
                    session('smallpicture', null);
                     session('bigPicture2', null);
                      session('bigPicture3', null);
                 
                 
               }

              $this->success('商品信息添加操作成功', '/secondHand/admin/product/product_list',3);  

        }else {
             $this->error($goods->getError(),'/secondHand/admin/product/product_add');
           }

          }else{

            $this->error('至少上传一张图片');
          }



        }
           else{
        	  $this->error('内容不能为空','/secondHand/admin/product/product_add');
        }

	  
	}
  public function UploadFiles(){
    
 
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     'Home/view/User/imgs/'; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {  // 上传错误提示错误信息
          $this->error($upload->getError());

    }else{// 上传成功
         
       session('info', $info);
         
      }
   
     $time=time();
     $img_time=date('Y-m-d' , $time);
     $bigPicture=$img_time.'/'.$info['multiFile']['savename'];     //图片1
     $picture='./Uploads/'.$info['multiFile']['savepath'].$info['multiFile']['savename'];
     $goodsSmallimg=$img_time.'/'.'small'.$info['multiFile']['savename'];
     $smallpicture='./Uploads/'.$info['multiFile']['savepath'].'Small'.$info['multiFile']['savename'];
     

     session('Picturetime', $_SESSION['Picturetime']+1);
     $Picturetime=$_SESSION['Picturetime'];

     switch ($Picturetime) {
       case 1:
         session('bigPicture', $bigPicture);
         session('goodsSmallimg', $goodsSmallimg);
         session('picture', $picture);
         session('smallpicture', $smallpicture);
         break;
       case 2:
         session('bigPicture2', $bigPicture);
         break;
         case 3:
           session('bigPicture3', $bigPicture);
         break;
      
     }
     
   

}


public function writepicture(){

  $goods=new \Admin\Model\GoodsModel;
     $bigPicture=$_SESSION['bigPicture'];
     $bigPicture2=$_SESSION['bigPicture2'];
     $bigPicture3=$_SESSION['bigPicture3'];
     $goodsSmallimg=$_SESSION['goodsSmallimg'];
     $picture=$_SESSION['picture'];
     $smallpicture=$_SESSION['smallpicture']; 
      
         
           $goods->goods_img1=$bigPicture;  
       
           $goods->goods_img2=$bigPicture2;  
         
           $goods->goods_img3=$bigPicture3;
     
           $goods->goods_smallImg=$goodsSmallimg;   //把图片地址写入数据库*/
         

   $lastId=$_SESSION['id'];   //获得最后插入ID
     $goods->where('goods_id='.$lastId)->save();      //AR方式修改。
  
        
    $image = new \Think\Image(); 
       $image->open($picture);
        // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg到smallPicture的地址    
          $image->thumb(200, 150)->save($smallpicture);
          
}




 
   //商品编辑

   public function edit(){
  if (!empty($_SESSION['Admin_id'])) {
       
      $id=$_SESSION['id'];

      $goods=D('goods');
   if (!empty($_POST)) {
       
        $shuju=$goods->create(); //触发自动验证
            if ($shuju) {
               $goods->where('goods_id='.$id)->save();
   
              $this->success('操作成功', '/secondHand/admin/product/product_list',2);
          } else{
             $this->error($goods->getError());
          }     
                     
    } else{
        $this->error('内容不能为空','/secondHand/admin/product/product_edit',5);
    } 
    session('id', null);
      }else{
        $this->redirect('admin/welcome/login');
      }
     
 
  
 }
    public function product_edit(){
      $id=$_GET['id'];
      session('id', $id);
       if (!empty($_SESSION['Admin_id'])) {
        $goods=D('goods'); 
  
              $info=$goods->where('goods_id='.$id)->select(); $this->assign('info', $info);
                 
                    $this->display();
      }else{
        $this->redirect('admin/welcome/login');
      }
   
   
	}
    

    
   //商品删除
  	public function Delete(){
      if (!empty($_SESSION['Admin_id'])) {
       
$Model = D('goods');
     $map=$_POST['id'];
     $z=$Model->where('goods_id='.$map)->delete();
     if ($z) {
      $this->success('操作成功','/secondHand/admin/product/product_list' ,3);
     }else{
      $this->error('操作失败','/secondHand/admin/product/product_list' ,3);
     }
      
      }else{
        $this->redirect('admin/welcome/login');
      }
     

  	}
	
   //批量删除
    public function DataDelete(){
      if (!empty($_SESSION['Admin_id'])) {
       
  $Model = D('goods');
      $getid= $_POST['ids'];//获取选择的复选框的值
     
       if (!$getid) {
         $this->error('没有选择商品！','Admin/product/product_list');
       }else{
            $getids = explode(',', $getid); 
       }
        if(is_array($getid)){
            $where = 'goods_id in('.implode(',',$getid).')';
        }else{
            $where = 'goods_id='.$getid;
        }
        
        $list=$Model->where($where)->delete();
        if($list!==false) {
            $this->success("成功删除{$list}条！",U('Admin/product/product_list'),5);
         
        }else{
            $this->error('删除失败！');
        }
      }else{
        $this->redirect('admin/welcome/login');
      }
   
       
  	}
   

   

 // 商品下架  goods_status=1为上架， =0为下架
  public function Down (){
    if (!empty($_SESSION['Admin_id'])) {
   $goods=D('goods');    
   $id=$_POST['id'];
       $goods->goods_publish="已下架";
         $goods->where('goods_id='.$id)->save();
      }else{
        $this->redirect('admin/welcome/login');
      } 
  


  }
  
  

  public function chartsList(){
  $goods=D('goods');
  //获得当前时间戳
  $nowtime=date("Y-m-d-H-i-s", time());  

 
  //获取第一天
  $time1=date("Y-m-d H:i:s", strtotime("-1 day")); 
  $map['goods_creat_date']=array('between',array($time1,$nowtime)); //用tp的between操作来查询时间段的数据
  $map['goodsKinds']=array('eq','高数');                           
   
  $map2['goods_creat_date']=array('between',array($time1,$nowtime)); //用tp的between操作来查询时间段的数据
  $map2['goodsKinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time1,$nowtime)); //用tp的between操作来查询时间段的数据
  $map3['goodsKinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time1,$nowtime)); //用tp的between操作来查询时间段的数据
  $map4['goodsKinds']=array('eq','通用');

   $gaoshu1=$goods->where($map)->count();
     $sizheng1=$goods->where($map2)->count();
      $yingyu1=$goods->where($map3)->count();
       $tongyong1=$goods->where($map4)->count();

  //获取第二天
  $time2=date("Y-m-d H:i:s", strtotime("-2 day")); 
  $map['goods_creat_date']=array('between',array($time2,$time1)); //用tp的between操作来查询时间段的数据
  $map['goodsKinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time2,$ime1)); //用tp的between操作来查询时间段的数据
  $map2['goodskinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time2,$time1)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time2,$time1)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']=array('eq','通用');

   $gaoshu2=$goods->where($map)->count();
     $sizheng2=$goods->where($map2)->count();
      $yingyu2=$goods->where($map3)->count();
       $tongyong2=$goods->where($map4)->count();

  //获取第三天
   $time3=date("Y-m-d H:i:s", strtotime("-3 day")); 
  $map['goods_creat_date']=array('between',array($time3,$time2)); //用tp的between操作来查询时间段的数据
  $map['goodskinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time3,$time2)); //用tp的between操作来查询时间段的数
  $map2['goodskinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time3,$time2)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time3,$time2)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']=array('eq','通用');

   $gaoshu3=$goods->where($map)->count();
     $sizheng3=$goods->where($map2)->count();
      $yingyu3=$goods->where($map3)->count();
       $tongyong3=$goods->where($map4)->count();
     
   //获取第四天
 $time4=date("Y-m-d H:i:s", strtotime("-4 day")); 
  $map['goods_creat_date']=array('between',array($time4,$time3)); //用tp的between操作来查询时间段的数据
  $map['goodskinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time4,$time3)); //用tp的between操作来查询时间段的数据
  $map2['goodskinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time4,$time3)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time4,$time3)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']=array('eq','通用');
   $gaoshu4=$goods->where($map)->count();
     $sizheng4=$goods->where($map2)->count();
      $yingyu4=$goods->where($map3)->count();
       $tongyong4=$goods->where($map4)->count();

  //获取第五天
 $time5=date("Y-m-d H:i:s", strtotime("-5 day")); 
  $map['goods_creat_date']=array('between',array($time5,$time4)); //用tp的between操作来查询时间段的数据
  $map['goodskinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time5,$time4)); //用tp的between操作来查询时间段的数据
  $map2['goodskinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time5,$time4)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time5,$time4)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']=array('eq','通用');

   $gaoshu5=$goods->where($map)->count();
     $sizheng5=$goods->where($map2)->count();
      $yingyu5=$goods->where($map3)->count();
       $tongyong5=$goods->where($map4)->count();
       
  //获得第六天

 $time6=date("Y-m-d H:i:s", strtotime("-6 day")); 
  $map['goods_creat_date']=array('between',array($time6,$time5)); //用tp的between操作来查询时间段的数据
  $map['goodskinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time6,$time5)); //用tp的between操作来查询时间段的数据
  $map2['goodskinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time6,$time5)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time6,$time5)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']=array('eq','通用');

   $gaoshu6=$goods->where($map)->count();
     $sizheng6=$goods->where($map2)->count();
      $yingyu6=$goods->where($map3)->count();
       $tongyong6=$goods->where($map4)->count();      

//获得第七天

 $time7=date("Y-m-d H:i:s", strtotime("-7 day")); 
  $map['goods_creat_date']=array('between',array($time7,$time6)); //用tp的between操作来查询时间段的数据
  $map['goodskinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time7,$time6)); //用tp的between操作来查询时间段的数据
  $map2['goodskinds']=array('eq','思政');

  $map3['goods_creat_date']=array('between',array($time7,$time6)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']=array('eq','英语');
  
  $map4['goods_creat_date']=array('between',array($time7,$time6)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']=array('eq','通用');

   $gaoshu7=$goods->where($map)->count();
     $sizheng7=$goods->where($map2)->count();
      $yingyu7=$goods->where($map3)->count();
       $tongyong7=$goods->where($map4)->count();



     
       //封装好Ajax返回信息
         $data=array('day1' =>array('gaoshu' =>$gaoshu1 ,'tongyong'=>$tongyong1, 'sizheng' => $sizheng1,
          'yingyu'=>$yingyu1) , 'day2'=>array('gaoshu' =>$gaoshu2 ,'tongyong'=>$tongyong2, 'sizheng' => $sizheng2,
          'yingyu'=>$yingyu2),'day3'=>array('gaoshu' =>$gaoshu3 ,'tongyong'=>$tongyong3, 'sizheng' => $sizheng3,
          'yingyu'=>$yingyu3), 'day4'=>array('gaoshu' =>$gaoshu4 ,'tongyong'=>$tongyong4, 'sizheng' => $sizheng4,
          'yingyu'=>$yingyu4), 'day5'=>array('gaoshu' =>$gaoshu5 ,'tongyong'=>$tongyong5, 'sizheng' => $sizheng5,
          'yingyu'=>$yingyu5), 'day6'=>array('gaoshu' =>$gaoshu6 ,'tongyong'=>$tongyong6, 'sizheng' => $sizheng6,
          'yingyu'=>$yingyu6), 'day7'=>array('gaoshu' =>$gaoshu7 ,'tongyong'=>$tongyong7, 'sizheng' => $sizheng7,
          'yingyu'=>$yingyu7)
           );

            $this->ajaxReturn($data); 
          


}

function test(){
$goods=D('goods');
  $nowtime=date("Y-m-d-H-i-s", time());
  /*$time=mktime(0,0,0,date("m"),01,date("Y"));  //获取当前月份的第一天 的时间戳
  $starttime=date("Y-m-d-H-i-s", $time);      //格式化时间戳*/

 
  //获取第一天
   $time7=date("Y-m-d H:i:s", strtotime("-2 day")); 
  $map['goods_creat_date']=array('between',array($time7,$nowtime)); //用tp的between操作来查询时间段的数据
  $map['goodsKinds']=array('eq','高数');
  
  $map2['goods_creat_date']=array('between',array($time7,$nowtime)); //用tp的between操作来查询时间段的数据
  $map2['goodskinds']="思政";

  $map3['goods_creat_date']=array('between',array($time7,$nowtime)); //用tp的between操作来查询时间段的数据
  $map3['goodskinds']="'英语'";
  
  $map4['goods_creat_date']=array('between',array($time7,$nowtime)); //用tp的between操作来查询时间段的数据
  $map4['goodskinds']="'通用'";
  
    $gaoshu7=$goods->where($map)->select();
     $sizheng7=$goods->where($map2)->select();
      $yingyu7=$goods->where($map3)->count();
       $tongyong7=$goods->where($map4)->count();

 
  var_dump($gaoshu7);
  var_dump($map);
}
}