<?php /* Template Name: kol_search */ ?>

<?php get_header(); ?>


<style>
      .qodef-content {
            background-color: #f1f1f1;
            margin-top: 0;
            position: relative;
            z-index: 100;
        }
      /*KOL预算计算器*/
      .index-kol{
            width: 100%;
            background: url("/public/images/xmb_index/index_kol_bg.png") center no-repeat;
            overflow: hidden;
        }

        .qodef-side-menu-slide-from-right .qodef-wrapper {
            background-color: #f1f1f1!important;
        }

        /*公共标题*/
        .xmb-common-title{
            margin-top: 70px;
        }
        .xmb-common-title>h2{
            font-size: 28px;
            color: #333;
            text-align: center;
            font-weight: 500;
            letter-spacing: 2px;
        }
        .xmb-line-2{
            width: 46px;
            height: 2px;
            background: #5185FF;
            margin: 17px auto 0;
        }
        .txt-white > h2{
            color: #fff;
        }
        .txt-white > .xmb-line-2{
            background-color: #fff;
        }
        .index-title-tips{
            font-size: 18px;
            color: #666;
            text-align: center;
            margin-top: 22px;
            margin-bottom: 26px;
        }
        .index-kol-content{
            width: 85%;
            margin: 0 auto;
            padding-top: 1px;
            background-color: #fff;
            box-shadow:3px 9px 24px 0px rgba(209,220,251,0.4);
            border-radius:20px;
            position: relative;
            margin-bottom: 100px;
        }
       
        .searchBar {
            padding: 30px;
            text-align: center;
        }

        .searchBar .ms-parent > button {
            width: 180px!important;
            height: 40px;
            line-height: 40px;
            border: 1px solid #000;
            color: #000;
        }

        .searchBar .costs {
            border: 1px solid #000;
            height: 40px;
            line-height: 40px;
            text-indent: 10px;
            border-radius: 3px;
            width: 180px;
            position: relative;
            top: 2px;
        }


        .submit ,.clear {   
            height: 40px;
            /* line-height: 40px; */
            width: 100px;
            border: none;
            color: #fff;
            background: #3699ff;
            border-radius: 5px;
            margin-right: 10px;
       }

       .clear {   
           
            background: #333;
            
       }

       .ms-drop {

            width: 180px!important;
            border: none!important;
            box-shadow: none!important;
            margin-top: 5px!important;
            padding-bottom: 10px!important;
            border: 1px solid #e2e2e2!important;

       } 
       
       .avatar img {
           width:100%;
       }

       .kolList li ,._kolList li{
           list-style-type: none;
           
       }

       .kolList > li {
            border-bottom: 1px solid #e8e8e8;
            padding-bottom: 15px;
            margin-bottom: 15px;
           
       }

       .kolList {
           padding: 30px 0px;
       }

       ._kolList > li:nth-child(even) {
           background-color: #f7f7f7;
       }

       ._kolList {
            margin-top: 35px;
       }

       ._kolList > li {
          padding: 30px 0;
       }

      
       .starinfo .header {
           overflow: hidden;
       }

       .avatar {
            width: 40%;
            border-radius: 100%;
       }

       .infolist {
           overflow: hidden;
           margin-top:20px;
       }

       .infolist .value {
            display: block;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            width: 80%;
            font-size: 13px;
       }

       .infolist li {
           float:left;
           width:11%;
       }

       .infolist li:first {
           text-align: center;
       }

       .infolist li .label {
           font-weight: bold;
           display: inline-block;
           margin-bottom: 10px;

       }

       .rightcontent {
            float: left;
            margin-left: 30px;
       }

       .rightcontent  .name {
           margin-right: 20px;
           font-weight: bold;
       }

       .industry {
           margin-top:20px;
       }

       .industry .industry_list {
            margin-right: 15px;
            padding: 5px;
            background-color: #e8e8e8;
            border-radius: 5px;
            font-size: 12px;
       }

       .kolcontent {
            height: 74%;
            overflow-x: -webkit-paged-x;
            overflow-x: auto;
       }

       .index-kol-content {
           overflow: hidden;
       }

       .get_costs {
            border: none;
            background-color: #0099ff;
            color: #fff;
            height: 35px;
            border-radius: 10px;
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
    background-color: #0099ff;
    color: #ffffff;
    margin-left: 10px;
    margin-right: 10px;
}

.cursor {
    cursor: pointer;
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



.costWrapper {
    padding: 20px;
    position: fixed;
    left: 32%;
    background-color: #fff;
    width: 500px;
    top: 20%;
    text-align: center;
    border: 1px solid # ccc;
    box-shadow: 1px 1px 5px #b1b1b1;
}

.costWrapper  label {
    text-align: left;
}

.costWrapper form input {
    margin-top: 10px!important;
}

.ms-drop ul > li {
    list-style: none;
    display: list-item;
    background-image: none;
    position: static;
    text-align: left;
    padding-left: 15px;
}


.close {
    display: block;
    position: absolute;
    /* left: 0; */
    width: 30px;
    height: 30px;
    right: -10px;
    top: -12px;
    opacity: 1;
}

.loading {
    position: absolute;
    top: 0;
    /* width: 30%; */
    left: 40%;
    top: 20%
}

.yellowbg {
    overflow: auto!important;
    width: auto!important;
    text-overflow: unset!important;
    background-color: #FFEB3B!important;
    padding: 3px;
    text-align: center;
    box-shadow: 1px 1px 3px #d4d4d4;
}

.loading  img {
    width:30%;
}

.wpcf7-not-valid-tip {
    display: none;
}

#submit_comment, .post-password-form input[type=submit], input.wpcf7-form-control.wpcf7-submit {
    width:100%;
}


@media only screen and (min-width: 767px) {
    .infolist li {
        float:none;
        width:100%;
    }

    .searchBar .costs {
        border: 1px solid #000;
        height: 40px;
        line-height: 40px;
        text-indent: 10px;
        border-radius: 3px;
        width: 100%;
        position: relative;
        top: 2px;
        margin-bottom: 20px;
    }   

    .ms-parent {
        display: block!important;
        position: relative;
        vertical-align: middle;
    }

    .searchBar .ms-parent > button {
        margin-bottom: 20px;
        width: 100%!important;
        height: 40px;
        line-height: 40px;
        border: 1px solid #000;
        color: #000;
    }


}
  

</style>


<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/multiple-select.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/js/jquery.multiple.select.js"></script>


<div class="kolWrapper">
<div class="index-kol">
    <div class="xmb-common-title">
        <h2>KOL预算计算器</h2>
        <div class="xmb-line-2"></div>
    </div>
    <p class="index-title-tips">计算KOL预算价格以及平均粉丝</p>
    <div class="index-kol-content">
        <div class="searchBar" style="display:none;">
             
        
            <select multiple='multiple'  name="industry" id="industry" aria-invalid="false"></select>

            <select multiple='multiple'  id="country">
        
            </select>

            <select multiple='multiple'  id="platform">
            </select>
            <input type="text" placeholder="您的预算" class="costs" name="costs"/>
            <button class="cursor submit">确定</button>
            <button class="cursor clear">清除</button>
        </div>

        <div class="kolcontent">
       <ul class="_kolList"></ul>
       <div class="loading" style="display:none;">
            <img src="<?php echo get_template_directory_uri();?>/assets/img/loading.gif"" class="loadingimg" />
       </div> 
       <div style="display:none;" class="costWrapper">
            我们的营销顾问会第一时间联系您
            <?php echo do_shortcode( '[contact-form-7 id="11272" title="kol customer info"]' ); ?>
            <img class="close" src="<?php echo get_template_directory_uri();?>/assets/img/close.png" />
        </div>   
</div>
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

</div>


<script>
$(function() {


     $("body").on("click",".get_costs",function(){
          $(".costWrapper").show();
     });


     $("body").on("click",".close",function(){
        $(".costWrapper").hide();
     });


    $(".submit").click(function(){
          getData();
    });


    $(".clear").click(function(){
        window.location.reload(); 
    });

    $("body").on("hover",".infolist ._name",function(){
        $(this).addClass("yellowbg");
    });

    $("body").on("mouseout",".infolist ._name",function(){
        $(this).removeClass("yellowbg");
    });


    



            // 初始化数据
            var initData=[{
                page: 1,
                pagesize: 12,
                region: 'en',
                platform_val: "",
                costs: "",
                country_val: "",
                industry_val: "",
            }];

    
      // 封装请求数据方法
      function getData(){
                
                initData[0].industry_val = $("#industry").val();
                initData[0].country_val = $("#country").val();
                initData[0].platform_val = $("#platform").val();
                initData[0].costs = $(".costs").val();

                $('._kolList').empty();
                $('#page').empty();
                
                $.ajax({
                    type:'GET',
                    url: "https://ho.media/wp-json/kol/v1/getkol", 
                    data:{
                        pagesize:initData[0].pagesize,
                        industry_val:initData[0].industry_val,
                        page:initData[0].page,
                        platform_val:initData[0].platform_val,
                        country_val:initData[0].country_val,
                        costs:initData[0].costs,
                    },
                    beforeSend:function(){
                         $(".loading").show();
                    },    
                    success:function(data){
                        $(".loading").hide();
                        $(".searchBar").show();
                        var nhtml = '',
                            ndata = data.data,
                            num = 1,
                            pageNum = 0,
                            btn_html = '',
                            options_industrys_html="",
                            options_country_html="",
                            options_platform_html="",
                            options_industrys = data.options.industry_options,
                            country_options = data.options.country_options,
                            platform_options = data.options.platform_options,
                            btns_html = '';
                        
                        for (var i in  options_industrys) {
                            options_industrys_html += '<option value="'+options_industrys[i]+'">' + options_industrys[i] + '</option>'
                        }

                        for (var i in  country_options) {
                            options_country_html += '<option value="'+country_options[i]+'">' + country_options[i] + '</option>'
                        }

                        for (var i in  platform_options) {
                            options_platform_html += '<option value="'+platform_options[i]+'">' + platform_options[i] + '</option>'
                        }

                        if(initData[0].industry_val == null) {
                            $("#industry").html(options_industrys_html);
                            $("#industry").multipleSelect({
                                // placeholder text
                                placeholder: '请选择行业',
                                selectAllText: "全选",
                            });
                        }

                        if(initData[0].country_val == null) {
                            $("#country").html(options_country_html);
                            $("#country").multipleSelect({
                               // placeholder text
                               placeholder: '请选择国家地区',
                               selectAllText: "全选",
                            });

                        }

                        if(initData[0].platform_val == null) {
                            $("#platform").html(options_platform_html);  
                            $("#platform").multipleSelect({
                                // placeholder text
                                placeholder: '请选择平台',
                                selectAllText: "全选",
                            });  
                        }

                        if(parseInt(initData[0].page/5)!=0) {
                            pageNum = parseInt(initData[0].page/5)*5-1;
                        }
                        else {
                            pageNum = parseInt(initData[0].page/5)*5
                        }


                        if(initData[0].page == 5) {
                            pageNum = 0;
                        }

                       
                        if(initData[0].page > 5) {
                            btn_html += '<li class="page_'+pageNum+'">.....<span style="display:none;">' + pageNum + '</span></li>'
                        }
                        
                        
                        for (var j = 0; j <= 5; j++) { 
                            pageNum++;
                            btn_html += '<li class="page_'+pageNum+'"><span>' + pageNum + '</span></li>'
                            if(pageNum == data.tolpage) {
                                break;
                            }
                        }

                        if(pageNum < data.tolpage) {
                            btn_html += '<li class="page_'+pageNum+'">.....<span style="display:none;">' + pageNum + '</span></li>'
                        }
                        btns_html = '<button class="cursor previous-btn fa fa-angle-left" disabled></button><ul class="pagination-list">' +btn_html+ '</ul><button class="next-btn cursor fa fa-angle-right"></button>';
                    
                        $('#page').append(btns_html);
                                    contrlLi();
                                    nextDisabled();
                                    preDisabled();

                        for (var i in ndata) {
                            //console.log(i);


                            var avatar_link = ndata[i].avatar_link;
                            var budget =  ndata[i].budget;
                            var country_region =  ndata[i].country_region;
                            var display_volume =  ndata[i].display_volume;
                            var fans_num = ndata[i].fans_num;
                            var industry = ndata[i].industry;
                            var name = ndata[i].name;
                            var platform = ndata[i].platform;
                            var roi_forecast = ndata[i].roi_forecast;
                            var update_frequency = ndata[i].update_frequency;

                            var close_img = "<?php echo get_template_directory_uri();?>/assets/img/close.png";


                            nhtml += '<li class="content"><ul class="infolist"><li style="text-align: center;"><img src="'+avatar_link+'" class="avatar"/></li><li><span class="label">账号</span></br><span class="_name cursor value">'+name+'</span></li><li><span class="label">国家</span></br><span class="value">'+country_region+'</span></li><li><span class="label">行业</span></br><span class="value">'+industry+'</span></li><li><span class="label">粉丝数量</span></br><span class="value">'+fans_num+'</span></li><li><span class="label">更新频率</span></br><span class="value">'+update_frequency+'</span></li><li><span class="label">180天展示量</span></br><span class="value">'+display_volume+'</span></li><li><span class="label">90天ROI</span></br><span class="value">'+roi_forecast+'</span></li><li class="oprate"><button class="get_costs cursor" type="button">获取报价</button></li></ul></li>';
                         
                        }
                        $('._kolList').append(nhtml)            
                    }
                }); 
            }

          


     // 分页请求
        // 初始化
        // 高亮
        function light(obj) {    //点击页码高亮样式，当前页码
            debugger;
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
                    light($('#page ul li.page_'+initData[0].page));
                    $(this).click(function () {
                        initData[0].page = $(this).find("span").html();
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
    
     

});
</script>


<?php get_footer(); ?>