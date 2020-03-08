layui.use(['jquery', 'layer', 'element', 'util', 'table', 'form', 'carousel', 'flow','code'],
function() {
    var $ = layui.$,
    layer = layui.layer,
    element = layui.element,
    util = layui.util,
    table = layui.table,
    form = layui.form;
    carousel = layui.carousel;
    var flow = layui.flow;
    flow.lazyimg();
    carousel.render({
        elem: '#test1',
        width: '100%',
        height: '120px',
        arrow: 'hover'
    });
	
	  //处理代码修饰器 配合wp-edit使用
    var codes = $(".text").find("code");
    codes.each(function(index,el){
       
       var className = $(this).attr("class");
  
        if( className && $(this).parent().is("pre") )
        {
            var strBegin = className.indexOf("-");
            var codeTitle = className.substr(strBegin+1);
            layui.code({
                elem:  $(this).parent()  //默认值为.layui-code
               ,title: codeTitle
               ,about: false
           });
        }else{
            layui.code({
                elem:  $(this)  //默认值为.layui-code
               ,about: false
           });
        }

   })

	
    $(document).ready(function() {
        var comment_html = document.getElementById("comment");
        $('#plbtn-img').bind("click",
        function() {
            layer.prompt({
                formType: 3,
                value: 'http://',
                title: '输入图片地址',
                area: ['800px', '350px']
            },
            function(value, index, elem) {
                var comment_html = document.getElementById("comment");
                comment_html.value += '<img src="' + value + '" rel="external nofollow">';
                layer.close(index)
            })
        });
        
    });
    if (screen.width > 768) {
        window.onscroll = function() {
            var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            if (scrollTop >= 300) {
                document.getElementById("sidebar-nav").style.display = "block"
            }
            if (scrollTop <= 300) {
                document.getElementById("sidebar-nav").style.display = "none"
            }
        }
    }
    window.onresize = function() {
        var wHeight = $(window).width();
        if (wHeight < 992) {}
        if (wHeight > 992) {}
    };
    var catalogAnimationRunning = false;
    function highlightCatalog(target) {
        target.addClass('highlight');
        setTimeout(function() {
            target.removeClass('highlight')
        },
        800)
    };
    $('.layui-nav-child dd').on('click',
    function(e) {
        if (e.target.tagName != 'A') {
            return
        }
        var num = $(e.target).attr('href').indexOf("#");
        var keyword = $(e.target).attr('href').slice(num + 1);
        var target = $('div[data-catalog="' + keyword + '"]');
        if (target[0] && !catalogAnimationRunning) {
            catalogAnimationRunning = true;
            var top = target.offset().top;
            $('html, body').animate({
                scrollTop: top - 10
            },
            600,
            function() {
                highlightCatalog(target);
                catalogAnimationRunning = false
            })
        }
        e.preventDefault()
    });
    $('.side-switch').on('click',
    function() {
        $('.side-switch i').toggleClass("fa-dedent");
        $('.side-switch i').toggleClass("fa-indent");
        $('.layui-body').toggleClass("layui-body-50");
        $('.layui-layout-left').toggleClass("layui-body-50");
        $('.side').toggleClass("side-sm");
        $('.layui-nav-item').removeClass("layui-nav-itemed");
        $('.nav-item-a').toggleClass("nav-item-b");
        $('.nav-item-b').on('click',
        function() {
            $('.side').removeClass("side-sm");
            $('.layui-body').removeClass("layui-body-50");
            $('.side-switch i').toggleClass("fa-dedent");
            $('.side-switch i').toggleClass("fa-indent")
        });
        $('.layui-nav-tree .layui-nav-item').on('click',
        function() {
            $('.layui-layout-left').removeClass("layui-body-50");
            $('.nav-item-a').removeClass("nav-item-b");
            $('.side-switch i').addClass("fa-dedent");
            $('.side-switch i').removeClass("fa-indent")
        })
    });
    $('.side-btn').on('click',
    function() {
        $("body").toggleClass("showMenu");
        $('.nav-item-b').on('click',
        function() {
            $('.side').removeClass("side-sm");
            $('.layui-body').removeClass("layui-body-50")
        });
        $(".layui-body").toggleClass("layui-body-200");
        $('.mask').on('click',
        function() {
            $('body').removeClass('showMenu modal-open')
        })
    });
   


    var baiduUrl = 'http://www.baidu.com/s?wd=',
    googleUrl = 'http://www.google.com.hk/search?q=',
    huabanUrl = 'https://huaban.com/search?q=',
    zhihuUrl = 'https://www.zhihu.com/search?type=content&q=',
    weixinurl = 'http://weixin.sogou.com/weixin?type=2&query=',
    searchEl = $('#search');

    $('.button', searchEl).on('click',
    function(e) {
        var keyword = $('.keyword', searchEl).val(),
        url = e.target.name;
        switch (url) {
        case 'google':
            url = googleUrl;
            break;
        case 'huaban':
            url = huabanUrl;
            break;
        case 'zhihu':
            url = zhihuUrl;
            break;
        case 'weixin':
            url = weixinurl;
            break;
        default:
            url = baiduUrl
        }
        window.open(url + encodeURIComponent(keyword));
        e.preventDefault()
    });
    $.fn.scrollUnique = function() {
        return $(this).each(function() {
            var eventType = 'mousewheel';
            if (document.mozHidden !== undefined) {
                eventType = 'DOMMouseScroll'
            }
            $(this).on(eventType,
            function(event) {
                var scrollTop = this.scrollTop,
                scrollHeight = this.scrollHeight,
                height = this.clientHeight;
                var delta = (event.originalEvent.wheelDelta) ? event.originalEvent.wheelDelta: -(event.originalEvent.detail || 0);
                if ((delta > 0 && scrollTop <= delta) || (delta < 0 && scrollHeight - height - scrollTop <= -1 * delta)) {
                    this.scrollTop = delta > 0 ? 0 : scrollHeight;
                    event.preventDefault()
                }
            })
        })
    };
    $('.layui-side-scroll').scrollUnique();
    var tipindex;
    $(".tips").hover(function() {
        tipindex = layer.tips($(this).data('tips'), $(this), {
            tips: [4, '#0078B5'],
            time: 2000,
            area: 'auto',
            tipsMore: true
        })
    },
    function() {
        layer.close(tipindex)
    });
    var device = layui.device();
    if (device.os === 'windows' || device.os === 'mac' || device.ie == true) {};
    form.on('switch(t-msg)',
    function(data) {
        layer.msg('开关checked：' + (this.checked ? 'true': 'false'), {
            offset: '6px'
        });
        $('.t-msg').toggleClass("layui-hide");
        layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
    });
    form.on('switch(t-cn)',
    function(data) {
        $('.t-cn').toggleClass("layui-hide")
    });
    form.on('switch(t-link)',
    function(data) {
        $('.t-link').toggleClass("layui-hide")
    })


    // ************
    // AJAX翻页
    $("#pagination a").bind("click", function(){
     
        $(this).addClass("loading").text("LOADING...");
        $(".page-typecho .layui-progress").fadeIn();
        $.ajax({
            type: "POST",
            url: $(this).attr("href") + "#articleList",
            beforeSend : function()
            {
              element.progress('page_loading', '40%');
            },
            complete: function()
            {
              element.progress('page_loading', '100%');
              $(".page-typecho .layui-progress").fadeOut();
            },
            success: function(data)
            {
                element.progress('page_loading', '80%');
            
                var result = $(data).find("#articleList .list-card"),
                    nextHref = $(data).find("#pagination a").attr("href");
                // 渐显新内容
                $("#articleList").append(result.fadeIn(300));
               
                $("#pagination a").removeClass("loading").text("LOAD MORE");

                //没有内容就隐藏按钮
                if ( nextHref != undefined ) {
                    $("#pagination a").attr("href", nextHref);
                } else {
                    $("#pagination").html('<a href="javascript:;">没有了</a>');
                }
            
            },
            error: function(err){
                alert("出现错误"+ err);
            }
      
     
        });
    
        return false;
    })
    
   
//           //替换代码修饰器上的标题
//       $(".layui-code").each(function(index,el)
//       {
    
    
//             if( $(this).data("code_title") )
//             {
//               $(this).find(".layui-code-h3").text( $(this).data("code_title") )
//             }            
//         });

     
  
    $(".wxbusinesscard").hover(function()
    {
       $(this).children(".wxbusinesscard_box").slideDown();
    },function(){
        $(this).children(".wxbusinesscard_box").slideUp();
    });
    
    // //Ajax评论提交
    // $('#comment-form').submit(function(e){
    //     console.log($(this).serialize());
    //     $.ajax({
    //         type: 'post',
    //         url: '/wp-comments-post.php',
    //         data: $(this).serialize(),
    //         success: function(result){
    //             if( result.indexOf('id="error-page"') ){
    //                 layer.msg( result.substring(result.indexOf("ng>：")+4, result.indexOf("</p>")) );

    //             }else{

    //                 layer.msg("提交成功")
    //             }

    //             // console.log(result,result.indexOf("ng>："),result.indexOf("</p>"),result.substring(result.indexOf("ng>：")+4, result.indexOf("</p>")) )
    //         },
    //         error: function(err){
    //             alert(err)
    //         }
    //     },'json')



    //     return false;
    // })
   



});



