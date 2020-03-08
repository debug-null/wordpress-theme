<?php get_header(); ?>

<!-- 主体 -->
<div class="layui-body">
    
    <!-- 默认面包屑 -->
    <div class="layui-fluid map">
      <span class="layui-breadcrumb">
      
        <?php if (function_exists('get_breadcrumbs')){get_breadcrumbs(); } ?>  
      </span>
    </div>
    <div class="layui-fluid main-wp">
      <div class="layui-row main layui-col-space15">
        <div class="layui-fluid main-wp">
          <div class="layui-row main layui-col-space15">
            <div class="content layui-col-md9 layui-col-lg10">
              <!-- 文章列表 -->
              <div id="articleList">
                <?php while(have_posts() ) : the_post(); ?>             
                    
                  <div class="title-article list-card">
                  
                    <?php if( has_post_thumbnail() ){ ?>
                      <div class="list-pic">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                           <?php  the_post_thumbnail('thumbnail');?>
                        </a>
                      </div>
                    <?php }?>
                    <a href="<?php the_permalink() ?>">
                    <h1><?php the_title() ?></h1>
                    <p>
                    <p><?php echo wp_trim_words( get_the_excerpt(),200)." ..."; ?>
                    </p>
                    </a>
                    <div class="title-msg">
                      <span><i class="fa fa-folder"></i> <?php $the_post_category = get_the_category(get_the_ID()); 
                      echo $the_post_category[0]->cat_name; ?></span>
                      <span><i class="fa fa-clock-o"></i> <?php the_time("Y-m-d") ?> </span>
                      <span class="layui-hide-xs"><i class="fa fa-eye"></i> <?php getPostViews( get_the_ID() );?>次</span>
                      <span class="layui-hide-xs"><i class="fa fa-comments-o"></i> <?php echo comments_users_count( get_the_ID() ); ?>条</span>
                    </div>
                  </div>

                  <?php endwhile; ?>
                </div>
              <!--文章列表结束-->
           
                <!--分页-->
                <div class="page-typecho"> 
                  <div class="layui-progress" lay-filter="page_loading">
                      <div class="layui-progress-bar" lay-percent="2%"></div>
                    </div>
                  <div class="layui-laypage layui-laypage-molv" id="pagination">
                    <?php next_posts_link(__('LOAD MORE')); ?>
                  </div>
                </div>
                <!--分页  end-->
          
            </div>
           
            <div class="sidebar layui-col-md3 layui-col-lg2">
              <?php get_sidebar(); ?>
          
            </div>

          </div>
        </div>
        <!-- end -->
      

<?php get_footer(); ?>