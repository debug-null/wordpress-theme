<?php
/**
 * Template for displaying search forms in weiali
 *
 * @package WordPress
 * @subpackage weiali
 * @since weiali 1.0
 */
?>


<form class="layui-form search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="search-field layui-input t-ip" placeholder="输入关键字搜索" value="<?php echo get_search_query(); ?>" name="s" required lay-verify="required" autocomplete="off"/>
</form>