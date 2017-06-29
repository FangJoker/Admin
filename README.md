
# 基于ThinkPHP3.与y开源模板h-ui.admin 搭建的小型后台管理网站  #

---------------------------------------------------
## 实现功能 ##

## **1.管理员登录以及密码修改** ##



- **使用ThinkPHP3.2的Model自动验证与AJAX 异步验证 结合进行 账户密码错误以及验证码错误验证**

 Ajax 请求代码 （位于登录页面 *Admin\View\Welcome\login.html*）
   
     $("form").submit(function() {
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), function(data) {
            if (data.status==1) {
                window.location.href = data.url;
            } else {
                self.find(".error").text(data.info);
                //刷新验证码
                 $(".v").click();
            }
        }, "json");
        return false;
    });



Tp3.2 的success和error方法会自动判断当前请求是否属于Ajax请求，如果属于Ajax请求则会调用ajaxReturn方法返回信息。 ajax方式下面，success和error方法会封装下面的数据返回：
    

1. $data['info']   =   $message; // 提示信息内容
   

1.  $data['status'] =   $status;  // 状态 如果是success是1 error 是0
   

1.  $data['url']    =   $jumpUrl; // 成功或者错误的跳转地址


![](http://i.imgur.com/E7EsESf.png)

- 密码修改功能
详情请见 Welcome控制器里面的 change_password 方法。
这里为了测试就没添加AJAX异步验证，但方法仍然是一样的。

这里提到 修改密码的一个算法是通过主页的的传参
  
    	<li><a href="{:U('Admin/welcome/change_list','','')}?user={$Think.session.Admin_name}">修改密码</a></li>
						</ul>
					</li>
 Welcome控制器里面的change_list方法 通过GET来接收是哪一个用户修改密码
 

----------


##**2.商品的增删改查** ##

![](http://i.imgur.com/79iu2as.png)







- **利用TP3.2自带的 分页方法 对数据进行分页处理**

详情 参考 Product控制器里面的  product_list 方法
这里本人 修改了 TP的分页样式，写在了*ThinkPHP/Commom/function*目录下面 参考以下代码

    function getpage($count, $pagesize = 10) {    //分页重写
    $p = new Think\Page($count, $pagesize);  
    $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
    $p->setConfig('prev', '上一页');  
    $p->setConfig('next', '下一页');  
    $p->setConfig('last', '末页');  
    $p->setConfig('first', '首页');  
    $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
    $p->lastSuffix = false;//最后一页不显示为总页数  
    return $p;  
    }  
 

 
以下是分页CSS 样式

    <style>     
            .pages a,  
            .pages span {  
                display: inline-block;  
                padding: 2px 5px;  
                margin: 0 1px;  
                border: 1px solid #f0f0f0;  
                -webkit-border-radius: 3px;  
                -moz-border-radius: 3px;  
                border-radius: 3px;  

            }  
              
            .pages a,  
            .pages li {  
                display: inline-block;  
                list-style: none;  
                text-decoration: none;  
                color: #58A0D3;  
                margin: 15px;

            }  
              
            .pages a.first,  
            .pages a.prev,  
            .pages a.next,  
            .pages a.end {  
                margin: 3px;  
            }  
              
            .pages a:hover {  
                border-color: #50A8E6;  
            }  
              
            .pages span.current {  
                background: #50A8E6;  
                color: #FFF;  
                font-weight: 700;  
                border-color: #50A8E6;  
            }  

        </style>  

效果图
![](http://i.imgur.com/0y0swJ2.png)



- **商品分类**

这里还用到一个Jquery插件 ztree 方便分类

下面贴出 插件的使用实例代码 （详情见到 *view\Product\product_list.html*）

    var zNodes =[
	{ id:1, pId:0, name:"查看分类",open:true},
	{ id:11, pId:1, name:"学院",open:true},
	{ id:111, pId:11, name:"查看全部", url:"{:U('product/product_list')}",target:'_self', },
	{ id:111, pId:11, name:"计算机学院", url:"{:U('product/product_list_computer')}",target:'_self', },
	{ id:112, pId:11, name:"会计与金融学院" ,url:"{:U('product/product_list_kuaijin')}",target:'_self',},
	{ id:113, pId:11, name:"商学院" ,url:"{:U('product/product_list_shang')}",target:'_self',},
	{ id:114, pId:11, name:"外国语学院", url:"{:U('product/product_list_waiguoyu')}",target:'_self',},
	{ id:111, pId:11, name:"数理土木工程学院",url:"{:U('product/product_list_shuli')}",target:'_self',},
	{ id:112, pId:11, name:"信息学院" ,url:"{:U('product/product_list_xinxi')}",target:'_self',},
	{ id:113, pId:11, name:"航空学院"  ,url:"{:U('product/product_list_hangkong')}",target:'_self',},
	{ id:114, pId:11, name:"工业自动化院" , url:"{:U('product/product_list_gongye')}",target:'_self',},
	{ id:111, pId:11, name:"材料与环境学院", url:"{:U('product/product_list_cailiao')}",target:'_self',},
	{ id:112, pId:11, name:"布莱恩特院" ,url:"{:U('product/product_list_bulaiente')}",target:'_self',},
	{ id:112, pId:11, name:"民商法律学院" ,url:"{:U('product/product_list_falv')}",target:'_self',},
	//{ id:115, pId:11, name:"三级分类"},
	{ id:12, pId:1, name:"学科分类",open:true},
	{ id:111, pId:12, name:"查看全部", url:"{:U('product/product_list')}",target:'_self', },
	{ id:111, pId:12, name:"通用", url:"{:U('product/product_list_tongyong')}",target:'_self', },
	{ id:111, pId:12, name:"高数", url:"{:U('product/product_list_gaoshu')}",target:'_self', },
	{ id:111, pId:12, name:"思政", url:"{:U('product/product_list_sizeng')}",target:'_self', },
	{ id:111, pId:12, name:"专业", url:"{:U('product/product_list_zhuanye')}",target:'_self', },
	{ id:111, pId:12, name:"英语", url:"{:U('product/product_list_yingyu')}",target:'_self', },
	{ id:111, pId:12, name:"物理", url:"{:U('product/product_list_wuli')}",target:'_self', },
	{ id:111, pId:12, name:"文学", url:"{:U('product/product_list_wenxue')}",target:'_self', },
	{ id:111, pId:12, name:"小说", url:"{:U('product/product_list_xiaoshuo')}",target:'_self', },
    ,
	//{ id:121, pId:12, name:"三级分类 1-2-1"},
	//{ id:122, pId:12, name:"三级分类 1-2-2"},
	
    ];

效果图
![](http://i.imgur.com/TzLgcjm.png)

----------


商品发布用到了 插件 webuploader

部分代码如下

    var uploader = WebUploader.create({
		auto: true,
		swf: '_Public_Uploader_swf__Uploader.swf',
	
		// 文件接收服务端。
		server: '{:U('product/UploadFiles')}',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});


详情请参考*Admin\View\Product\procuct_add.html*下的javascript实例代码
后端控制器方法为 Product控制器下的 UploadFiles方法
由于webuploader插件只能每次上传一个文件，想实现多文件上传，多文件的储存地址写入数据库里面，以下是我的算法，注意，不适应于比较多的文件上传。
    
     $time=time();
     $img_time=date('Y-m-d' , $time);
     $bigPicture=$img_time.'/'.$info['multiFile']['savename'];     //拼接图片名字
     $picture='./Uploads/'.$info['multiFile']['savepath'].$info['multiFile']['savename']; //拼接图片地址
     $goodsSmallimg=$img_time.'/'.'small'.$info['multiFile']['savename'];  //拼接生成缩略图的图片地址
     $smallpicture='./Uploads/'.$info['multiFile']['savepath'].'Small'.$info['multiFile']['savename']; //缩略图图片地址
     

     session('Picturetime', $_SESSION['Picturetime']+1); //默认是NULL每次上传了一个文件+1
     $Picturetime=$_SESSION['Picturetime'];

     switch ($Picturetime) {                 //分支语句来判断是第几个文件
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
     
     
再写入数据库*product控制器下面的writepicture方法*

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

当然在每次进入发布页面的时候都要情况SESSION值*product控制器的add方法*
                
    session('bigPicture', null);
     session('bigPicture', null);
      session('goodsSmallimg', null);
       session('picture', null);
        session('smallpicture', null);
         session('bigPicture2', null);
          session('bigPicture3', null);


效果图
![](http://i.imgur.com/Fv1a08R.png)
![](http://i.imgur.com/KiEK7UQ.png)

--------------------------------------------

## **3.基于ThinkPHP3.2 与插件 Highcharts 实现展示近七天数据增减变化情况** ##

第一步下载插件 Highcharts。

第二步 在控制器封装好Ajax 返回的数据

先说明一下 数据库字段   

![](http://i.imgur.com/yHna7ot.png)  

![](http://i.imgur.com/i7ednRa.png) 

以下是控制器代码*Product控制器下chartslist方法*

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
  
    $map4['goods_creat_date']=array('between',array($time6,    $time5)); //用tp的between操作来查询时间段的数据
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

    $map3['goods_creat_date']=array('between',array($time7,   $time6)); //用tp的between操作来查询时间段的数据
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
          ``


}

以下是返回json数据和JS代码
![](http://i.imgur.com/sPpqQjA.png)

    $(function () {
       $.ajax({
                type: 'GET',
                url: '{:U('Product/Chartslist')}',
                dataType: 'json',
                success: function(data){
                
           
           Highcharts.chart('container', {
            title: {
                text: '近七天各类书本发布情况',
                x: -20 //center
            },
            subtitle: {
                text: 'By 海贝Tv 研发部',
                x: -20,
       
            },
            xAxis: {
                categories: ['七天前', '六天前', '五天前', '四天前', '三天前', '两天前','七天前', '一天前'],
              
            },
            yAxis: {
                title: {
                    text: '数量 (本)'
                },
                plotLines: [{
                    value: 0,
                    width: 2,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '本'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 1
            },
            series: [{
                name: '高数',
                data: [parseInt(data.day1.gaoshu),parseInt(data.day2.gaoshu),parseInt(data.day3.gaoshu),parseInt(data.day4.gaoshu),parseInt(data.day4.gaoshu),parseInt(data.day6.gaoshu),parseInt(data.day7.gaoshu)]
            }, {
                name: '英语',
                data: [parseInt(data.day1.yingyu),parseInt(data.day2.yingyu),parseInt(data.day3.yingyu),parseInt(data.day4.yingyu),parseInt(data.day4.yingyu),parseInt(data.day6.yingyu),parseInt(data.day7.yingyu)]
            }, {
                name: '思政',
                data: [parseInt(data.day1.sizheng),parseInt(data.day2.sizheng),parseInt(data.day3.sizheng),parseInt(data.day4.sizheng),parseInt(data.day4.sizheng),parseInt(data.day6.sizheng),parseInt(data.day7.sizheng)]
            }, {
                name: '通用',
                data: [parseInt(data.day1.tongyong),parseInt(data.day2.tongyong),parseInt(data.day3.tongyong),parseInt(data.day4.tongyong),parseInt(data.day4.tongyong),parseInt(data.day6.tongyong),parseInt(data.day7.tongyong)]   
            }]
        });
    
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });    
    
    });
   

好了到这里整个后台的主要功能实现方法大致说明完毕。请大家多多指教。 
