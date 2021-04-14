<?php

require_once 'const.php';
require_once 'lib/helpers/helpers.php';

//load export
require_once 'export/functions.php';

//load lib
require_once 'lib/post-type-interface.php';
require_once 'lib/google-fonts.php';
require_once 'lib/shortcode-interface.php';

// load widgets
require_once 'widgets/lib/widget-functions.php';

// load shortcodes
require_once 'shortcodes/lib/shortcode-functions.php';

//load post-post-types
require_once 'post-types/testimonials/testimonials-register.php';
require_once 'post-types/testimonials/shortcodes/testimonials.php';
require_once 'post-types/carousels/carousel-register.php';
require_once 'post-types/carousels/shortcodes/carousel.php';
require_once 'post-types/slider/slider-register.php';
require_once 'post-types/slider/tax-custom-fields.php';
require_once 'post-types/slider/shortcodes/slider.php';
require_once 'post-types/events/events-register.php';
require_once 'post-types/events/shortcodes/events-list.php';
require_once 'post-types/albums/albums-register.php';
require_once 'post-types/albums/artists-custom-fields.php';
require_once 'post-types/albums/shortcodes/albums-list.php';
require_once 'post-types/albums/shortcodes/album-player.php';
require_once 'post-types/albums/shortcodes/album.php';
require_once 'post-types/albums/shortcodes/artists-list.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last


//load shortcodes inteface
require_once 'lib/shortcode-loader.php';

if ( file_exists( QODE_CORE_ABS_PATH . '/core-dashboard' ) ) {
    require_once 'core-dashboard/load.php';
}