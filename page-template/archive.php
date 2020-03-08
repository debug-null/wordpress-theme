<?php 
/**
 *  Template Name: 文章归档
 *  Description: 文章归档 *
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
                    <legend><i class="fa fa-list-alt"></i> <?php the_title() ?></legend>
					<div class="archives">

							<div class="title-page">
								<p>目前共计 <?php $count_posts = wp_count_posts();  
											echo $publish_posts = $count_posts->publish;
											 ?> 
								篇日志，共 <?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?>   条评论，加油啊~</p>
							</div>
							<ul class="layui-timeline">
					<?php

					$the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章

					$year=0;$mon=0;
					while ( $the_query->have_posts() ) : $the_query->the_post();
							$year_tmp = get_the_time('Y');
							$mon_tmp = get_the_time('m');
							
							if($year_tmp != $year)
							{
								echo '<fieldset class="layui-elem-field layui-field-title">
									<legend>'.$year_tmp.' 年</legend>
								</fieldset>';
							 
							};
							if($mon_tmp != $mon)
							{
								echo '<li class="layui-timeline-item"><i class="layui-icon layui-timeline-axis"></i>
								<div class="layui-timeline-content">
									<h3 class="layui-timeline-title">'.$year_tmp.'年'.''. $mon_tmp .'月</h3>';
							 
							};

							echo '<p>
								<a href="'.get_permalink().'" title="'.get_the_title().' ">'.get_the_title().' <small><i class="fa fa-heart-o"></i> '.get_the_time().'日发布，共'.get_comments_number('0', '1', '%').'条评论</small></a>
							</p>';
							
							$year = $year_tmp;
							$mon = $mon_tmp;
							if($mon_tmp != $mon)
							{
								echo '</div>
								</li>';
							 
							};
							


					endwhile;

					?>
					<li class="layui-timeline-item">
						<i class="layui-icon layui-timeline-axis"></i>
						<div class="layui-timeline-content layui-text">
							<div class="layui-timeline-title">一切的开始</div>
						</div>
					</li>
					</ul>
					</div>
                </fieldset>
				
            </div>
		
		</div>
	</div>




<?php get_footer(); ?>
