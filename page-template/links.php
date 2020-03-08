<?php 
/**
 *  Template Name: 友情链接
 *  Description: 友情链接 *
 *   @package Bouquet
 */
get_header();
?>

<?php

$id= get_the_ID();//这里是文章的ID

$content = get_post($id)->post_content; // 获取文章内容

setPostViews($id );
?>

<div class="layui-body">
	<!-- 默认面包屑 -->
	<div class="layui-fluid map">
    
    </div>

	<!-- 默认面包屑  end-->
	<div class="layui-fluid main-wp">
		<div class="layui-row main layui-col-space15">
			<div class="content layui-col-md12 layui-col-lg12">
				<!-- 文章内容 -->
				<div class="title-article">
                <fieldset class="layui-elem-field" style="border-radius:4px;">
                    <legend><i class="fa fa-link" aria-hidden="true"></i> <?php the_title() ?></legend>
                    <div class="layui-field-box">
                        <?php echo $content ?>
                    </div>
                    <div class="links-typecho">
                  

                    <ul class="layui-col-space10">
                        <?php $bookmarks = get_bookmarks();
                            if ( !empty($bookmarks) ){
                              
                                foreach ($bookmarks as $bookmark) {
                                        echo '<li class="layui-col-md2 layui-col-xs6">
                                        <a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '"><div class="t-p"><img src="' . $bookmark->link_image . '" class="attachment-thumbnail size-thumbnail wp-post-image" alt="'. $bookmark->link_name .'"  /></div><b>'.$bookmark->link_name .'</b><span>'.$bookmark->link_notes.'</span></a></li>';
                                }
                            }
                        ?>    
                    </ul>

                    </div>
                 
                </fieldset>
				
            </div>
		
		</div>
	</div>




<?php get_footer(); ?>
