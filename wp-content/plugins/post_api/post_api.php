<?php
/*
Plugin Name: post api
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: 插件的简单描述
Version: 插件版本号, 例如: 1.0
Author: 插件作者
*/

   function getRegionName($pid) {
        $catagory = get_the_category($pid);
        $parentid = 87;
        foreach($catagory as $item) {
             if($item->parent == $parentid) {
                 return $item->cat_name;
             }
        }
        
   }

    function getPostContent($parm){
        global $wpdb;
     
   	    $pagesize = $parm['pagesize'] ? $parm['pagesize'] : 1;
   	    $page = $parm['page'] ? $parm['page'] : 1;

   	    $keyword = $parm['keywords'];
         
        $regionname = $parm['region'] ? $parm['region'] : 1;

        $rid = "";
        $limit = "'"+($pagesize * ($page-1)) . "," . $pagesize;

        if($regionname != 1) {
            $querystr="SELECT * FROM `wp_posts` wp  left join `wp_term_relationships`wtr on wp.ID = wtr.object_id left join `wp_terms` wps on wtr.term_taxonomy_id = wps.`term_id`   where wps.name = '".$regionname."' and (wp.`post_content` like '%$keyword%' or wp.`post_title` like '%$keyword%')";

            $querystrlimit = "SELECT * FROM `wp_posts` wp  left join `wp_term_relationships`wtr on wp.ID = wtr.object_id left join `wp_terms` wps on wtr.term_taxonomy_id = wps.`term_id`   where wps.name = '".$regionname."' and (wp.`post_content` like '%$keyword%' or wp.`post_title` like '%$keyword%') limit ".$limit; 
        }
        else {
            $querystr="SELECT * FROM `wp_posts` wp  left join `wp_term_relationships`wtr on wp.ID = wtr.object_id left join `wp_terms` wps on wtr.term_taxonomy_id = wps.`term_id`   where wps.name = 'job' and (wp.`post_content` like '%$keyword%' or wp.`post_title`like '%$keyword%')";
            $querystrlimit="SELECT * FROM `wp_posts` wp  left join `wp_term_relationships`wtr on wp.ID = wtr.object_id left join `wp_terms` wps on wtr.term_taxonomy_id = wps.`term_id`   where wps.name = 'job' and (wp.`post_content` like '%$keyword%' or wp.`post_title` like '%$keyword%') LIMIT ".$limit;
        }

  
        $pageposts = $wpdb->get_results($querystr);
        
        $count = count($pageposts);
        $total_page = (int)($count / $pagesize);
        $total_page = ($total_page == 0)? 1 : $total_page;

        if($count == 0) {
            $total_page  = 0;
        }

        
        $pageposts = $wpdb->get_results($querystrlimit); 
       
        $list = array();
        $i=0;
        foreach($pageposts as $key=>$item) {
            $list[$i]['country_or_region'] = getRegionName($item->ID);
            $list[$i]['create_time'] = $item->post_date;
            $list[$i]['id'] = $item->ID;
            $list[$i]['is_active'] = $item->post_status;
            $list[$i]['job_desc'] = $item->post_content;
            $list[$i]['job_key_res'] = $item->post_content;
            $list[$i]['title'] = $item->post_title;
            $list[$i]['update_time'] = $item->post_modified;
            $i++;
        }

        $data['count'] = $count;
        $data['list'] = $list;
        $data['totalpage'] = $total_page;

        $result['data'] = $data;
        $result['status'] = 1;
        $result['message'] = "成功返回数据";
        return $result;
      
    }

   add_action("rest_api_init",function(){
       register_rest_route("v1/posts","content",[
           "methods" => "get",
           "callback" => "getPostContent",
       ]);
   });


?>