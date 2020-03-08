<?php

#######################################################################
############################- 加载主题设置 -############################
######################################################################
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
    require_once dirname(__FILE__) . '/inc/options-framework.php';
}


function register_my_menus() {
    register_nav_menus(
      array(
        'sidebar-menu' => '侧边栏导航',
        'sidebar-page' => '侧边栏页面',
      )
    );
  }
add_action( 'init', 'register_my_menus' );

//载入小工具选项
if ( function_exists('register_sidebar') )

    register_sidebar(array(

        'before_widget' => '<div class="sidebox">    ',

        'after_widget' => '</div>',

        'before_title' => '<h2>',

        'after_title' => '</h2>',

    ));
 

//提取页面中第一张图片,用特色图片代替
// function catch_that_image() {

//     global $post, $posts;
 
//     $first_img = '';
//     ob_start();
//     ob_end_clean();
//     $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
     
//     //获取文章中第一张图片的路径并输出
//     $first_img = $matches [1] [0];
//     //如果文章无图片，获取自定义图片
     
//     if(empty($first_img))
//     { //Defines a default image
//         // $first_img = bloginfo('template_url')."/res/images/1.jpg";
//         $first_img  = false;
//     }
     
//     return $first_img;
// }




// //自定义编辑器代码框
// add_action('media_buttons', 'weilai_custom_code');
// wp_enqueue_script('media_button', get_bloginfo( 'stylesheet_directory' ) . '/usr/static/js/weilai_public.js', array('jquery'), '4.0', true);

// function weilai_custom_code() {
//     echo '<select name="weilai_code_box" id="weilai_code_box">
//             <option value="-1">自定义代码</option>
//             <option value="HTML">HTML</option>
//             <option value="JavaScript">JavaScript</option>
//             <option value="PHP">PHP</option>
//             <option value="Node">Node</option>
//         </select>';
    
// }


//使WordPress支持post thumbnail
//add post thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}
 
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'customized-post-thumb', 100, 120 );
}

//文章访问量
function getPostViews($postID){
   
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    echo intval($count);
}
//设置访问量
function setPostViews($postID) {
   
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
   
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


/* 获取文章的评论人数 by zwwooooo | zww.me */
function comments_users_count($postid=0,$which=0) {
    $comments = get_comments('status=approve&type=comment&post_id='.$postid); //获取文章的所有评论
	if ($comments) {
        return count($comments);
	}
	return 0; //没有评论返回0
}



//输出标签云
function Tagno($text) {
    $text = preg_replace_callback('|<a (.+?)</a>|i', 'tagnoCallback', $text);
    return $text;
}
function tagnoCallback($matches) {
    $text=$matches[1];
    preg_match('|title=(.+?)style|i',$text ,$a);
    preg_match("/[0-9]+/",$a[1],$a);
    return "<a class='layui-btn layui-btn-xs layui-bg-gray'".$text."</a>";
}
add_filter('wp_tag_cloud', 'Tagno', 1);
//输出标签云 END


//增加分类下对应的文章数量
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after.'<span class="layui-badge layui-bg-gray">'.get_category($item->object_id)->count.'</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


//博主念叨  
add_action('init', 'blogger_mood');
function blogger_mood()
{ 
    $labels = array( 
    'name' => '说说',
    'singular_name' => '说说',
    'add_new' => '发表说说',
    'add_new_item' => '发表说说',
    'edit_item' => '编辑说说',
    'new_item' => '新说说',
    'view_item' => '查看说说',
    'search_items' => '搜索说说',
    'not_found' => '暂无说说',
    'not_found_in_trash' => '没有已遗弃的说说',
    'parent_item_colon' => '', 'menu_name' => '说说' );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'exclude_from_search' =>true,
        'query_var' => true,
        'rewrite' => true, 'capability_type' => 'post',
        'has_archive' => false, 'hierarchical' => false,
        'menu_position' => null,
        'taxonomies'=> array('category','post_tag'),
        'supports' => array('editor','author','title', 'custom-fields','comments') 
   );
    register_post_type('shuoshuo',$args);
}

//输出面包屑
function get_breadcrumbs()  
{  
    global $wp_query;  
    if ( !is_home() ){  
    
        // Add the Home link  
        echo '<a href="'. get_settings('home') .'">Home</a>';  
    
        if ( is_category() )  
        {  
            $catTitle = single_cat_title( "", false );  
            $cat = get_cat_ID( $catTitle );  
            echo "&raquo; ". get_category_parents( $cat, TRUE, " &raquo; " ) ;  
        }  
        elseif ( is_archive() && !is_category() )  
        {  
            echo " <a> Archives</a>";  
        }  
        elseif ( is_search() ) {  
           
            echo "<a> Search Results</a><a>".get_search_query()."</a>";  
        }  
        elseif ( is_404() )  
        {  
            echo "<a> 404 Not Found</a>";  
        }  
        elseif ( is_single() )  
        {  
            $category = get_the_category();  
            $category_id = get_cat_ID( $category[0]->cat_name );  
         
            echo  get_category_parents( $category_id, TRUE );  
            echo '<a class="layui-hide-xs"><cite>' . the_title('','', FALSE) ."</cite></a>";  
        }  
        elseif ( is_page() )  
        {  
            $post = $wp_query->get_queried_object();  
    
            if ( $post->post_parent == 0 ){  
    
                echo "&raquo; ".the_title('','', FALSE);  
    
            } else {  
                $title = the_title('','', FALSE);  
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );  
                array_push($ancestors, $post->ID);  
    
                foreach ( $ancestors as $ancestor ){  
                    if( $ancestor != end($ancestors) ){  
                        echo '&raquo; <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a>';  
                    } else {  
                        echo '&raquo; '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'';  
                    }  
                }  
            }  
        }  
    
       
    } 
    
    
}  


//评论提交改写
// 用于single中的comment_form()函数 中的参数
$commentFields =  array(
    'author' =>
    '<p class="layui-col-md4">
    <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' class="layui-input" placeholder="* 怎么称呼" /></p>',

    'email' =>
    '<p class="layui-col-md4">
    <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' class="layui-input" placeholder="* 邮箱(放心~会保密~.~)" /></p>',

    'url' =>
    '<p class="layui-col-md4">
    <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" class="layui-input" placeholder="http://您的主页"/></p><p>&nbsp;</p>'
);

$commentArgs = array(
'id_form'           => 'commentform',
'class_form'      => 'comment-form',
'id_submit'         => 'submit',
'class_submit'      => 'submit',
'name_submit'       => 'submit',
'title_reply_before' => '<h4 id="response"><i class="fa fa-meh-o"></i> ',
'title_reply_after'  => '</h4><br/>',
'title_reply'       => __( 'Leave a Reply' ),
'title_reply_to'    => __( 'Leave a Reply to %s' ),
'cancel_reply_link' => __( 'Cancel Reply' ),
'label_submit'      => __( 'Post Comment' ),
'format'            => 'xhtml',
'id_form'	=> 'comment-form',
'class_form' =>  'layui-form',
'class_submit' => 'layui-btn layui-btn-green',
'comment_field'   => '<textarea rows="5" cols="30" name="comment" id="textarea" placeholder="嘿~ 大神，别默默的看了，快来点评一下吧" class="layui-textarea" required=""></textarea><br/>',				  				
'comment_notes_before' => '',					  
'fields' => apply_filters( 'comment_form_default_fields', $commentFields ),
);
//评论提交 END

// 评论列表
function mytheme_comment($comment, $args, $depth) {
    
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? 'comment-body comment-parent comment-odd comment-children' : 'parent' ); ?> id="comment-<?php comment_ID() ?> " ><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body pl-dan comment-txt-box"><?php
    } ?>
        <div class="comment-author vcard t-p comment-author"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            ?>
        </div>
        <?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        <div class="t-u comment-author">
             <?php printf( __( '<strong>%s <span class="layui-badge layui-bg-cyan"></span></strong>' ), get_comment_author_link() ); ?>
           
             <div class="t-s">
					<p>
                     <?php comment_text(); ?>
					</p>
			</div>

            <span class="t-btn">

                <?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'],
                        ) 
                    ) 
                ); 
                ?>
            </span>
            <span class="t-g"><?php comment_date() ?></span>
            

          <?php  edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
        </div>

        


        <?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}


// 评论列表  END
 

//自定义评论头像
add_filter( 'avatar_defaults', 'newgravatar' );  
function newgravatar ($avatar_defaults) {  
    $myavatar = get_bloginfo('template_directory') . '/images/wpdaxue-gravatar.jpg';  
    $avatar_defaults[$myavatar] = "WordPress大学 默认头像";  
    return $avatar_defaults;  
}

//自定义评论头像 end


//说说（念叨）板块的条数
function shuoshuoCount(){
    $shuoshuoInfo = query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=-1");
    return $shuoshuoInfo ? count($shuoshuoInfo): 0;
};


// //mylife文章访问量
function getPostViewsMylife($postID){
   
    $count_key = 'post_views_mylife_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    echo intval($count);
}
//mylife设置访问量
function setPostViewsMylife($postID) {
   
    $count_key = 'post_views_mylife_count';
    $count = get_post_meta($postID, $count_key, true);
   
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//启用友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );


// 自定义代码高亮按钮
function appthemes_add_quicktags() {
    if (wp_script_is('quicktags')){
        ?>
        <script type="text/javascript">
            QTags.addButton( 'syz_fieldset', '字段集区块', '<fieldset class="layui-elem-field layui-field-title"><legend>字段集区块 - 横线风格</legend><div class="layui-field-box">', '内容区域</div></fieldset>', 'o', 'HTML 代码高亮');
            QTags.addButton( 'syz_HTML', 'HTML', '<pre><code class="language-markup">', '</code></pre>', 'h', 'HTML 代码高亮');
            QTags.addButton( 'syz_CSS', 'CSS', '<pre><code class="language-css">', '</code></pre>', 'c', 'CSS 代码高亮');
            QTags.addButton( 'syz_Js', 'JavaScript', '<pre><code class="language-javascript">', '</code></pre>', 'j', 'JavaScript 代码高亮');
            QTags.addButton( 'syz_node', 'Node', '<pre><code class="language-Node">', '</code></pre>', 'j', 'Node 代码高亮');
            QTags.addButton( 'syz_PHP', 'PHP', '<pre><code class="language-php">', '</code></pre>', 'c', 'PHP 代码高亮');
            QTags.addButton( 'syz_Bash', 'Bash', '<pre><code class="language-bash">', '</code></pre>', 'b', 'Bash 代码高亮');
            QTags.addButton( 'eg_nextpage', '下一页', '<!--nextpage-->', '', 'n', '下一页', 131 )
        </script>
        <?php
    }
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );


//富文本引用外部样式
function qot_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'qot_add_editor_styles' );

//富文本添加字体和字体大小
add_filter('mce_buttons_2', 'add_mce_buttons');
function add_mce_buttons( $buttons ){
    array_unshift( $buttons,'fontselect','fontsizeselect' );
    return $buttons;
}

//添加自定义样式按钮,受TinyMCE Advanced插件的影响，无法使用
// Callback function to insert 'styleselect' into the $buttons array
// function my_mce_buttons_2( $buttons ) {
// 	array_unshift( $buttons, 'styleselect' );
// 	return $buttons;
// }
// // Register our callback to the appropriate filter
// add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );
// // Callback function to filter the MCE settings
// function my_mce_before_init_insert_formats( $init_array ) {  
// 	// Define the style_formats array
// 	$style_formats = array(  
// 		// Each array child is a format with it's own settings
// 		array(  
// 			'title' => '引用区域',  
// 			'block' => 'blockquote',  
// 			'classes' => 'layui-elem-quote',
// 			'wrapper' => false,
			
// 		)
// 	);  
// 	// Insert the array, JSON ENCODED, into 'style_formats'
// 	$init_array['style_formats'] = json_encode( $style_formats );  
	
// 	return $init_array;  
  
// } 
// // Attach callback to 'tiny_mce_before_init' 
// add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  

//添加自定义样式按钮 end