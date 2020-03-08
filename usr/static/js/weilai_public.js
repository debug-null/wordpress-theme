
jQuery(function($) {

    //代码段
    jQuery('#weilai_code_box').change( function(){
        
        var code_title = '<pre class="layui-code" data-code_title="'+$(this).val() +'" lay-height="" lay-skin="" lay-encode="true"></pre>';
        wp.media.editor.insert(code_title);
        return;
    })


});



