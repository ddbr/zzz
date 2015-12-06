<?php

if ( ! function_exists( 'woocommerce_quantity_input' ) ) {

    /**
     * Output the quantity input for add to cart forms.
     *
     * @param  array $args Args for the input
     * @param  WC_Product|null $product
     * @param  boolean $echo Whether to return or echo|string
     */
    function woocommerce_quantity_input( $args = array(), $product = null, $echo = true ) {
        if ( is_null( $product ) )
            $product = $GLOBALS['product'];

        $defaults = array(
            'input_name'    => 'quantity',
            'input_value'   => '0.1',
            'max_value'     => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
            'min_value'     => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
            'step'          => apply_filters( 'woocommerce_quantity_input_step', '0.1', $product )
        );

        $args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );

        ob_start();

        wc_get_template( 'global/quantity-input.php', $args );

        if ( $echo ) {
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}

add_filter( 'woocommerce_get_price_html', 'my_price_html', 100, 2 );
function my_price_html( $price, $product ){
    return 'xxx';
    //return 'Was:' . str_replace( '<ins>', ' Now:<ins>', $price );
}
