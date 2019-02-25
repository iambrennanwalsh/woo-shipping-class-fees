<?php

/**
 * WooCommerce Shipping Class Fees
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Shipping Class Fees
 * Plugin URI:        https://github.com/iambrennanwalsh/woo-shipping-class-fees
 * Description:       Attach simple fees to your WooCommerce shipping classes. 
 * Version:           1.0.0
 * Author:            Brennan Walsh
 * Author URI:        https://www.brennanwal.sh
 */

class WCFSShipping {

	public function add_fee_to_shipping_class_columns( $columns ) {
  	$fee = array(
    	'extension-parcel-fee' => __( 'Fee', 'woocommerce-extension' ), );
    $columns = array_merge( $columns, $fee );
    return $columns; }
    
  public function add_fee_to_shipping_class_rows() { ?>
    <div class="view">{{ data.fee }}</div>
    <div class="edit">
			<input type="text" name="fee[{{ data.term_id }}]" data-attribute="fee"  alue="{{ data.fee }}" placeholder="<?php esc_attr_e( '0', 'woocommerce' ); ?>"/>
    </div> <?php }
    
  public function save_fee( $term_id, $data ) {
  	if ( isset( $data[ 'fee' ] ) ) {
    	$parcel_fee = wc_clean( $data[ 'fee' ] ); }
    	update_option( 'shipping_class_' . $term_id . '_extension_fee', $parcel_fee ); }
    
 	public function extend_terms_with_fee( $shipping_classes ) {
  	foreach ( $shipping_classes as $key => $shipping_class ) {
      $term_id = $shipping_class->term_id;
      $shipping_classes[ $key ]->fee = get_option( 'shipping_class_' . $term_id . '_extension_fee' ); }
    return $shipping_classes; }
	
	public function add_fees_to_the_cart() {
		$shipping_classes = WC()->shipping->get_shipping_classes();
  	foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
    	$shipping_class = get_the_terms( $values['product_id'], 'product_shipping_class' );
      foreach($shipping_classes as $key => $val) {
        if ( isset( $shipping_class[0]->slug ) && in_array( $shipping_class[0]->slug, [$val->slug] ) ) {
        	WC()->cart->add_fee( __($val->description, 'woocommerce'), $val->fee ); } } } }
}