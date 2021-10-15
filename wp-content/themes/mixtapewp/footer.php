<?php if(wp_is_mobile()): ?>
    <div class="site-footer">
        <div id="back-to-top">TOP <i class="iconfont"></i></div>
         
        <div class="site-menu-m">
            <ul>
                <li class="">
                    <div>Products
                        <i class="iconfont open-submenu" style="display: block;"></i>
                        <i class="iconfont close-submenu" style="display: none;"></i>
                    </div>
                    <div class="sub-menu" style="display: none;">
                        <a href="https://hyppebrand.com/maxx">Maxx</a>
                        <a href="https://hyppebrand.com/hyppe-q/">Q</a>
                        <a href="https://hyppebrand.com/plus">Plus</a>
                    </div>
                </li>

                <li>
                    <div><a href="https://hyppebrand.com/about-us">Our Brand</a></div>
                </li>

                <li class="">
                    <div>Community
                        <i class="iconfont open-submenu" style="display: block;"></i>
                        <i class="iconfont close-submenu" style="display: none;"></i>
                    </div>
                    <div class="sub-menu" style="display: none;">
                        <a href="https://hyppebrand.com/media">Media</a>
                        <a href="https://hyppebrand.com/news">News</a>
                    </div>
                </li>

                <li class="">
                    <div>Support
                        <i class="iconfont open-submenu" style="display: block;"></i>
                        <i class="iconfont close-submenu" style="display: none;"></i>
                    </div>
                    <div class="sub-menu" style="display: none;">
                        <a href="https://hyppebrand.com/media">Download</a>
                        <a href="https://hyppebrand.com/news">Faq</a>
                    </div>
                </li>

                <li>
                    <div><a href="https://hyppebrand.com/contact">Contact us</a></div>
                </li>
            </ul>
        </div>



        <form class="tnp-form newsletter" action="https://hyppebrand.com/?na=s" method="post" _lpchecked="1"><input type="hidden" name="nr" value="widget-minimal"><input class="tnp-email" type="email" required="" name="ne" value="" placeholder="Email"><input style="display:none;" class="tnp-submit" type="submit" value="Subscribe"><button id="subscribe" data-can="1">Submit</button></form>

        
        <div class="tips">
        Copyright Notice © 2021 HYPPE Holding Limited and/or its affiliates and licensors. All rights reserved
        </div>
    </div>

    <script src="<?php echo get_template_directory_uri();?>/assets/js/header-footer-m.js" type="text/javascript" charset="utf-8"></script>


<?php else: ?>

<?php
mixtape_qodef_get_footer();
?>

<?php endif; ?>    


<script>
   (function($){
    $(".product-menu ,.aboutus").hover(function(){
        $("body").addClass("headerfixed");
    },function(){
        $("body").removeClass("headerfixed");
    });

    $(window).scroll(function() {
        var scroH = $(this).scrollTop();
        $(window).scroll(function() {
            var a = $(this).scrollTop();
            if (a > 0) {
                $("body").addClass("black");
            } else {
                $("body").removeClass("black");
            }
        })
    });
})(jQuery);  
</script>


