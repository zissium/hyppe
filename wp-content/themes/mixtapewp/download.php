<?php /* Template Name: download */ ?>

<?php get_header(); ?>

<style>
    .content {
        width:1280px;
        margin:auto;
    }
    .title {
        text-align:center;
    }

    .items li {
        width: 25%;
    list-style-type: none;
    padding: 20px;
    border: 1px solid #ccc;
    height:80%;
    cursor: pointer;
    }

    .items .download {
        background-color: #404040;
    color: #fff;
    border: none;
    box-shadow: 2px 2px 3px #b7b7b7;
    }

    .items li:hover {
        color:#fff;
        background-color: #404040;
    }

    .items .download:after {
        content: '';
    margin: 0 auto;
    display: block;
    width: 5px;
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-top: 20px solid #404040;
    position: relative;
    top: 55px;
    }

    .items ,.files ul {
        cursor: default;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    overflow:hidden;
    margin-top:20px;
    height:230px;
    }

    .files ul {
        height:auto;
    }

    .files ul li {
        width:100%;
        padding:20px;
        text-align:center;
        list-style-type:none;
    }

    .files ul li img {
        height:250px;
    }

    .dowanloadfile {
        height:400px;
        width:100%;
        border:1px solid  #ccc;
        margin:30px 0;
    }

    .dowanloadfile h3 {
        
    text-align: center;
    padding: 10px;
    font-weight: bold;
    font-size: 34px;
    }
    
</style>

<!--banner 开始-->
<div class="return-refund_banner">
    <div class="my-container" style="text-align:center;">
    DOWNLOAD
    </div>
</div>
<!--banner 结束-->


<div class="content">
    <h2 class="title">WHAT DO YOU NEED HELP WITH</h2>
    <ul class="items">
         <li class="download">
            <h3>DOWNLOADS</h3>
            <p>View online product manuals/posters, free downloads and periodic updates!</p>								
         </li>
         <li onclick="location='http://hyppeuk.com/faq'" class="faqs">
            <h3>FAQS</h3>
            <p>Any questions about our products and Vozol, see if there are any answers you want.</p>								
         </li>
         <li  onclick="location='http://hyppeuk.com/contact'" class="contactus">
            <h3>CONTACT US</h3>
            <p>If you need any help or would like to collaborate, please feel free to contact us!</p>								
         </li>
    </ul>

    <div class="dowanloadfile">
         <h3>Product Materials</h3>
         <div class="files">
             <ul>
                <li>
                    <a download="Hyppe EU Catalog-20210830" href="http://hyppeuk.com/wp-content/uploads/2021/10/Hyppe-EU-Catalog-20210830-2.pdf"> 
                    <img src="http://hyppeuk.com/wp-content/uploads/2021/10/1200px-PDF_file_icon.svg_.png"/>
                   </a>
                   <h3>Hyppe EU Catalog-20210830</h3>
                </li>

            </ul>
            
         </div>
    </div>    
</div>




<?php get_footer(); ?>