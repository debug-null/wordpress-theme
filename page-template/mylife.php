<?php 
/**
 *  Template Name: 我的生活
 *  Description: 2 *
 *   @package Bouquet
 */
   

get_header();

$postid = get_the_ID();  

setPostViewsMylife($postid);


?>

<div class="layui-body">
  <!-- 默认面包屑 -->
  <div class="layui-fluid map">
   
  </div>
  <div class="layui-fluid main-wp">
    <div class="layui-row main layui-col-space15">
      <div class="content layui-col-md9 layui-col-lg10">
        <div class="about-life">
          <div class="t-w">
            <div class="t-u">
              <img height="120" width="120" src="<?php echo of_get('avatar') ?>">
            </div>
            <div class="t-t">
              <h1><?php echo of_get("mastername")?><span><i class="fa fa-vcard-o"></i><?php echo of_get("masterjob")?></span>
              </h1>
              <div class="t-d">
                <p>
                  <?php echo of_get("mastermotto")?>
                </p>
              </div>
              <div class="t-i">
                <a class="layui-btn layui-btn-radius layui-btn-sm" href="/about"> 关于我</a>
                <a class="layui-btn layui-btn-radius layui-btn-sm" href="<?php echo of_get('qqlink') ?>" rel="nofollow" target="_blank"><i class="fa fa-qq"></i></a>
                <a class="layui-btn layui-btn-radius layui-btn-sm" href="<?php echo of_get('wxbusinesscard') ?>" rel="nofollow" target="_blank"><i class="fa fa-weixin"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="title-life">
          <h3><i class="fa fa-smile-o"></i> 我的动态</h3>
         
          <span> <?php echo shuoshuoCount() ?>条动态，<?php getPostViewsMylife($postid); ?>次观望</span>

        </div>
        <div class="mylife">
    
          <ol class="comment-list">

           <?php
            if (have_posts()) : while (have_posts()) : the_post(); ?>
           <li>
              <div class="t-p">
                <img class="avatar" src="<?php echo of_get("logopic")?>" alt="未来博客">
              </div>
              <div class="t-r">
                <strong><a href="http://www.weilai.info" rel="external nofollow">未来博客</a></strong>
                <p>
                </p>
                <p>
                    <?php the_content()  ?>
                </p>
                <p>
                </p>
                <span><?php the_time('Y年m月d日');?></span>
              </div>
            </li>

            
            <?php endwhile;endif; ?>
        
           
        
          </ol>
          <!-- 分页 -->
        </div>
      </div>
    
      <div class="sidebar layui-col-md3 layui-col-lg2">
         <?php get_sidebar(); ?>
    </div>
    </div>
  </div>
  <!-- end -->
 

<?php get_footer() ?>