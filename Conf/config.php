<?php
return array(

'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'thinkphp',
	'DB_USER'=>'root',
	'DB_PWD'=>'qiao1998',
	'DB_PORT'=>3306,        	//端口号
	'DB_PREFIX'=>'think_' , 	//表前缀


	//这是定义模板替换的参数
	'TMPL_PARSE_STRING'  =>array(
     	'_Public_'=>'/secondHand/Admin/Public',
		'H-UI_MIN_CSS'=>'/static/h-ui/css/',
		'H-ui_admin_css'=>'/static/h-ui.admin/css/',
		'iconfont_css'=>'/lib/Hui-iconfont/1.0.8/',
		'skin_css'=>'/static/h-ui.admin/skin/default/',
		'style_css'=>'/static/h-ui.admin/css/',
		'jquery_min_js'=>'/lib/jquery/1.9.1/',
		'layer_js'=>'/lib/layer/2.4/',
		'H-ui_min_js'=>'/static/h-ui/js/',
		'H-ui_admin_js'=>'/static/h-ui.admin/js/',  //后台
		 'webuploader_css_'=>'/lib/webuploader/0.1.5/',
		 'Uploader_swf_'=>'lib/webuploader/0.1.5/Uploader.swf',
		 'fileupload_php_'=>'lib/webuploader/0.1.5/server/fileupload.php',
 
       
         
        '_Locallhost_'=>'http://tv.zhbit.com/secondHand/Uploads/Home/view/User/imgs/',
     //'_Locallhost_'=>'http://localhost/secondHand/Uploads/Home/view/User/imgs/',




	),
	
	


    //'SHOW_PAGE_TRACE' =>true,  //显示跟踪信息
    'DEFAULT_MODULE'=>'Home',  //默认模块为HOME
    'MODULE_ALLOW_LIST'=> array('Home'  ), //允许访问的模块。







   

);
