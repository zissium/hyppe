<?php

if ( ! function_exists( 'qodef_core_version_class' ) ) {
	/**
	 * Adds plugins version class to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function qodef_core_version_class( $classes ) {
		$classes[] = 'qodef-core-' . QODE_CORE_VERSION;

		return $classes;
	}

	add_filter( 'body_class', 'qodef_core_version_class' );
}

if ( ! function_exists( 'qodef_core_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function qodef_core_theme_installed() {
		return defined( 'QODE_ROOT' );
	}
}

if ( ! function_exists( 'qodef_core_is_woocommerce_installed' ) ) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function qodef_core_is_woocommerce_installed() {
		return function_exists( 'is_woocommerce' );
	}
}

if ( ! function_exists( 'qodef_core_get_carousel_slider_array' ) ) {
	/**
	 * Function that returns associative array of carousels,
	 * where key is term slug and value is term name
	 * @return array
	 */
	function qodef_core_get_carousel_slider_array() {
		$carousels_array = array();
		$args            = array(
			'taxonomy' => 'carousels_category'
		);
		$terms           = get_terms( $args );

		if ( is_array( $terms ) && count( $terms ) ) {
			$carousels_array[''] = '';
			foreach ( $terms as $term ) {
				$carousels_array[ $term->slug ] = $term->name;
			}
		}

		return $carousels_array;
	}
}

if ( ! function_exists( 'qodef_core_get_carousel_slider_array_vc' ) ) {
	/**
	 * Function that returns array of carousels formatted for Visual Composer
	 *
	 * @return array array of carousels where key is term title and value is term slug
	 *
	 * @see qodef_core_get_carousel_slider_array
	 */
	function qodef_core_get_carousel_slider_array_vc() {
		return array_flip( qodef_core_get_carousel_slider_array() );
	}
}

if ( ! function_exists( 'qodef_core_get_module_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $module name of the module to load
     * @param string $template name of the template file
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return html
     */
    function qodef_core_get_module_template_part( $module, $template, $slug = '', $params = array() ) {

        //HTML Content from template
        $html          = '';
        $template_path = QODE_CORE_ABS_PATH . '/' . $module . '/templates';

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( $template ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}

if ( ! function_exists( 'qodef_core_get_cpt_shortcode_template_part' ) ) {
	/**
	 * Loads cpt shortcode template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @see mixtape_qodef_get_template_part()
	 */
	function qodef_core_get_cpt_shortcode_template_part( $shortcode, $template, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_CPT_PATH . '/' . $shortcode . '/shortcodes/templates';

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp . '.php';
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'qodef_core_get_shortcode_template_part' ) ) {
	/**
	 * Loads shortcode template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see mixtape_qodef_get_template_part()
	 */
	function qodef_core_get_shortcode_template_part( $template, $module, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_ABS_PATH . '/shortcodes/' . $module;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		//$template = array();
		//
		//if ( $temp !== '' ) {
		//	if ( $slug !== '' ) {
		//		$template[] = "{$temp}-{$slug}.php";
		//	}
		//
		//	$template[] = $temp . '.php';
		//}
		//$located = mixtape_qodef_find_template_path( $templates );

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		//var_dump( $template );

		return $html;
	}
}

if ( ! function_exists( 'mixtape_qodef_add_user_custom_fields' ) ) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function mixtape_qodef_add_user_custom_fields( $user_contact ) {
		/**
		 * Function that add custom user fields
		 **/
		$user_contact['facebook']   = esc_html__( 'Facebook', 'mixtapewp' );
		$user_contact['twitter']    = esc_html__( 'Twitter', 'mixtapewp' );
		$user_contact['linkedin']   = esc_html__( 'Linkedin', 'mixtapewp' );
		$user_contact['instagram']  = esc_html__( 'Instagram', 'mixtapewp' );
		$user_contact['pinterest']  = esc_html__( 'Pinterest', 'mixtapewp' );
		$user_contact['tumblr']     = esc_html__( 'Tumbrl', 'mixtapewp' );
		$user_contact['googleplus'] = esc_html__( 'Google Plus', 'mixtapewp' );

		return $user_contact;
	}

	add_filter( 'user_contactmethods', 'mixtape_qodef_add_user_custom_fields' );
}

/**
 * Function that checks if url exists
 *
 * @param $url string url to check
 *
 * @return bool
 */
function mixtape_qodef_url_exists( $url ) {
	$url = str_replace( "http://", "", $url );
	if ( strstr( $url, "/" ) ) {
		$url    = explode( "/", $url, 2 );
		$url[1] = "/" . $url[1];
	} else {
		$url = array( $url, "/" );
	}

	$fh = fsockopen( $url[0], 80 );
	if ( $fh ) {
		fputs( $fh, "GET " . $url[1] . " HTTP/1.1\nHost:" . $url[0] . "\n\n" );
		if ( fread( $fh, 22 ) == "HTTP/1.1 404 Not Found" ) {
			return false;
		} else {
			return true;
		}

	} else {
		return false;
	}
}

if ( ! function_exists( 'qodef_core_init_shortcode_loader' ) ) {
	function qodef_core_init_shortcode_loader() {

		include_once 'shortcode-loader.php';
	}

	add_action( 'mixtape_qodef_shortcode_loader', 'qodef_core_init_shortcode_loader' );
}

if ( ! function_exists( 'qodef_core_set_portfolio_ajax_url' ) ) {
	/**
	 * load themes ajax functionality
	 *
	 */
	function qodef_core_set_portfolio_ajax_url() {
		echo '<script type="application/javascript">var qodefCoreAjaxUrl = "' . admin_url( 'admin-ajax.php' ) . '"</script>';
	}

	add_action( 'wp_enqueue_scripts', 'qodef_core_set_portfolio_ajax_url' );

}

add_action( 'wp_ajax_nopriv_qodef_core_portfolio_ajax_load_more', 'qodef_core_portfolio_ajax_load_more' );


/**
 * Loads more function for albums.
 *
 */
if ( ! function_exists( 'qodef_core_albums_ajax_load_more' ) ) {

	function qodef_core_albums_ajax_load_more() {

		$return_obj       = array();
		$shortcode_params = array();

		if ( ! empty( $_POST['type'] ) ) {
			$shortcode_params['type'] = $_POST['type'];
		}
		if ( ! empty( $_POST['columns'] ) ) {
			$shortcode_params['columns'] = $_POST['columns'];
		}
		if ( ! empty( $_POST['orderBy'] ) ) {
			$shortcode_params['order_by'] = $_POST['orderBy'];
		}
		if ( ! empty( $_POST['order'] ) ) {
			$shortcode_params['order'] = $_POST['order'];
		}
		if ( ! empty( $_POST['number'] ) ) {
			$shortcode_params['number'] = $_POST['number'];
		}
		if ( ! empty( $_POST['label'] ) ) {
			$shortcode_params['label'] = $_POST['label'];
		}
		if ( ! empty( $_POST['artist'] ) ) {
			$shortcode_params['artist'] = $_POST['artist'];
		}
		if ( ! empty( $_POST['genre'] ) ) {
			$shortcode_params['genre'] = $_POST['genre'];
		}
		if ( ! empty( $_POST['selectedAlbums'] ) ) {
			$shortcode_params['selected_albums'] = $_POST['selectedAlbums'];
		}
		if ( ! empty( $_POST['showLoadMore'] ) ) {
			$shortcode_params['show_load_more'] = $_POST['showLoadMore'];
		}
		if ( ! empty( $_POST['nextPage'] ) ) {
			$shortcode_params['next_page'] = $_POST['nextPage'];
		}
        if ( ! empty( $_POST['showStores'] ) ) {
            $shortcode_params['show_stores'] = $_POST['showStores'];
        }
        if ( ! empty( $_POST['storesList'] ) ) {
            $shortcode_params['stores_list'] = $_POST['storesList'];
        }
		$html = '';

		$albums_list   = new \QodeCore\PostTypes\Albums\Shortcodes\AlbumsList();
		$query_array   = $albums_list->getQueryArray( $shortcode_params );
		$query_results = new \WP_Query( $query_array );

		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();

				$shortcode_params['current_id'] = get_the_ID();
				$shortcode_params['album_link'] = get_permalink( get_the_ID() );
                $shortcode_params['artist_html'] = $albums_list->getAlbumArtistsHtml($shortcode_params);

				if ( $shortcode_params['type'] == 'standard-with-space' || $shortcode_params['type'] == 'standard-no-space' ) {
					$template = 'standard';
				} else {
					$template = 'gallery';
				}

				$html .= qodef_core_get_cpt_shortcode_template_part( 'albums', $template, '', $shortcode_params );

			endwhile;
		else:
			$html .= '<p>' . __( 'Sorry, no posts matched your criteria.', 'qodef-cpt' ) . '</p>';
		endif;

		$return_obj = array(
			'html' => $html,
		);


		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_qodef_core_albums_ajax_load_more', 'qodef_core_albums_ajax_load_more' );
add_action( 'wp_ajax_qodef_core_albums_ajax_load_more', 'qodef_core_albums_ajax_load_more' );

/**
 * Loads more function for events.
 *
 */
if ( ! function_exists( 'qodef_core_events_ajax_load_more' ) ) {

	function qodef_core_events_ajax_load_more() {

		$return_obj       = array();
		$shortcode_params = array();

		if ( ! empty( $_POST['orderBy'] ) ) {
			$shortcode_params['order_by'] = $_POST['orderBy'];
		}
		if ( ! empty( $_POST['order'] ) ) {
			$shortcode_params['order'] = $_POST['order'];
		}
		if ( ! empty( $_POST['number'] ) ) {
			$shortcode_params['number'] = $_POST['number'];
		}
		if ( ! empty( $_POST['showLoadMore'] ) ) {
			$shortcode_params['show_load_more'] = $_POST['showLoadMore'];
		}
		if ( ! empty( $_POST['nextPage'] ) ) {
			$shortcode_params['next_page'] = $_POST['nextPage'];
		}
		if ( ! empty( $_POST['titleTag'] ) ) {
			$shortcode_params['title_tag'] = $_POST['titleTag'];
		}
		if ( ! empty( $_POST['buttonSkin'] ) ) {
			$shortcode_params['button_skin'] = $_POST['buttonSkin'];
		}
		if ( ! empty( $_POST['textColor'] ) ) {
			$shortcode_params['text_color_style'] = 'color:' . $_POST['textColor'];
		}
		if ( ! empty( $_POST['borderColor'] ) ) {
			$shortcode_params['border_color_style'] = 'border-color:' . $_POST['borderColor'];
		}

		if ( $_POST['buttonShape'] == 'rounded' ) {
			$shortcode_params['border_radius'] = 'yes';
		} else {
			$shortcode_params['border_radius'] = 'no';
		}

		$html = '';

		$events_list   = new \QodeCore\PostTypes\Events\Shortcodes\EventsList();
		$query_array   = $events_list->getQueryArray( $shortcode_params );
		$query_results = new \WP_Query( $query_array );

		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();

				$shortcode_params['current_id']     = get_the_ID();
				$shortcode_params['event_link']     = get_permalink( get_the_ID() );
				$shortcode_params['title']          = get_the_title( $shortcode_params['current_id'] );
				$shortcode_params['date']           = get_post_meta( $shortcode_params['current_id'], 'qodef_event_item_date', true );
				$shortcode_params['link']           = get_post_meta( $shortcode_params['current_id'], 'qodef_event_item_link', true );
				$shortcode_params['target']         = get_post_meta( $shortcode_params['current_id'], 'qodef_event_item_target', true );
				$shortcode_params['tickets_status'] = get_post_meta( $shortcode_params['current_id'], 'qodef_event_item_tickets_status', true );

				$html .= qodef_core_get_cpt_shortcode_template_part( 'events', 'events-list-template', '', $shortcode_params );

			endwhile;
		else:
			$html .= '<p>' . esc_html__( 'Sorry, no events matched your criteria.', qodef - cpt ) . '</p>';
		endif;

		$return_obj = array(
			'html' => $html,
		);


		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_qodef_core_events_ajax_load_more', 'qodef_core_events_ajax_load_more' );
add_action( 'wp_ajax_qodef_core_events_ajax_load_more', 'qodef_core_events_ajax_load_more' );


if ( ! function_exists( 'qodef_core_album_playlist' ) ) {

	function qodef_core_album_playlist() {

		if ( isset( $_POST ) && isset( $_POST['album_id'] ) ) {

			$album_id  = $_POST['album_id'];
			$json_data = array();
			$tracks    = get_post_meta( $album_id, 'qodef_track_file', true );
			$titles    = get_post_meta( $album_id, 'qodef_track_title', true );
			$i         = 0;

			$artists       = wp_get_post_terms( $album_id, 'album-artist' );
			$artists_names = array();

			if ( is_array( $artists ) && count( $artists ) ) :
				foreach ( $artists as $artist ) {
					$artists_names[] = $artist->name;
				}
			endif;

			if ( $tracks ) {
				foreach ( $tracks as $track ) {

					$track_id                     = qodef_core_get_attachment_id_from_url( $track );
					$json_data[ $i ]['unique_id'] = 'qodef-unique-track-' . $album_id . '-' . $track_id;
					$json_data[ $i ]['mp3']       = $track;

					if ( $titles[ $i ] ) {
						$json_data[ $i ]['title'] = $titles[ $i ];
					}
					$json_data[ $i ]['album_name'] = get_the_title( $album_id );
					$i ++;
				}
				qodef_core_ajax_status( 'success', '', $json_data );
			} else {
				qodef_core_ajax_status( 'error', esc_html__( 'No tracks Founded.', 'qodef-cpt' ), $json_data );
			}


		}

		wp_die();
	}
}


add_action( 'wp_ajax_nopriv_qodef_core_album_playlist', 'qodef_core_album_playlist' );
add_action( 'wp_ajax_qodef_core_album_playlist', 'qodef_core_album_playlist' );

if ( ! function_exists( 'qodef_core_ajax_status' ) ) {

	function qodef_core_ajax_status( $status, $message, $data = null ) {

		$response = array(
			'status'  => $status,
			'message' => $message,
			'sdata'   => $data
		);

		$output = json_encode( $response );

		exit( $output );

	}

}

if ( ! function_exists( 'qodef_core_get_attachment_id_from_url' ) ) {
	/**
	 * Function that retrieves attachment id for passed attachment url
	 *
	 * @param $attachment_url
	 *
	 * @return null|string
	 */
	function qodef_core_get_attachment_id_from_url( $attachment_url ) {
		global $wpdb;
		$attachment_id = '';

		//is attachment url set?
		if ( $attachment_url !== '' ) {
			//prepare query

			$query = $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid=%s", $attachment_url );

			//get attachment id
			$attachment_id = $wpdb->get_var( $query );
		}

		//return id
		return $attachment_id;
	}
}

if ( ! function_exists( 'qodef_cpt_theme_setup' ) ) {

	function qodef_cpt_theme_setup() {

		add_filter( 'widget_text', 'do_shortcode' );

	}

	add_action( 'plugins_loaded', 'qodef_cpt_theme_setup' );
}
if ( ! function_exists( 'qodef_core_inline_style' ) ) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param $value string | array attribute value
	 *
	 */
	function qodef_core_inline_style( $value ) {
		echo qodef_core_get_inline_style( $value );
	}
}

if ( ! function_exists( 'qodef_core_get_inline_style' ) ) {
	/**
	 * Function that generates style attribute and returns generated string
	 *
	 * @param $value string | array value of style attribute
	 *
	 * @return string generated style attribute
	 *
	 */
	function qodef_core_get_inline_style( $value ) {
		return qodef_core_get_inline_attr( $value, 'style', ';' );
	}
}

if ( ! function_exists( 'qodef_core_class_attribute' ) ) {
	/**
	 * Function that echoes class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @see qodef_core_get_class_attribute()
	 */
	function qodef_core_class_attribute( $value ) {
		echo qodef_core_get_class_attribute( $value );
	}
}

if ( ! function_exists( 'qodef_core_get_class_attribute' ) ) {
	/**
	 * Function that returns generated class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @return string generated class attribute
	 *
	 * @see qodef_core_get_inline_attr()
	 */
	function qodef_core_get_class_attribute( $value ) {
		return qodef_core_get_inline_attr( $value, 'class', ' ' );
	}
}

if ( ! function_exists( 'qodef_core_get_inline_attr' ) ) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function qodef_core_get_inline_attr( $value, $attr, $glue = '' ) {
		if ( ! empty( $value ) ) {

			if ( is_array( $value ) && count( $value ) ) {
				$properties = implode( $glue, $value );
			} elseif ( $value !== '' ) {
				$properties = $value;
			}

			return $attr . '="' . esc_attr( $properties ) . '"';
		}

		return '';
	}
}

if ( ! function_exists( 'qodef_core_inline_attr' ) ) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function qodef_core_inline_attr( $value, $attr, $glue = '' ) {
		echo qodef_core_get_inline_attr( $value, $attr, $glue );
	}
}

if ( ! function_exists( 'qodef_core_get_inline_attrs' ) ) {
	/**
	 * Generate multiple inline attributes
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	function qodef_core_get_inline_attrs( $attrs ) {
		$output = '';

		if ( is_array( $attrs ) && count( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$output .= ' ' . qodef_core_get_inline_attr( $value, $attr );
			}
		}

		ltrim( $output );

		return $output;
	}
}
if ( ! function_exists( 'qodef_cpt_is_revolution_slider_installed' ) ) {
	function qodef_cpt_is_revolution_slider_installed() {
		if ( class_exists( 'RevSliderFront' ) ) {
			return true;
		}

		return false;
	}
}


/* Function for adding custom meta boxes hooked to default action */
if ( class_exists( 'WP_Block_Type' ) && defined( 'QODE_ROOT' ) ) {
	add_action( 'admin_head', 'mixtape_qodef_meta_box_add' );
} else {
	add_action( 'add_meta_boxes', 'mixtape_qodef_meta_box_add' );
}

if ( ! function_exists( 'mixtape_qodef_create_meta_box_handler' ) ) {
	function mixtape_qodef_create_meta_box_handler( $box, $key, $screen ) {
		add_meta_box(
			'qodef-meta-box-' . $key,
			$box->title,
			'mixtape_qodef_render_meta_box',
			$screen,
			'advanced',
			'high',
			array( 'box' => $box )
		);
	}
}


//add_meta_box(
//	'qodef-meta-box-' . $key,
//	$box->title,
//	'mixtape_qodef_render_meta_box',
//	$screen,
//	'advanced',
//	'high',
//	array( 'box' => $box )
//);