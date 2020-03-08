<!DOCTYPE HTML>
<html class="no-js">
<head>
<meta charset="UTF-8"UTF-8"">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="google-site-verification" content="DW8ROJKL3tBANCDQEPSxJYp22luiSVh_HpKDZDOwI68" />
<title>
<?php 

if (is_home()||is_search()) { bloginfo('name'); } 

else{wp_title(''); echo ' | '; bloginfo('name');} 

?> 
</title>
<meta name="description" content="<?php echo of_get('description') ?>"/>
<meta name="keywords" content="<?php echo of_get('keywords'); ?>>"/>
<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/usr/static/layui/css/layui.css">
<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/usr/static/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/style.css">
<?php echo of_get("headtext")?>
<?php wp_site_icon() ?>
<meta name="Author" contect="shiyanbin">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">
      <h1><a href="/"><i class="fa fa-home"></i><span><?php bloginfo("name") ?></span></a></h1>
    </div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left layui-hide-xs">
      <li class="layui-nav-item side-switch"><a href="javascript:;"><i class="fa fa-dedent"></i></a></li>
      <li class="layui-nav-item"><a href="/">首页</a></li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item layui-hide-xs">
					<?php get_search_form(); ?>
      </li>
		<li class="layui-nav-item side-btn layui-hide-sm layui-this"><a href="javascript:;"><i class="fa fa-bars"></i></a></li>
    </ul>
  </div>
  <div class="side layui-bg-black" id="sidebar-nav">
    <div class="side-logo">
      <h1><a href="/"  title=""><i class="fa fa-home"></i><span> <?php bloginfo("name") ?></span></a></h1>
    </div>
    <div class="layui-side-scroll">
      <div class="user-side">
        <img src="<?php echo of_get('logopic') ?>" alt="logo" class="side-upic" height="80px" >
        <div class="t-t">
       
          <p>
           <?php echo of_get('asidenarration') ?>
          </p>
          <span><i class="fa fa-map-marker"></i> China</span>
        </div>
        <div class="t-i">
          <a href="javascript:;" target="_blank" rel="nofollow" class="wxbusinesscard"><i class="fa fa-weixin fa-fw"></i>
          <div class="wxbusinesscard_box">
            <img  src="<?php echo of_get('wxbusinesscard') ?>" alt="扫一扫">
          </div>
          </a>
          <a href="<?php echo of_get('qqlink') ?>" rel="nofollow" target="_blank"><i class="fa fa-qq fa-fw"></i></a>
          <a href="mailto:<?php echo of_get('email') ?>" rel="nofollow"><i class="fa fa-envelope fa-fw"></i></a>
        </div>
      </div>
      <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="nav">
        <li class="layui-nav-item"><a href="/"><i class="fa fa-circle-o fa-fw"></i><span>首页</span></a></li>
      
        <li class="layui-nav-item layui-nav-itemed"><a href="javascript:;" class="nav-item-a"><i class="fa fa-fw fa-lemon-o"></i><span>类别</span><span class="layui-nav-more"></span></a>

            <?php 
               wp_nav_menu( array(
                'theme_location'  => 'sidebar-menu',//导航别名
                'menu'   => '', //期望显示的菜单
                'container'  => '',  //容器标签
                'container_class' => '',//ul父节点class值
                'container_id'  => '',  //ul父节点id值
                'menu_class'   => 'layui-nav-child',   //ul节点class值
                'menu_id'   => 'scroll2',  //ul节点id值
                'echo'  => true,//是否输出菜单，默认为真
                'fallback_cb' => 'wp_page_menu',  //菜单不存在时，返回默认菜单，设为false则不返回
                'before' => '', //链接前文本
                'after'  => '', //链接后文本
                'link_before'  => '<i class="fa fa-angle-right"></i>',   //链接文本前
                'link_after'  => '',//链接文本后
                'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',   //如何包装列表
                'depth' => 1,   //菜单深度，默认0
                'walker' => ''  //自定义walker
              ) );

          ?> 

        </li>
        <!--循环输出独立页面-->
        <li class="layui-nav-item">
        <a href="javascript:;" class="nav-item-a"><i class="fa fa-fw fa-smile-o"></i><span>页面</span><span class="layui-nav-more"></span></a>
      
        <?php 
                wp_nav_menu( array(
                  'theme_location'  => 'sidebar-page',//用于在调用导航菜单时指定注册过的某一个导航菜单名，如果没有指定，则显示第一个
                  'menu'   => '', //期望显示的菜单,如果有多菜单的情况下，可以通过menu参数去选择，一般输入菜单名称或菜单id
                  'container'  => '',  //容器标签
                  'container_class' => '',//ul父节点class值
                  'container_id'  => '',  //ul父节点id值
                  'menu_class'   => 'layui-nav-child',   //ul节点class值
                  'menu_id'   => 'scroll2',  //ul节点id值
                  'echo'  => true,//是否输出菜单，默认为真
                  'fallback_cb' => 'wp_page_menu',  //菜单不存在时，返回默认菜单，设为false则不返回
                  'before' => '', //链接前文本
                  'after'  => '', //链接后文本
                  'link_before'  => '<i class="fa fa-angle-right"></i>',   //链接文本前
                  'link_after'  => '',//链接文本后
                  'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',   //如何包装列表
                  'depth' => 0,   //菜单深度，默认0
                  'walker' => ''  //自定义walker
                ) );


            ?> 
    


       
      
    </div>
  </div>    

