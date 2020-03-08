<?php /**
 * WordStar single post file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
?>
<?php get_header(); ?>
<?php

$acticleId= get_the_ID();//这里是文章的ID

$content = get_post($acticleId)->post_content; // 获取文章内容

setPostViews($acticleId );
?>

<div class="layui-body">
	<!-- 默认面包屑 -->
	<div class="layui-fluid map">
		<span class="layui-breadcrumb">
			<?php if (function_exists('get_breadcrumbs')){get_breadcrumbs(); } ?>  
		</span>
    </div>

	<!-- 默认面包屑  end-->
	<div class="layui-fluid main-wp">
		<div class="layui-row main layui-col-space15">
			<div class="content layui-col-md9 layui-col-lg10">
				<!-- 文章内容 -->
				<div class="title-article">
					<h1><?php the_title() ?> </h1>
					<div class="title-msg">
						<span><i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name', $post->post_author );?></span>
						<span><i class="fa fa-clock-o"></i> <?php the_time("Y-m-d") ?> </span>
						<span><i class="fa fa-eye"></i> <?php echo getPostViews( $acticleId );?> 次</span>
						<span><i class="fa fa-comments-o"></i> <?php echo comments_users_count( $acticleId  ); ?>条</span>
					</div>
				</div>
				<div class="text">
                                        <?php echo $content ?>
				</div>
				<div class="tags-text">
                                  <i class="fa fa-tags"></i>标签: 
                                  <?php
                                   if( get_the_tag_list())
                                   {
                                       echo get_the_tag_list(' ',' / ',' ');
                                   }else
                                   {
                                        echo "无";
                                   }
                                  
                                   ?>
				</div>
				<!--文章内容结束-->
				<!--打赏-->
				<div class="reward" id="layerDemo">
					<button data-method="reward" data-type="auto" class="layui-btn layui-btn-danger"><i class="fa fa-heart"></i> 打赏支持</button>
					
				</div>
				<!--打赏 end-->
				<!-- 版权说明 -->
				<div class="copy-text">
					<p>
					  非特殊说明，本博所有文章均为博主原创。
					</p>
					<p class="hidden-xs">
					如若转载，请注明出处：<a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
					</p>
				</div>
				<!-- 版权说明 end -->
				<!--上一篇 下一篇-->
				<div class="page-text">
					<div>
							<?php if( get_previous_post()){?>
											<span class="layui-badge layui-bg-gray">上一篇</span>
											<!-- 第一个参数$format定义链接的格式或者说显示样式默认为    « %link  ,其中%link的内容在第二个参数中定义

											第二个参数$link定义第一个参数中%link的显示内容，默认为%title,即文章标题，你也可以使用其它文字代替。

											第三个参数$in_same_cat定义是否只显示同一分类下的文章，默认为否，即显示全部文章。

											第四个参数$excluded_categories定义排除的分类ID，即不显示这些分类ID下的文章 -->
											<?php previous_post_link($format='%link', $link='%title', $in_same_cat = false, $excluded_categories = '')   ?>
							<?php }?>
					</div>
					<div>
								<?php if( get_next_post() ){?>
												<span class="layui-badge layui-bg-gray">下一篇</span> 
												<?php next_post_link($format='%link', $link='%title', $in_same_cat = false, $excluded_categories = '') ?>
								<?php }?>
				</div>

				</div>
				<!--上一篇 下一篇 end-->
				<!--文章作者-->
				<div class="user-text">
					<a class="t-pic" href="/"><img src="<?php echo of_get('logopic') ?>" width="60" alt="头像也是LOGO" class="layui-circle"></a>
					<div class="t-user">
						<a href="/"><strong><?php bloginfo("name") ?></strong></a>
						<span class="layui-badge layui-bg-orange">博主大人</span>
					</div>
					<div class="u-r">
						<div class="t-say">
							<?php echo of_get('articlenarration') ?>
						</div>
						<div class="t-icon">
							<a href="http://www.qinshoushou.com" target="_blank"><i class="fa fa-home"></i></a>
							<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1170371716&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><i class="fa fa-qq"></i></a>
							<a href="https://weibo.com/2624315293/" rel="nofollow" target="_blank"><i class="fa fa-weibo"></i></a>
						</div>
					</div>
				</div>
				<!--文章作者 end-->
				<!--相关阅读-->
				<div class="relates">
					<h3 class="title-sidebar">最新文章</h3>
					<ul class="layui-row layui-col-space15">
						<?php $post_query = new WP_Query('showposts=10');
						while ($post_query->have_posts()) : $post_query->the_post();
						$do_not_duplicate = $post->ID; ?>
							<li class="layui-col-md6 layui-col-xs12"><a href="<?php the_permalink(); ?>"><i class="fa fa-file-text-o"></i> <?php the_title() ?></a></li>
						<?php endwhile;?>
					</ul>
					

				</div>
				<!--相关阅读 end-->
				<!-- 评论 -->
				<div class="comment-text layui-form">
					<div id="comments">
						<div id="respond-post" class="respond">
									
							<?php 	
								comment_form($commentArgs,$acticleId);
							?>

						</div>
						
						
					

						<br>
						<?php 	
				
							if ( comments_open( $acticleId ) && get_comments_number( $acticleId) ) { ?>

							<h3>已有 <?php echo comments_users_count( $acticleId ) ?> 条评论 <?php echo comments_open( $acticleId)  ?></h3>
							<br>
						
						<?php
								comments_template();
							}else{ ?>

							<h3>暂无评论</h3>

						<?php	}
						?>
					</div>
					
				</div>
				

				<!-- 评论 end -->

				
            </div>
			<!--content end-->

			<div class="sidebar layui-col-md3 layui-col-lg2">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div>




<?php get_footer(); ?>
