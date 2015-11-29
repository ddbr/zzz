
<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
?>
<div class="quantity">

<?php
	// Check if Meterware
  $id = $product->id;
  $cat = get_the_terms( $product->ID, 'product_tag' );
  foreach ($cat as $categoria) {
    if ($categoria->name == "Meterware") {
      $meter = true;
    }
  }
	/*alternative
	foreach ($cat as $categoria) {
    if ($product->get_attribute( 'meterware' ) == 'ja') {
      $meter = true;
    }
  }	*/
?>

<?php /*Standard number Input added ID field to make Javascript working with the correct Input field in loop*/ ?>
  <input type="number" id="sys<?php echo $id ;?>" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" />

<?php /*Input Meterware Input Field. Add Event to make standard Input dependent on Click Meter = 1/10 of Stück Hide Standard Input */ ?>
<?php if ( $meter == true ) : ?>

  <input type="number" id="disp<?php echo $id ;?>" step="<?php echo esc_attr( $step / 10 ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value / 10 ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value / 10 ); ?>"<?php endif; ?> name="meter" value="<?php echo esc_attr( $input_value / 10); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" /> Meter

  <script>
      //document.getElementById("sys").style.visibility = "hidden";
      document.getElementById("sys<?php echo $id ;?>").style.display = "none";
      document.getElementById("disp<?php echo $id ;?>").addEventListener("click", function(){
          document.getElementById("sys<?php echo $id ;?>").value = this.value * 10;
      });
  </script>

<?php endif; ?>

</div>
