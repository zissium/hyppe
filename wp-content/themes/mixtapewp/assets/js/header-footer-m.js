(function ($){ 
    

    // 二级菜单展开、关闭
    $(".dropdown-menu-m .show-more").click(function () {
        $(this).toggleClass("open").parent().children("ul").toggle("slow");
        $(this).find('i').toggleClass('drop');
    });

    $('.site-menu-m ul li').each(function () {
        $(this).click(function () {
            if ($(this).is(':has(.sub-menu)')) {
                $(this).toggleClass('active');
                $(this).find('.open-submenu').eq(0).toggle({ duration: 300 });
                $(this).find('.close-submenu').eq(0).toggle({ duration: 300 });
                $(this).find('.sub-menu').eq(0).toggle({ duration: 300 });
            }
        });  

    })

    // 回到顶部
    $("#back-to-top").click(function () {
        $("html,body").animate({ scrollTop: 0 }, 500);
    });



    $(".emailsend").click(function(){
        $("._maskwrapper").show(); 
        $(".contactFormWrapperfixed").show(); 
      
    });

    $(".contactFormWrapperfixed .close").click(function(){
        $("._maskwrapper").hide(); 
        $(".contactFormWrapperfixed ").hide(); 
    });

    
    
})(jQuery);
