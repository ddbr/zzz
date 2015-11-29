<?php
/**
 * storefront engine room
 *
 * @package storefront
 */

/**
 * Initialize all the things.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */

function meterware( $product_id ) {
  $cat = get_the_terms( $product_id, 'product_tag' );
  foreach ($cat as $categoria) {
    if ($categoria->name == "Meterware") {
      return true;
    } else {
      return false;
    }
  }

  /*alternative
    if ($product->get_attribute( 'meterware' ) == 'ja') {
      $meter = true;
    }*/
};
