  <div class="column">
    <h3 class="title-sidebar"><i class="fa fa-folder"></i>栏目分类</h3>

        <?php 
        
            wp_nav_menu( array(
            'theme_location'  => 'sidebar-menu',//导航别名
            'menu'   => '', //期望显示的菜单
            'container'  => '',  //容器标签
            'container_class' => 'layui-row layui-col-space5',//ul父节点class值
            'container_id'  => '',  //ul父节点id值
            'menu_class'   => '',   //ul节点class值
            'menu_id'   => '',  //ul节点id值
            'echo'  => true,//是否输出菜单，默认为真
            'fallback_cb' => 'wp_page_menu',  //菜单不存在时，返回默认菜单，设为false则不返回
            'before' => '', //链接前文本
            'after'  => '', //链接后文本
            'link_before'  => '<i class="fa fa-folder"></i> ',   //链接文本前
            'link_after'  => '',//链接文本后
            'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',   //如何包装列表
            'depth' => 1,   //菜单深度，默认0
                'walker'          => new WPDocs_Walker_Nav_Menu()
            ) );

        ?> 
        


    </div>

    <div class="dynamic">
       <h3 class="title-sidebar"><i class="fa fa-meh-o"></i>博主念叨 ~ </h3>   
        <ul>
				
            <?php query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=-1");
            if (have_posts()) : while (have_posts()) : the_post(); ?>
					<a href="/mylife">
						<li> 
							<span class="layui-badge-dot layui-bg-gray"></span>
							<p>
								<?php the_content() ?>
								<small><?php the_time('Y年m月d日');?></small>
							</p>
						</li>
					</a>
            <?php endwhile;endif; ?>
		

        </ul>
    </div>


    <!-- 标签 -->
    <div class="tags">
        <h3 class="title-sidebar"><i class="fa fa-tags"></i>标签云</h3>
        <div>
            <?php wp_tag_cloud('unit=px&smallest=14&largest=14&number=30&orderby=count&order=DESC'); ?>
        </div>
    </div>
    <div class="about-us">
        <h3 class="title-sidebar"><i class="fa fa-bullhorn" ></i>博客广告</h3>
        <div class="ad-rs">
            <?php echo of_get("blogadv")?>
        </div>
    </div>

  