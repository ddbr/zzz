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

add_filter( 'woocommerce_get_price_html', 'my_price_html', 100, 2 );
function my_price_html( $price, $product ){

  if ( meterware( $product->ID ) ) {
    $display_price         = $product->get_display_price( $product->get_price() * 10 );
    $display_regular_price = $product->get_display_price( $product->get_regular_price() * 10 );
    $display_sale_price    = $product->get_display_price( $product->get_sale_price() * 10 );
    if ( $product->get_price() !== '' ) {
      if ( $product->is_on_sale() ) {
        $price = apply_filters( 'woocommerce_variation_sale_price_html', '<del>' . wc_price( $display_regular_price ) . '</del> <ins>' . wc_price( $display_sale_price ) . '</ins>' . $product->get_price_suffix(), $product );
      } elseif ( $product->get_price() > 0 ) {
        $price = apply_filters( 'woocommerce_variation_price_html', wc_price( $display_price ) . $product->get_price_suffix(), $product );
      } else {
        $price = apply_filters( 'woocommerce_variation_free_price_html', __( 'Gratis!', 'woocommerce' ), $product );
      }
    } else {
      $price = apply_filters( 'woocommerce_variation_empty_price_html', '', $product );
    }
    $price = $price . ' pro Meter';
  }

  return $price;
}


add_filter( 'woocommerce_cart_item_price', 'my_cart_item_price', 10, 3 );
function my_cart_item_price( $product_price, $cart_item, $cart_item_key )
{
    //return $product_price;
    $_pf = new WC_Product_Factory();
    $_product = $cart_item['data']->post;
    $product = $_pf->get_product( $_product->ID );
    if ( meterware( $_product->ID ) ) {
      return wc_price($product->get_price() * 10) ;
    } else {
      return $product_price;
    }
};
