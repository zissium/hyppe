<?php /* Template Name: faq */ ?>

<?php get_header(); ?>

<div class="faqwrapper">
    <div class="wholesale">
        <h2>Wholesale Inquiry</h2>
        <ul class="items">
            <li>
                1. Q: How can I become your wholesaler?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Please fill out our <a href="https://vaptiobeco.co.uk/contact">contact form</a> or email <a href="mailto:uk@vaptio.com">uk@vaptio.com</a>. </p>
            </li>
            <li>
                2. Q: What’s your wholesale pricing.<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Please <a href="https://vaptiobeco.co.uk/contact">contact us</a>, we will reply you ASAP.  </p>
            </li>
            <li>
                3. Q: How can I purchase your products?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Please fill out our <a href="https://vaptiobeco.co.uk/contact">contact form</a>, our staff will get back to you and help you ASAP.</p>
            </li>
            <li>
                4. Q: Can I get more information to promote your products?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Sure! Please email 邮箱, and we will offer a wide variety of marketing materials to help you.</p>
            </li>
        </ul>
    </div>
    
    <div class="general">
        <h2>General Inquiry</h2>
        <ul class="items">
            <li>
                1. Q: What is BECO BAR?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: BECO BAR is one of the disposable vape devices from VAPTIO brand, and it is easy to use with exceptional flavours.</p>
            </li>
            <li>
                2. Q: What’s the minimum age to purchase BECO products.<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: You must be the legal age 18+ to purchase BECO products. </p>
            </li>
            <li>
                3. Q: How to use BECO products?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Simply open the package, and then take a hit.</p>
            </li>
            <li>
                4. Q: How long can a BECO device last? <i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: It depends on how heavily and how often you use it. But according to the TPD, the max capacity is 2ml with about 400 puffs.</p>
            </li>
            <li>
                5. Q: How to know when a BECO device is empty?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: When you cannot puff out anything, it is empty. But the last draw will not taste burnt at all, as our BECO device is consistent from beginning to end.</p>
            </li>
            <li>
                6. Q: What Are the BECO Warranty and Return Policy?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: It depends on where and when you purchased it. Please contact the retailer where your device was purchased, and provide your original purchase receipt.</p>
            </li>
            <li>
                7. Q: You should improve your quality control.<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: We love hearing how we can make our product better, and we aim to make high quality product. It will be very appreciated you can figure out where we should improve.Thanks for your support! </p>
            </li>
        </ul>

    </div>

</div>

<script>
   (function($){
    $(".faqwrapper .items li").click(function(){
        if($(this).find("p").is(":hidden")) {
            $(this).find("p").show();
            $(".close-submenu").show();
            $(".open-submenu").hide();
        }
        else {
            $(this).find("p").hide();
            $(".close-submenu").hide();
            $(".open-submenu").show();
        }
    });
})(jQuery);  
</script>

<?php get_footer(); ?>