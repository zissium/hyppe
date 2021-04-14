(function($) {
    'use strict';

    var like = {};
    qodef.modules.like = like;

    like.qodefLikes = qodefLikes;

    like.qodefOnDocumentReady = qodefOnDocumentReady;
    like.qodefOnWindowLoad = qodefOnWindowLoad;
    like.qodefOnWindowResize = qodefOnWindowResize;
    like.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefLikes();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }
    

    function qodefLikes() {

        $(document).on('click','.qodef-like', function() {

            var likeLink = $(this),
                postID = likeLink.data('post-id'),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if(typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'mixtape_qodef_like',
                likes_id: id,
                type: type,
                like_nonce: $('#qodef_like_nonce_'+postID).val()
            };

            var like = $.post(qodefLike.ajaxurl, dataToPass, function( data ) {

                likeLink.html(data).addClass('liked').attr('title','You already like this!');

                likeLink.children('span').css('opacity',1);

            });

            return false;
        });

    }


})(jQuery);