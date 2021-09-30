<?php /* Template Name: faq */ ?>

<?php get_header(); ?>

<h4 class="title">FAQ</h4>
<div class="faqwrapper">
    <div class="wholesale">
        <ul class="items">
            <li>
                1. Q: Where is your HQ office and factory?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Our HQ office and factory are both in city of Shenzhen, China.</p>
            </li>
            <li>
                2. Q: Do you have any social media account?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Of course! Until now we only have Instagram and the ID is hyppe_eu. We also will have Facebook and Twitter very soon.</p>
            </li>
            <li>
                3. Q: If coming across after-sales service problem, how to contact you?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: You are welcome to send email to us directly, and the email address is <a class="email" href="mailto:sales@hyppebrand.com">sales@hyppebrand.com</a></p>
            </li>
            <li>
                4. Q: How could I become your wholesaler?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Please contact us by email <a class="email" href="mailto:sales@hyppebrand.com">sales@hyppebrand.com</a></p>
            </li>
            <li>
                5. Q: What are the Hyppe warranty and return policy?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A: Please contact the retailer where your device was purchased, and provide your original purchase receipt.</p>
            </li>
            <li>
                6. Q:How could I get some promotion support?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A:You could contact us by email marketing@hyppebrand.com</p>
            </li>
            <li>
                7. Q:Besides disposable device, do you have other kinds of e-cigarettes?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A:Yes, later we will launch rechangeable e-cigarette.</p>
            </li>
            <li>
                8. Q: What is the minimum age to purchase Hyppe products?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A:You must be of legal smoking age in your state / country to purchase e-cigarette.</p>
            </li>
            <li>
                9. Q: How to know when Hyppe product Is empty?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A:YWhen you cannot puff out anything, it is empty. But the last draw will not taste burnt at all, as our Hyppe product is consistent from beginning to end.</p>
            </li>
            <li>
                10. Q: Is there anything special about Hyppe product's flavor?<i class="iconfont open-submenu" style="display: block;"></i><i class="iconfont close-submenu" style="display: none;"></i>
                <p>A:With simply 1 draw, Hyppe product would be right up in your alley. Hyppe product has uncomparable flavor among other disposables e-cigarette sticks in the market. Every puff would give you a solid throat hit, deep satisfaction, which is as awesome as your morning sip.</p>
            </li>
        </ul>
    </div>
</div>

<script>
   (function($){
    $(".faqwrapper .items li").click(function(){
        if($(this).find("p").is(":hidden")) {
            $(this).find("p").show();
            $(this).find(".close-submenu").show();
            $(this).find(".open-submenu").hide();
        }
        else {
            $(this).find("p").hide();
            $(this).find(".close-submenu").hide();
            $(this).find(".open-submenu").show();
        }
    });
})(jQuery);  
</script>

<?php get_footer(); ?>