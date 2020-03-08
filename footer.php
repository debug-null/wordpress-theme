<div class="footer layui-fluid">
          <div class="layui-row layui-fluid">
            <div class="layui-col-md9">
              <span class="layui-breadcrumb" lay-separator="|">
           
              <?php 
              
                  $amenu = array(
                      'container' => false,
                      'echo'  => false,
                      'items_wrap' => '%3$s',
                      'theme_location' => 'sidebar-page',
                      'fallback_cb'=>'fanly_nav_fallback'
                  );
                  echo strip_tags(wp_nav_menu( $amenu ), '<a>' );
              ?>

              </br>
              <span>声明：版权归原作者所有，本站所有数据资源仅供学习与参考，请勿用于商业用途。</span>
              </span>
            </div>
            <div class="layui-col-md3 t-r">
            <a href="javascript:;" target="_blank" rel="nofollow" class="wxbusinesscard"><i class="fa fa-weixin fa-fw"></i>
          <div class="wxbusinesscard_box">
            <img  src="<?php echo of_get('wxbusinesscard') ?>" alt="扫一扫">
          </div>
          </a>
          <a href="<?php echo of_get('qqlink') ?>" rel="nofollow" target="_blank"><i class="fa fa-qq fa-fw"></i></a>
          <a href="mailto:<?php echo of_get('email') ?>" rel="nofollow"><i class="fa fa-envelope fa-fw"></i></a>
            </div>
            <div class="layui-col-md12 t-copy">
              <span class="layui-breadcrumb" lay-separator="/">
              <span><i class="fa fa-copyright"></i> 2019 <a class="layui-" href="" target="_blank"><?php bloginfo("name")?></a></span>
    
              <span>Theme by <a href="http://www.qinshoushou.com" target="_blank">www.qinshoushou.com</a></span>
              <a href="/" target="_blank" rel="nofollow"><?php echo get_option('classic_options')['poweedNumber']?></a>
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- 主体结束 -->



  </div>
    <!-- 引用js -->
    <script src="<?php bloginfo('template_url') ?>/usr/static/layui/layui.js"></script>
    <script src="<?php bloginfo('template_url') ?>/usr/static/js/main.js"></script>
    
    <?php echo of_get("footertext")?>

    <script type="text/javascript">

  layui.use('layer', function(){ 
    var $ = layui.jquery, layer = layui.layer; 
      $('#layerDemo .layui-btn').on('click', function(){
      var othis = $(this), method = othis.data('method');
      active[method] ? active[method].call(this, othis) : '';
      });
      var active = {
        reward: function(){
          layer.tab({
            btn: '爱心名单',
            btnAlign: 'c',
            id: 'reward',
            tab: [{
              title: '微信', 
              content: '<img src="<?php echo of_get('weichatpay')?>" width="200"><p>所有打赏的小伙伴都在名单里</br>再次谢谢大家的支持~~</p>'
            }, {
              title: '支付宝', 
              content: '<img src="<?php echo of_get('zfbpay') ?>" width="200"><p>所有打赏的小伙伴都在名单里</br>再次谢谢大家的支持~~</p>'
            }]
            ,success: function(layero){
              var btn = layero.find('.layui-layer-btn');
              btn.find('.layui-layer-btn0').attr({
                href: ''
                ,target: '_blank'
              });
            }
          });
        }
      };
  });
    </script>
    
    </body>
    </html>