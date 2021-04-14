<?php

function qodef_slides_category_taxonomy_custom_fields($tag) {
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" );
    ?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Slider shortcode', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <input type="text" name="term_meta[shortcode]" id="term_meta[shortcode]" size="25" style="width:60%;" value="<?php echo esc_attr($tag->slug) ? "[qodef_slider slider='".$tag->slug."']" : ""; ?>" readonly><br />
            <span class="description"><?php esc_html_e('Use this shortcode to insert it on page', 'qodef-cpt'); ?></span>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Anchor', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <input type="text" name="term_meta[anchor]" id="term_meta[anchor]" value="<?php if( isset($term_meta['anchor']) && $term_meta['anchor'] != '' ){ echo esc_attr($term_meta['anchor']); } ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Effect on header (dark/light style)', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[header_effect]" id="term_meta[header_effect]">
                <option <?php if( $term_meta['header_effect'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
                <option <?php if( $term_meta['header_effect'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Show prev/next thumbs (except for side menu or passepartout)', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[slider_thumbs]" id="term_meta[slider_thumbs]">
                <option <?php if(isset($term_meta['slider_thumbs']) &&  $term_meta['slider_thumbs'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
                <option <?php if(isset($term_meta['slider_thumbs']) &&  $term_meta['slider_thumbs'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Show navigation thumbs', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[slider_nav_thumbs]" id="term_meta[slider_nav_thumbs]">
                <option <?php if( isset($term_meta['slider_nav_thumbs']) && $term_meta['slider_nav_thumbs'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['slider_nav_thumbs']) && $term_meta['slider_nav_thumbs'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Show slide number', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[slider_numbers]" id="term_meta[slider_numbers]">
                <option <?php if(isset($term_meta['slider_numbers']) && $term_meta['slider_numbers'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
                <option <?php if(isset($term_meta['slider_numbers']) && $term_meta['slider_numbers'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Parallax effect', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[slider_parallax_effect]" id="term_meta[slider_parallax_effect]">
                <option <?php if( isset($term_meta['slider_parallax_effect']) && $term_meta['slider_parallax_effect'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['slider_parallax_effect']) && $term_meta['slider_parallax_effect'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Auto start', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[auto_start]" id="term_meta[auto_start]">
                <option <?php if( isset($term_meta['auto_start']) && $term_meta['auto_start'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['auto_start']) && $term_meta['auto_start'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Slides Animation', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[animation_type]" id="term_meta[animation_type]">
                <option <?php if( isset($term_meta['animation_type']) && $term_meta['animation_type'] == 'slide' ){ echo "selected='selected'"; } ?> value="slide"><?php esc_html_e('Slide Horizontally', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['animation_type']) && $term_meta['animation_type'] == 'slide-vertical-up' ){ echo "selected='selected'"; } ?> value="slide-vertical-up"><?php esc_html_e('Slide Vertically - Up', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['animation_type']) && $term_meta['animation_type'] == 'slide-vertical-down' ){ echo "selected='selected'"; } ?> value="slide-vertical-down"><?php esc_html_e('Slide Vertically - Down', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['animation_type']) && $term_meta['animation_type'] == 'slide-cover' ){ echo "selected='selected'"; } ?> value="slide-cover"><?php esc_html_e('Slide - Cover Previous Slide', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['animation_type']) && $term_meta['animation_type'] == 'slide-peek' ){ echo "selected='selected'"; } ?> value="slide-peek"><?php esc_html_e('Slide - Peek Into Next Slide', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['animation_type']) && $term_meta['animation_type'] == 'fade' ){ echo "selected='selected'"; } ?> value="fade"><?php esc_html_e('Fade', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Time between slide transitions in milliseconds', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <input type="text" name="term_meta[animation_timeout]" id="term_meta[animation_timeout]" value="<?php if( isset($term_meta['animation_timeout']) && $term_meta['animation_timeout'] != '' ){ echo esc_attr($term_meta['animation_timeout']); } ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Slider height in px', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <input type="text" name="term_meta[height]" id="term_meta[height]" value="<?php if( isset($term_meta['height']) && $term_meta['height'] != '' ){ echo esc_attr($term_meta['height']); } ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Responsive height', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[responsive_height]" id="term_meta[responsive_height]">
                <option <?php if( isset($term_meta['responsive_height']) && $term_meta['responsive_height'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['responsive_height']) && $term_meta['responsive_height'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Show Navigation Arrows', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[show_navigation_arrows]" id="term_meta[show_navigation_arrows]">
                <option <?php if( isset($term_meta['show_navigation_arrows']) && $term_meta['show_navigation_arrows'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['show_navigation_arrows']) && $term_meta['show_navigation_arrows'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Show Navigation Bullets', 'qodef-cpt'); ?></label>
        </th>
        <td>
            <select name="term_meta[show_navigation_circles]" id="term_meta[show_navigation_circles]">
                <option <?php if( isset($term_meta['show_navigation_circles']) && $term_meta['show_navigation_circles'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes"><?php esc_html_e('Yes', 'qodef-cpt'); ?></option>
                <option <?php if( isset($term_meta['show_navigation_circles']) && $term_meta['show_navigation_circles'] == 'no' ){ echo "selected='selected'"; } ?> value="no"><?php esc_html_e('No', 'qodef-cpt'); ?></option>
            </select>
        </td>
    </tr>

<?php
}

function qodef_save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

add_action( 'slides_category_edit_form_fields', 'qodef_slides_category_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_slides_category', 'qodef_save_taxonomy_custom_fields', 10, 2 );



add_filter("manage_edit-slides_category_columns", 'qodef_theme_columns');
function qodef_theme_columns($theme_columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => esc_html__('Name', 'qodef-cpt'),
        'shortcode' => esc_html__('Shortcode', 'qodef-cpt'),
        'slug' => esc_html__('Slug', 'qodef-cpt'),
        'posts' => esc_html__('Posts', 'qodef-cpt')
    );
    return $new_columns;
}

add_filter("manage_slides_category_custom_column", 'qodef_manage_theme_columns', 10, 3);
function qodef_manage_theme_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'slides_category');
    switch ($column_name) {
        case 'shortcode':
            $out .= "[qodef_slider slider='".$theme->slug."']";
            break;

        default:
            break;
    }
    return $out;
}

?>