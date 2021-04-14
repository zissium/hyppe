<?php /* Template Name: job */ ?>

<?php get_header(); ?>
<?php
    $is_mobile = wp_is_mobile();
    if($is_mobile != 1):
?>

<style>
    i {
    font-style: normal;
}

.header-content .new-toppic-menu img {
    margin-top: 0 !important;
}

.recruitment-page {
    color: #333333;
    min-height: 700px;
    margin-top: 150px;
}

.recruitment-page>.caption {
    /*margin-top: 177px;*/
    font-size: 80px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 14px;
   
}

.recruitment-page>p {
    font-size: 18px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 40px;
}

.recruitment-page form {
    width: 1039px;
    height: 60px;
    background-color: #ffffff;
    border-radius: 30px;
    border: solid 1px #eeeeee;
    margin: 0 auto 45px auto;
    display: block;
    /*box-shadow: 0 25px 49px 0 rgba(58, 74, 88, 0.1);*/
}

.recruitment-page form input:focus:not([disabled]) {
    background-color: #ffffff;
}

.recruitment-page form input::-webkit-input-placeholder {
    font-size: 16px;
}

.recruitment-page form input:-moz-placeholder {
    font-size: 16px;
}

.recruitment-page form input::-moz-placeholder {
    font-size: 16px;
}

.recruitment-page form input:-ms-input-placeholder {
    font-size: 16px;
}

.page-header {
    margin: 0;
}

.recruitment-page form input {
    border-radius: 30px;
    float: left;
    width: 444px;
    height: 58px;
    line-height: 58px;
    font-size: 16px;
    padding-left: 51px;
    border: none;
    vertical-align: top;
    outline: none;
}

.recruitment-page form .select-box {
    position: relative;
    display: inline-block;
    background-color: #ffffff;
    vertical-align: top;
}

.recruitment-page form .select-box .select-val {
    font-size: 0;
    border-left: solid 1px #e5e5e5;
    border-right: solid 1px #e5e5e5;
    width: 146px;
    margin-top: 16px;
    height: 26px;
    line-height: 26px;
    color: #343e51;
    margin-bottom: 16px;
}

.recruitment-page form .country-choose .country-selected {
    width: 288px;
    border: none;
}

.recruitment-page form .select-box .select-val .val {
    float: left;
    display: inline-block;
    width: 121px;
    text-align: center;
    font-size: 16px;
    cursor: pointer;
}

.recruitment-page form .select-box .country-selected .val {
    text-align: center;
    width: 265px;
    padding-left: 18px;
}

.recruitment-page form #submitForm {
    outline: none;
    font-size: 15px;
    font-weight: bold;
    text-transform: uppercase;
    float: right;
    width: 155px;
    height: 58px;
    line-height: 58px;
    text-align: center;
    background-color: #ee2c47;
    box-shadow: 0 25px 49px 0 rgba(58, 74, 88, 0.1);
    border-radius: 0 30px 30px 0;
    border: none;
    color: #ffffff;
    cursor: pointer;
    -webkit-appearance: button-bevel;
}

.recruitment-page form .select-box .select-val i {
    line-height: 26px;
    display: inline-block;
    font-size: 16px;
}

.recruitment-page form .select-box .select-list {
    width: 146px;
    z-index: 10;
    display: none;
    height: auto;
    overflow: hidden;
    padding-left: 0;
    line-height: 40px;
    box-shadow: 3px 5px 5px 0 rgba(58, 74, 88, 0.1);
    background-color: #fff;
    position: absolute;
    left: 0;
    top: 58px;
}

.recruitment-page form .select-box .country-cont {
    width: 288px;
}

.recruitment-page form .select-box .select-list li {
    list-style-type: none;
    text-align: center;
    cursor: pointer;
}

.recruitment-page form .select-box .select-list li:hover {
    background-color: #f2f2f2;
}

.recruitment-cont>li {
    width: 1039px;
    margin: 0 auto;
    list-style-type: none;
}

.recruitment-cont>li>.caption span:nth-child(1) {
    display: inline-block;
    width: 320px;
    line-height: 47px;
    font-size: 18px;
    font-weight: bold;
    color: #343e51;
}

.recruitment-cont>li>.caption {
    display: inline-block;
    cursor: pointer;
}

.recruitment-cont>li>.caption span:nth-child(2) {
    display: inline-block;
    margin-right: 29px;
    font-weight: normal;
    font-size: 15px;
}

.recruitment-cont>li>.caption span:nth-child(2).rotate {
    transform: rotate(-90deg);
}

.recruitment-cont>li>.caption span:nth-child(3) {
    display: inline-block;
    font-size: 12px;
    color: #999999;
    font-weight: normal;
    margin-right: 180px;
}

.recruitment-cont>li>.caption span:nth-child(4) {
    display: inline-block;
    font-size: 12px;
    color: #999999;
    font-weight: normal;
    width: 200px;
    /* margin-right: 180px; */
}

.recruitment-cont>li>.caption span:nth-child(5) {
    display: inline-block;
    font-size: 12px;
    color: #999999;
    font-weight: normal;
    width: 200px;
    text-align: left;
}

.recruitment-cont .list-cont {
    padding-left: 40px;
    display: none;
}

.recruitment-cont .list-cont li {
    list-style-type: none;
    font-size: 16px;
    margin-bottom: 25px;
}

.recruitment-cont .list-cont div {
    line-height: 26px;
    margin-bottom: 10px;
}

.recruitment-cont .list-cont .title {
    font-weight: bold;
}

.recruitment-cont .list-cont p {
    color: #666;
    line-height: 26px;
}

/*分页*/
#page {
    text-align: center;
    margin-bottom: 20px;
}

#page button {
    padding: 0;
    width: 40px;
    height: 40px;
    border-radius: 20px;
    border: none;
    outline: none;
    vertical-align: middle;
    background-color: #ee2c47;
    color: #ffffff;
}

#page button:disabled {
    background-color: #999999;
}

#page ul {
    cursor: pointer;
    vertical-align: middle;
    display: inline-block;
    padding: 0;
    margin-bottom: 0;
}

#page ul li {
    display: inline-block;
    margin-bottom: 0;
}

#page ul li span {
    font-size: 18px;
    display: inline-block;
    border: none;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
}

#page ul li.current span {
    color: #ee2c47;
}
</style>    

<div class="recruitment-page">
    <form id="form" action="">
        <input type="text" placeholder="搜索">
        <div class="country-choose select-box">
            <div class="country-selected select-val"><span class="val" data-code="1">国家 / 区域</span><i class="fa fa-angle-down"></i></div>
            <ul class="country-cont select-list" style="display: none;">
                <li style="display:none" data-code="1">国家 / 区域</li>
                    <li data-code="美国">美国</li>
                    <li data-code="德国">德国</li>
                    <li data-code="俄罗斯">俄罗斯</li>
                    <li data-code="法国">法国</li>
                    <li data-code="日本">日本</li>
                    <li data-code="西班牙">西班牙</li>
                    <li data-code="香港">香港</li>
                    <li data-code="沙特阿拉伯">沙特阿拉伯</li>
                    <li data-code="葡萄牙">葡萄牙</li>
                    <li data-code="波兰">波兰</li>
                    <li data-code="深圳">深圳</li>
                </ul>
        </div>
        <span id="submitForm" type="submit">搜索</span>
    </form>
    <ul class="recruitment-cont">
<!--        <li>-->
<!--            <div class="caption">-->
<!--                <span>1. Japanese Translator</span>-->
<!--                <span><</span>-->
<!--                <span>25 Jun, 2019</span>-->
<!--            </div>-->
<!--            <ul class="list-cont">-->
<!--                <li>-->
<!--                    <div class="title"> Key Responsibilitie</div>-->
<!--                    <p> A. Pteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id-->
<!--                        est-->
<!--                        laborum. </p>-->
<!--                    <p> B. Brand or product management experience in a national chain restaurant, agency or consumer-->
<!--                        packaged goods (CPG) environment </p>-->
<!--                </li>-->
<!---->
<!--                <li>-->
<!--                    <div>Skills and Requirements</div>-->
<!--                    <p> A. Results oriented with successful experience in analytics, strategy, innovation, problem-->
<!--                        solving-->
<!--                        and go-to-market execution</p>-->
<!--                    <p>B. Demonstrated ability to establish strong working relationships with internal/external-->
<!--                        partners</p>-->
<!--                    <p>C. Nimble and flexible under ambiguous or changing direction</p>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li>-->
<!--            <div class="caption">-->
<!--                <span>2. SPANISH Translator</span>-->
<!--                <span><</span>-->
<!--                <span>27 Jun, 2019</span>-->
<!--            </div>-->
<!--            <ul class="list-cont">-->
<!--                <li>-->
<!--                    <div class="title"> Key Responsibilitie</div>-->
<!--                    <p> A. Pteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id-->
<!--                        est-->
<!--                        laborum. </p>-->
<!--                    <p> B. Brand or product management experience in a national chain restaurant, agency or consumer-->
<!--                        packaged goods (CPG) environment </p>-->
<!--                </li>-->
<!---->
<!--                <li>-->
<!--                    <div>Skills and Requirements</div>-->
<!--                    <p> A. Results oriented with successful experience in analytics, strategy, innovation, problem-->
<!--                        solving-->
<!--                        and go-to-market execution</p>-->
<!--                    <p>B. Demonstrated ability to establish strong working relationships with internal/external-->
<!--                        partners</p>-->
<!--                    <p>C. Nimble and flexible under ambiguous or changing direction</p>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li>-->
<!--            <div class="caption">-->
<!--                <span>3. RUSSIAN Translator</span>-->
<!--                <span><</span>-->
<!--                <span>21 Jun, 2019</span>-->
<!--            </div>-->
<!--            <ul class="list-cont">-->
<!--                <li>-->
<!--                    <div class="title"> Key Responsibilitie</div>-->
<!--                    <p> A. Pteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id-->
<!--                        est-->
<!--                        laborum. </p>-->
<!--                    <p> B. Brand or product management experience in a national chain restaurant, agency or consumer-->
<!--                        packaged goods (CPG) environment </p>-->
<!--                </li>-->
<!---->
<!--                <li>-->
<!--                    <div>Skills and Requirements</div>-->
<!--                    <p> A. Results oriented with successful experience in analytics, strategy, innovation, problem-->
<!--                        solving-->
<!--                        and go-to-market execution</p>-->
<!--                    <p>B. Demonstrated ability to establish strong working relationships with internal/external-->
<!--                        partners</p>-->
<!--                    <p>C. Nimble and flexible under ambiguous or changing direction</p>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li>-->
<!--            <div class="caption">-->
<!--                <span>4. FRENCH Translator  </span>-->
<!--                <span><</span>-->
<!--                <span>22 Jun, 2019</span>-->
<!--            </div>-->
<!--            <ul class="list-cont">-->
<!--                <li>-->
<!--                    <div class="title"> Key Responsibilitie</div>-->
<!--                    <p> A. Pteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id-->
<!--                        est-->
<!--                        laborum. </p>-->
<!--                    <p> B. Brand or product management experience in a national chain restaurant, agency or consumer-->
<!--                        packaged goods (CPG) environment </p>-->
<!--                </li>-->
<!---->
<!--                <li>-->
<!--                    <div>Skills and Requirements</div>-->
<!--                    <p> A. Results oriented with successful experience in analytics, strategy, innovation, problem-->
<!--                        solving-->
<!--                        and go-to-market execution</p>-->
<!--                    <p>B. Demonstrated ability to establish strong working relationships with internal/external-->
<!--                        partners</p>-->
<!--                    <p>C. Nimble and flexible under ambiguous or changing direction</p>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
    </ul>

    <!--分页功能-->
    <div id="page">
        <!--<button class="previous-btn" disabled><</button>-->
        <!--<ul class="pagination-list">-->
        <!--<li><span>1</span></li>-->
        <!--<li><span>2</span></li>-->
        <!--<li><span>3</span></li>-->
        <!--</ul>-->
        <!--<button class="next-btn">></button>-->
    </div>
</div>



<script type = "text/javascript">
    ( function( $ ) {
        'use strict';
        var Item= document.getElementsByClassName("page-main-pal");
        if(Item.length != 0) {
            Item[0].className = '';
        }
        var Item= document.getElementsByClassName("column");
        if(Item.length != 0) {
            Item[0].className = '';
        }
        


       

         $(document).on("click", ".recruitment-cont>li .caption", function () {
                $(this).children('span:nth-child(2)').toggleClass('rotate', 300, 'easeOutSine');
                $(this).next().toggle({duration: 300});
            })

            // 封装下拉菜单方法
            function selectVal(box, select) {
                box.click(function () {
                    $(this).next().toggle();
                });
                select.click(function () {
                    $(this).hide();
                    $(this).parents('.select-list').hide();
                    $(this).siblings().show();
                    box.children('.val').html($(this).html());
                    box.children('.val').attr('data-code',$(this).data('code'));
                });
                // 点击其他地方关闭select
                $(document).click(function (e) {
                    var parentNode = box.parents('.select-box');
                    if (!$(e.target).closest(parentNode).length) {
                        select.parents('.select-list').hide();
                    }
                });
            };

            // 全职兼职下拉菜单
            var type_box = $('.time-type .selected'),
                type_select = $('.time-type .selected-cont li');
            selectVal(type_box, type_select);

            // 国家下拉菜单效果
            var country_box = $('.country-choose .country-selected'),
                country_select = $('.country-choose .country-cont li');
            selectVal(country_box, country_select);


            // 初始化数据
            var initData=[{
                page: 1,
                pagesize: 4,
                region: 'en',
                job_type: 0,
                keywords: 'japanese'
            }];

            // 封装请求数据方法
            function getData(){
                $('.recruitment-cont').empty();
                $('#page').empty();

                initData[0].region = $('.country-choose .country-selected .val').attr('data-code');
                //console.log(initData[0].region);
                //console.log(initData[0]);
                initData[0].keywords = $('#form input').val();
                var url = '/wp-json/v1/posts/content/?page='+initData[0].page+'&pagesize=4&region='+initData[0].region+'&keywords='+ initData[0].keywords;
                //console.log(url);
                $.ajax({
                    type: 'get',
                    dataType: 'JSON',
                    url: url,
                    success: function (data) {
                        //console.log(data);
                        var nhtml = '',
                            ndata = data.data.list,
                            num = 1,
                            pageNum = 0,
                            btn_html = '',
                            btns_html = '';
                        for (var j = 0; j < data.data.totalpage; j++) {
                            pageNum++;
                            btn_html += '<li><span>' + pageNum + '</span></li>'
                        }
                        btns_html = '<button class="previous-btn fa fa-angle-left" disabled></button><ul class="pagination-list">' +btn_html+ '</ul><button class="next-btn fa fa-angle-right"></button>';
                        $('#page').append(btns_html);
                        contrlLi();
                        nextDisabled();
                        preDisabled();
                        for (var i in ndata) {
                            //console.log(i);
                            nhtml += '<li>' +
                                '<div class="caption"><span>' + num++ + '.' + ndata[i].title + '</span><span class="fa fa-angle-left"></span><span>' + ndata[i].update_time + '</span><span>' + ndata[i].country_or_region + '</span></div>' +
                                '<ul class="list-cont">' +
                                '<li><p>' + ndata[i].job_desc + '</p></li></ul></li>'
                        }
                        $('.recruitment-cont').append(nhtml)
                    }
                })
            }
            // GET请求
            $('#submitForm').click(function () {
                // 初始化
                initData[0].page = 1;
                initData[0].pagesize = 4;
                getData();
            });

            // 分页请求
            // 初始化
            // 高亮
            function light(obj) {    //点击页码高亮样式，当前页码
                obj.addClass("current").siblings().removeClass("current");
            }
            function preDisabled() {
                if(initData[0].page == 1){
                    $('#page .previous-btn').attr("disabled", "disabled")
                }
                if(initData[0].page > 1){
                    $('#page .previous-btn').attr("disabled", false)
                }
            }
            function nextDisabled() {
                if (initData[0].page == $('#page ul li').length){
                    $('#page .next-btn').attr("disabled","disabled")
                }
                if (initData[0].page < $('#page ul li').length){
                    $('#page .next-btn').attr("disabled",false)
                }

            }
            function contrlLi(){
                if($('#page ul').has('li')){
                    $('#page ul li').each(function (i) {
                        light($('#page ul li').eq(initData[0].page-1));
                        $(this).click(function () {
                            initData[0].page =  1 + i;
                            // //console.log(initData[0].page);
                            light($(this));
                            nextDisabled();
                            preDisabled();
                            getData();
                        });
                    });
                    $('#page .next-btn').click(function () {
                        initData[0].page++;
                        // //console.log(initData[0].page);
                        light($('#page ul li').eq(initData[0].page - 1));
                        nextDisabled();
                        preDisabled();
                        getData();
                    })
                    $('#page .previous-btn').click(function () {
                        initData[0].page--;
                        // //console.log(initData[0].page);
                        light($('#page ul li').eq(initData[0].page - 1));
                        nextDisabled();
                        preDisabled();
                        getData();
                    })


                }
            }
            getData();
    
    }( jQuery ) );

</script>    

<?php else: ?>

<style>

html {
    font-size: 50px;
}   
    .nav-sections-item-title.active {
    display: none;
}

.header .header-content .head-position {
    z-index: 99;
}

.recruitment-m {
    width: 7.5rem;
    margin: 0 auto;
    padding: 0 0.3rem 1.2rem 0.3rem;
}

.recruitment-m>h1 {
    margin-top: 0.77rem;
    line-height: 0.55rem;
    font-size: 0.48rem;
    font-weight: bold;
    color: #333333;
    text-align: center;
    margin-bottom: 0.16rem;
}

.recruitment-m>p {
    text-align: center;
    color: #999999;
    font-size: 0.24rem;
    line-height: 0.36rem;
    margin-bottom: 0.55rem;
}

.recruitment-m form>input {
    margin-bottom: 0.3rem;
}

.select-box {
    margin-bottom: 0.3rem;
}

.recruitment-m form>input,
.select-box .select-val {
    position: relative;
    width: 6.9rem;
    height: 0.8rem;
    line-height: 0.8rem;
    padding: 0 0.3rem;
    font-size: 0.24rem;
    border: solid 0.01rem #cccccc;
    color: #333333;
}

.recruitment-m form #submitForm {
    display: inline-block;
    width: 6.9rem;
    height: 0.8rem;
    line-height: 0.8rem;
    background-color: #ee2c47;
    box-shadow: 0 0.25rem 0.49rem 0 rgba(58, 74, 88, 0.1);
    text-transform: uppercase;
    color: #ffffff;
    font-size: 0.24rem;
    text-align: center;
    -webkit-appearance: button-bevel;
}



/*select框 开始*/
.select-box .select-val i {
    position: absolute;
    right: 0.3rem;
    /* float: right; */
    display: inline-block;
    transform: rotate(180deg);
    font-style: normal !important;
}

.select-box .select-list {
    display: none;
    padding-left: 0;
    background-color: #ffffff;
    border: 0.01rem solid #cccccc;
    border-top: none;
}

.select-box .select-list li {
    font-size: 0.24rem;
    padding-left: 0.3rem;
    list-style-type: none;
    line-height: 0.8rem;
    border-bottom: 0.01rem solid #f2f2f2;
    margin-bottom: 0;
}

/*select框 结束*/

/*搜索内容*/
.recruitment-cont {
    padding: 0;
    margin: 1.14rem 0;
}

.recruitment-cont>li {
    width: 100%;
    margin: 0 auto 0.4rem auto;
    list-style-type: none;
}

.recruitment-cont>li>.caption span:nth-child(1) {
    display: inline-block;
    width: 4rem;
    font-size: 0.3rem;
    font-weight: bold;
    color: #343e51;
    line-height: 0.48rem;
}

.recruitment-cont>li>.caption {
    cursor: pointer;
}

.recruitment-cont>li>.caption span:nth-child(2) {
    display: inline-block;
    font-weight: normal;
    font-size: 0.2rem;
    color: #999999;
}

.recruitment-cont>li>.caption span:nth-child(3) {
    line-height: 0.48rem;
    float: right;
    display: inline-block;
    font-size: 0.2rem;
    color: #999999;
    font-weight: normal;
    transition: all 0.3s;
}

.recruitment-cont>li>.caption span.rotate {
    transform: rotate(90deg);
}

.recruitment-cont>li>.caption .fa-angle-right:before {
    font-size: 0.26rem;
}

.recruitment-cont .list-cont {
    display: none;
    padding-left: 0;
}

.recruitment-cont .list-cont li {
    list-style-type: none;
    font-size: 0.24rem;
    margin-bottom: 0.42rem;
}

.recruitment-cont .list-cont div {
    margin-top: 0.4rem;
}

.recruitment-cont .list-cont .title {
    font-weight: bold;
    line-height: 0.4rem;
}

.recruitment-cont .list-cont p {
    word-break: break-all;
    color: #666;
    line-height: 0.4rem;
    margin-bottom: 0.4rem;
}

.recruitment-m>.nodata {
    display: none;
    font-size: 0.24rem;
    color: #999999;
    line-height: 0.48rem;
    text-align: center;
}

.qodef-mobile-header-inner {
    font-size: 20px;
}

.qodef-footer-top-holder {
    font-size: 12px;
}

/*懒加载 开始*/
.loading {
    display: none;
    margin: 0 auto;
    width: 0.7rem;
    height: 0.7rem;
    color: inherit;
    vertical-align: middle;
    pointer-events: none;
    border: .2em solid currentcolor;
    border-bottom-color: transparent;
    border-radius: 50%;
    -webkit-animation: 1s loading linear infinite;
    animation: 1s loading linear infinite;
    position: relative;
}

@-webkit-keyframes loading {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes loading {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}


/*懒加载 结束*/
</style>    

<div class="recruitment-m">
    <form action="" id="form">
        <input type="text" placeholder="搜索">
    
        <div class="country-choose select-box">
            <div class="country-selected select-val"><span class="val" data-code="1">国家 / 区域</span><i>▲</i></div>
            <ul class="country-cont select-list" style="display: none;">
                    <li style="display:none" data-code="1">国家 / 区域</li>
                    <li data-code="美国">美国</li>
                    <li data-code="德国">德国</li>
                    <li data-code="俄罗斯">俄罗斯</li>
                    <li data-code="法国">法国</li>
                    <li data-code="日本">日本</li>
                    <li data-code="西班牙">西班牙</li>
                    <li data-code="香港">香港</li>
                    <li data-code="沙特阿拉伯">沙特阿拉伯</li>
                    <li data-code="葡萄牙">葡萄牙</li>
                    <li data-code="波兰">波兰</li>
                    <li data-code="深圳">深圳</li>
                </ul>
        </div>
        <span id="submitForm" type="submit">搜索</span>
    </form>

    <ul class="recruitment-cont">

    </ul>
    <div class="loading">
    </div>
    <div class="nodata">
       是的，您已经看到了所有招聘信息。
    </div>
</div>
<script>

( function( $ ) {
    'use strict';
        var Item= document.getElementsByClassName("page-main-pal");
        if(Item.length != 0) {
            Item[0].className = '';
        }
        var Item= document.getElementsByClassName("column");
        if(Item.length != 0) {
            Item[0].className = '';
        }

        var isNoData = 0;
        var isLoading = 0;
        var num = 1;
        $(function () {
            $(document).on("click", ".recruitment-cont>li .caption", function () {
                $(this).children('span:nth-child(3)').toggleClass('rotate', 300, 'easeOutSine');
                $(this).next().toggle({duration: 300});
            })

            // 封装下拉菜单方法
            function selectVal(box, select) {
                box.click(function () {
                    $(this).next().toggle();
                });
                select.click(function () {
                    $(this).hide();
                    $(this).parents('.select-list').hide();
                    $(this).siblings().show();
                    box.children('.val').html($(this).html());
                    box.children('.val').attr('data-code',$(this).data('code'));
                });
                // 点击其他地方关闭select
                $(document).click(function (e) {
                    var parentNode = box.parents('.select-box');
                    if (!$(e.target).closest(parentNode).length) {
                        select.parents('.select-list').hide();
                    }
                });
            };

            // 全职兼职下拉菜单
            var type_box = $('.time-type .selected'),
                type_select = $('.time-type .selected-cont li');
            selectVal(type_box, type_select);

            // 国家下拉菜单效果
            var country_box = $('.country-choose .country-selected'),
                country_select = $('.country-choose .country-cont li');
            selectVal(country_box, country_select);

            // 初始化
            var initData=[{
                page: 1,
                pagesize: 4,
                region: 'en',
                job_type: 0,
                keywords: 'japanese'
            }];
            // GET请求
            function getData(){
                $('.recruitment-m>.nodata').hide()
                $('.recruitment-m>.loading').show();
                //console.log(initData[0].page, 'page');
                initData[0].region = $('.country-choose .country-selected .val').attr('data-code');
                if($('.time-type .selected .val').html() == 'Full Time'){
                    initData[0].job_type = 0;
                }else if($('.time-type .selected .val').html() == 'Part Time'){
                    initData[0].job_type = 1;
                }else{
                    initData[0].job_type = 2;
                }
                initData[0].keywords = $('#form input').val() ? $('#form input').val():'';
                var url = '/wp-json/v1/posts/content/?page='+initData[0].page+'&pagesize=4&region='+initData[0].region+'&keywords='+ initData[0].keywords;

                // //console.log(url);
                isLoading = 1;
                $.ajax({
                    type: 'get',
                    dataType: 'JSON',
                    url: url,
                    success: function (data) {
                        //console.log(data.data.list)
                        $('.recruitment-m>.loading').hide();
                        // //console.log(data);
                        if(data.status==1){
                            initData[0].page ++;
                            if(JSON.stringify(data.data.list) === '[]'){
                                isNoData = 1;
                                $('.recruitment-m>.nodata').show()
                            }
                        }
                        var nhtml = '',
                            ndata = data.data.list,

                            pageNum = 0;
                        for (var i in ndata) {
                            nhtml += '<li>' +
                                '<div class="caption"><span>' + num++ + '.' + ndata[i].title + '</span><span>' + ndata[i].update_time + '</span><span class="fa fa-angle-right"></span></div>' +
                                '<ul class="list-cont"><li><div><span> '+ ndata[i].country_or_region+'</span></div></li>'+
                                '<li><p>' + ndata[i].job_desc + '</p></li>' +
                                '</ul></li>'
                        }
                        $('.recruitment-cont').append(nhtml);
                        isLoading = 0;
                    }
                })
            }

            $('#submitForm').click(function () {
                isNoData = 0;
                // 初始化
                $('.recruitment-cont').empty();
                num = 1;
                initData[0].page = 1;
                initData[0].pagesize = 4;
                getData();
            });

            // 判断是否滚动到底部
            $(window).scroll(function () {
                var doc_height = $(document).height();
                var scroll_top = $(document).scrollTop();
                var window_height = $(window).height();
                if (scroll_top + window_height >= doc_height && !isLoading) {
                    if(!isNoData){
                        getData()
                    }
                }
            });
            getData();
        })
    }( jQuery ) );
</script>

<?php endif; ?>


<?php get_footer(); ?>