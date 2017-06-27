<?php
namespace Admin\Model;
//array(字段，验证字段，验证规则，错误提示[验证条件，附加规则，验证时间）]


class GoodsModel extends \Think\Model {
    protected $_validate =   array(
    	array( 'goods_name', 'require', '商品名称不能为空'),
    	array('goods_price' ,'currency', '请填写正确的价格格式'),
    	array('goods_owner_tel', 11, '手机号码格式不正确',0,'length'),
    	array('goods_owner_idnumber',12, '学号格式不正确',0,'length'),
        array('goods_belong','require', '请选择学院归属'),
        array('way','require', '请选择交易方式'),
        array('goodsKinds','require', '请选择商品类别'),
      

       );  // 自动验证定义
    

    protected $_auto     =   array();  // 自动完成定义
    protected $_map      =   array();  // 字段映射定义
    protected $_scope    =   array();  // 命名范围定义
	
	
}