<?php if(wp_is_mobile()): ?>
    <div class="site-footer">
        <div id="back-to-top">TOP <i class="iconfont"></i></div>
        <div class="site-menu-m">
            <ul>
                <li class="">
                    <div>
                        <a href="https://vaptiobeco.co.uk">Home</a>
                    </div>
                </li>

                <li class="">
                <div>
                    <a href="https://vaptiobeco.co.uk/about-us">About Us</a>
                    </div>
                </li>
                <li class="">
                <div>
                     <a href="https://vaptiobeco.co.uk/partner">Partners</a>
                     </div>
                </li>
                <li class="">
                <div>
                    <a href="https://vaptiobeco.co.uk/wheretobuy">Where to Buy </a>
                    </div>
                </li>

                <li class="">
                <div>
                   <a href="https://vaptiobeco.co.uk/faq">FAQ</a>
                   </div>
                </li>

                <li class="">
                <div>
                 <a href="https://vaptiobeco.co.uk/contact">Contact Us</a>
                   </div>
                </li>
            </ul>
        </div>
        <form class="tnp-form newsletter" action="https://maxcorevape.com/?na=s" method="post" _lpchecked="1"><input type="hidden" name="nr" value="widget-minimal"><input class="tnp-email" type="email" required="" name="ne" value="" placeholder="Email"><input style="display:none;" class="tnp-submit" type="submit" value="Subscribe"><button id="subscribe" data-can="1">Submit</button></form>

        
        <div class="tips">
        Copyright Notice © 2021 BECO Holding Limited and/or its affiliates and licensors. All rights reserved.
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
})(jQuery);  
</script>


