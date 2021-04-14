<?php /* Template Name: keyword */ ?>

<?php get_header(); ?>

<style>
    .ba_search {
        width: 706px;
        height: 66px;
        border-radius: 5px;
        background: #fff;
        overflow: hidden;
        z-index: 9;
        margin: 0 auto;
        box-shadow: 0px 0px 5px rgba(0,0,0,.1);
    }
    
    .page-template-keyword .qodef-content {
        padding-top: 100px;
        background-color: #f7f7f7;
    }

    .page-template-keyword {
        background-color: #f7f7f7;
    }

    #selecthot {
        cursor: pointer;
    }

    .ba_search .text {
        width: 600px;
        height: 66px;
        float: left;
        border: 0;
        font-size: 16px;
        padding-left: 50px;
        color:#333;
        background: url("<?php echo get_template_directory_uri();?>/assets/img/ba_text.png") no-repeat 22px center;
    }

    table td {
        padding: 5px 10px;
        text-align: center;
        height: 50px;
        line-height: 50px;
    }
    .ba_search .sub {
        width: 100px;
        height: 66px;
        float: right;
        background: #007bfc;
        color: #fff;
        font-size: 16px;
    }
    .de_area {
        width: 1198px;
        margin: 0 auto 17px auto;
        position: relative;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 6px;
        margin-top: 80px;
        margin: 0;
        margin-top: 100px;
        margin: 0 auto;
        margin-top: 120px;
        padding: 15px;
    }

    .de_head {
        height: 56px;
        line-height: 56px;
        font-size: 16px;
        font-weight: bold;
        position: relative;
    }
    .de_head .adda {
        display: block;
        height: 36px;
        line-height: 36px;
        border-radius: 5px;
        background: #ebf5ff url("../images/adda.png") no-repeat 11px center;
        position: absolute;
        right: 27px;
        top: 11px;
        font-size: 14px;
        color: #007bfc;
        font-weight: normal;
        padding: 0 12px 0 34px;
    }
    .de_head .adda:hover {
        background:#D5DEE7 url("../images/adda.png") no-repeat 11px center;
    }
    .de_base {
        margin: 22px 25px;
        border: 1px solid #eee;
    }
    .de_base ul {
        width: 860px;
        float: left;
        border-right: 1px solid #eee;
    }
    .de_base li {
        height: 50px;
        line-height: 50px;
        border-bottom: 1px solid #eee;
    }
    .de_base li:last-child {
        border: 0;
    }
    .de_base .tit {
        width: 150px;
        height: 50px;
        float: left;
        background: #f5f7fa;
        text-align: center;
        font-size: 16px;
    }
    .de_base .inf {
        float: left;
        padding-left: 35px;
    }
    .de_base .ti {
        float: left;
        padding-right: 10px;
    }
    .de_base .blue {
        color: #007bfc;
        padding-right: 20px;
        float: left;
    }
    .de_base .photo {
        float: left;
    }
    .de_base .photo {
        float: left;
        width: 284px;
        height: 203px;
        background:url(../images/de_photo.png) no-repeat center;
        position:relative;
    }
    .de_base .photo img {
        width:204px;
        height:128px;
        position:absolute;
        left:50%;
        margin-left:-102px;
        top:50%;
        margin-top:-70px;
    }
    .de_area .fg1 {
        border-bottom: 1px solid #eee;
    }
    
    .de_area tbody th {
        height: 34px;
        background: #f5f7fa;
        font-size: 16px;
        font-weight: normal;
        padding-right: 10px;
        border: none!important;
    }

    table tbody tr, table thead tr {
        border: none!important;
    }



</style>
<div class="ba_search search">
    <input type="hidden" class="hotall" data-kw="iphone" data-on="1" data-ontwo="1"> 

    <?php 
         $keyword  = $_GET['key'];
       
    ?>

    <!-- <form id="form" method="post" > -->
    <input type="text" class="text hotkeywords" placeholder="请输入关键词进行查询" value="<?php echo $keyword; ?>">
    <input id="selecthot" type="button" value="立即查询" class="sub">
    <!-- </form> -->
</div>

<?php if(!empty($keyword)): ?>

<?php 
    $content = file_get_contents("https://www.soyiso.net/CallAPI/hotrecord?key=sys80773beefa6e9d177&keyword=".$keyword); 
    $resultobj = json_decode($content);
    $result = $resultobj->Result; 
    $averagePv = !empty($result->averagePv) ? $result->averagePv : 0;
    $averagePvPc = !empty($result->averagePvPc) ? $result->averagePvPc : 0;
    $averagePvMobile = !empty($result->averagePvMobile) ? $result->averagePvMobile : 0;
    $averageDayPv = !empty($result->averageDayPv) ? $result->averageDayPv : 0;
    $averageDayPvPc = !empty($result->averageDayPvPc) ? $result->averageDayPvPc : 0;
    $averageDayPvMobile = !empty($result->averageDayPvMobile) ? $result->averageDayPvMobile : 0;

?>

<div class="de_area">
  <div class="de_head"><strong class="blue"></strong> 关键词查询结果 </div>
  <table class="de_tab center">
    <tbody><tr>
      <th class="n1">关键词</th>
      <th>周搜索量</th>
      <th>周PC搜索量</th>
      <th>周移动搜索量</th>
      <th>日搜索量</th>
      <th>PC日搜索量</th>
      <th>移动日搜索量</th>
    </tr>
    <tr>
      <td><div class="lt"><?php echo $keyword; ?></div></td>
                <td><?php echo $averagePv; ?></td>
                <td><?php echo $averagePvPc; ?></td>
                <td><?php echo $averagePvMobile; ?></td>
                <td><?php echo $averageDayPv; ?></td>
                <td><?php echo $averageDayPvPc; ?></td>
                <td><?php echo $averageDayPvMobile; ?></td>
            </tr>
  </tbody></table>
</div>


<?php endif; ?>

<script>
    ( function( $ ) {
          'use strict';
           $("#selecthot").click(function(){
               var keyword ="";
               if($(".hotkeywords").val()!=null) {
                    keyword = "/keyword?key="+$(".hotkeywords").val();
               }
               var url = "http://"+window.location.host+keyword;
               window.location.href = url;
           });
    }( jQuery ) );
</script>        
