<?php

namespace WPGO_Plugins\Plugin_Framework;

/*
 *    Plugin utility functions
 */

class New_Features_Templates_FW
{

    protected $module_roots;

    /* Main class constructor. */
    public function __construct($module_roots)
    {
        $this->module_roots = $module_roots;
    }

    public function new_features_loop($new_features_arr, $freemius_discount_upgrade_url, $is_premium, $plugin_data ) {

      ob_start(); // Start recording output.
      ?>

<ul class="wpgo-settings-grid-container">
      <?php

foreach ($new_features_arr as $key => $new_feature):
            if ($new_feature->type === 'pro') {
                $type_class = 'pro-only';
                $type_label = '<a href="' . $freemius_discount_upgrade_url . '">PRO</a>';
            } else {
                $type_class = 'free-only';
                $type_label = 'FREE';
            }

            // don't show 'PRO' label for the premium plugin as it's redundant
            $type_html = !$is_premium ? '<div class="' . $type_class . '">' . $type_label . '</div>' : '';

            // ribbon visibility
            $new_ribbon = (($plugin_data['Version'] === $new_feature->version) || ($new_feature->version === 'latest')) ? '<div class="ribbon-wrapper"><div class="ribbon">NEW</div></div>' : '';
            ?>
            <li>
              <div class="wpgo-settings-card">
                <?php echo $new_ribbon; ?>
                <div class="image-wrapper">
                  <?php echo $type_html; ?>
                  <img class="post-image" src="<?php echo $this->module_roots['uri'] . '/assets/images/new-features/' . $new_feature->banner_url; ?>">
                </div>
              <div class="details" style="font-weight: bold;">
                <div>Version: <?php echo $new_feature->version; ?></div>
                  <div><?php echo $new_feature->date; ?></div>
                </div>
                <div class="card-content">
                  <h2><?php echo $new_feature->title; ?></h2>
                  <p><?php echo $new_feature->description; ?></p>
                </div>
            <?php
    				$hide = ' hide-button';
            $learn_more_visibility = $new_feature->learn_more_url === '' ? $hide : '';
            $upgrade_visibility = ($new_feature->type === 'free' || $new_feature->type === 'free-only') || $is_premium ? $hide : '';
            
            // if both buttons not shown then don't show permalink section
            $permalink_html = ($learn_more_visibility !== '') && ($upgrade_visibility !== '') ? '' : '<div class="permalink"><a class="button left' . $learn_more_visibility . '" href="' . $new_feature->learn_more_url . '" target="_blank">Learn More</a><a class="button right' . $upgrade_visibility . '" href="' . $freemius_discount_upgrade_url . '">Upgrade</a></div>';
            echo $permalink_html;
            ?>
                </div>
              </li>
              <?php endforeach;?>
            </ul>

      <?php
      $new_features_content = ob_get_contents(); // Get output contents.
      ob_end_clean(); // End recording output and flush buffer.

      return $new_features_content;
    }

} /* End class definition */
