<?php 
/**
 *  Template Name: 关于博主
 *  Description: 关于博主 *
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
                    <legend><i class="fa fa-user-circle" aria-hidden="true"></i> <?php the_title() ?></legend>
                    <div class="layui-field-box">
                        <?php echo $content ?>
                    </div>
                  
                 
                </fieldset>
				
            </div>
		
		</div>
	</div>




<?php get_footer(); ?>
