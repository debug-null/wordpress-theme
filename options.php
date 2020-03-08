<?php
function optionsframework_option_name() {

	// 从样式表获取主题名称
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	$imagepath =  get_template_directory_uri() . '/img/';

	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	$notice_array = array(
		'info' => __('一般', 'options_framework_theme'),
		'success' => __('成功', 'options_framework_theme'),
		'warning' => __('警告', 'options_framework_theme'),
		'danger' => __('危险', 'options_framework_theme'),
	); 
	if($_SERVER['SERVER_NAME'] == '127.0.0.1' or $_SERVER['SERVER_NAME'] == 'localhost'){
		$url_initial = 'localhost';
	}else{
		$url_initial = $_SERVER['SERVER_NAME'];
	}
	$www = array('com','cn','net','org','gov');
	$a_a = explode('.', $url_initial);
	$r_r = array();
	$r_r[] = array_pop($a_a);
	$r_r[] = array_pop($a_a);
	if(in_array($r_r[1], $www)){
		$newcom = array_pop($a_a);
		$r_r[1] = $newcom .'.'. $r_r[1];
	}
	$keyps = $r_r[1].'.'.$r_r[0];
	
	if(of_get('key')){
		$kk = Q_is(of_get('key'));
	}else{
		$kk['state'] = false;
		$kk['kong'] = true;
	}
	
	$options = array();

	$options[] = array(
		'name' => __('基本设置', 'options_framework_theme'),
		'icon' => 'gears',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('Logo', 'options_framework_theme'),
		'id' => 'logoPic',
		'type' => 'upload');

    $options[] = array(
        'name' => __('个人头像', 'options_framework_theme'),
        'desc' => __('个人头像，目前仅在博主念叨页面显示', 'options_framework_theme'),
        'id' => 'avatar',
        'type' => 'upload');
    $options[] = array(
        'name' => __('QQ链接', 'options_framework_theme'),
        'desc' => __('一键调用QQ SDK,用于打开聊天窗口', 'options_framework_theme'),
        'id' => 'qqLink',
        'type' => 'text');
    $options[] = array(
        'name' => __('微信名片', 'options_framework_theme'),
        'desc' => __('微信名片', 'options_framework_theme'),
        'id' => 'wxBusinessCard',
        'type' => 'upload');
    $options[] = array(
        'name' => __('个人邮箱', 'options_framework_theme'),
        'id' => 'email',
        'type' => 'text');
    


	$options[] = array(
		'name' => __('app icon 图片', 'options_framework_theme'),
		'desc' => __('144像素x144像素 app - icon 当被用户收藏网站后在收藏夹显示的图标', 'options_framework_theme'),
		'id' => 'app_icon',
		'type' => 'upload');



	$options[] = array(
			'name' => __('备案号', 'options_framework_theme'),
			'desc' => __('如果是境内网站可在此输入备案号', 'options_framework_theme'),
			'id' => 'record',
			'std' => '',
			'type' => 'text');

	

	$options[] = array(
		'name' => __('SEO设置', 'options_framework_theme'),
		'icon' => 'desktop',
		'type' => 'heading');

	$options[] = array(
		'name' => __('关键词', 'options_framework_theme'),
		'desc' => __('请用英文逗号分隔', 'options_framework_theme'),
		'id' => 'keywords',
		'std' => '未来博客',
		'type' => 'text');

	$options[] = array(
		'name' => "网站描述",
		'desc' => "",
		'id' => "description",
		'std' => "未来博客",
		'type' => 'textarea');

	$options[] = array(
		'name' => __('头部预留', 'options_framework_theme'),
		'desc' => __( '用于加载统计代码，或者其他 ', 'options_framework_theme' ),
		'id' => 'headtext',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$options[] = array(
		'name' => __('底部预留', 'options_framework_theme'),
		'desc' => __( '此位置在 body 之前 ', 'options_framework_theme' ),
		'id' => 'footertext',
		'type' => 'editor',
		'settings' => $wp_editor_settings );


	$options[] = array(
			'name' => __('文章页设置', 'options_framework_theme'),
			'icon' => 'book',
			'type' => 'heading');

    $options[] = array(
        'name' => __('微信收款码', 'options_framework_theme'),
        'id' => 'weichatPay',
        'type' => 'upload');
    
    $options[] = array(
            'name' => __('支付宝收款码', 'options_framework_theme'),
            'id' => 'zfbPay',
            'type' => 'upload');

    $options[] = array(
            'name' => __('侧边栏个人旁白', 'options_framework_theme'),
            'desc' => __( '首页侧边栏下的文字 ', 'options_framework_theme' ),
            'id' => 'asideNarration',
            'type' => 'text');

    $options[] = array(
            'name' => __('文章详情页个人旁白', 'options_framework_theme'),
            'desc' => __( '详情页下的文字 ', 'options_framework_theme' ),
            'id' => 'articleNarration',
			'type' => 'text');

	$options[] = array(
		'name' => __('mylife页面', 'options_framework_theme'),
		'desc' => __( 'mylife页面-名字 ', 'options_framework_theme' ),
		'id' => 'masterName',
		'type' => 'text');
	$options[] = array(
			'name' => __('mylife页面', 'options_framework_theme'),
			'desc' => __( 'mylife页面-职位 ', 'options_framework_theme' ),
			'id' => 'masterJob',
			'type' => 'text');
	$options[] = array(
		'name' => __('mylife页面', 'options_framework_theme'),
		'desc' => __( 'mylife页面-座右铭 ', 'options_framework_theme' ),
		'id' => 'masterMotto',
		'type' => 'text');


	$options[] = array(
		'name' => __('广告设置', 'options_framework_theme'),
		'icon' => 'book',
		'type' => 'heading');

	$options[] = array(
		'name' => __('右侧博客广告', 'options_framework_theme'),
		'id' => 'blogAdv',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
	
	
	return $options;
}
