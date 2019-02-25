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

class WCFSInit {

	private $loader;
	private $shipping;

	public function __construct() {
		require plugin_dir_path( dirname( __FILE__ ) ) . 'src/class-loader.php';
		require plugin_dir_path( dirname( __FILE__ ) ) . 'src/class-shipping.php';
		$this->loader = new WCFSLoader(); 
		$this->shipping = new WCFSShipping();
		$this->define_hooks(); }

	private function define_hooks() {
		$this->loader->add_filter( 'woocommerce_shipping_classes_columns', $this->shipping, 'add_fee_to_shipping_class_columns' );
		$this->loader->add_action( 'woocommerce_shipping_classes_column_extension-parcel-fee', $this->shipping, 'add_fee_to_shipping_class_rows' );
		$this->loader->add_action( 'woocommerce_shipping_classes_save_class', $this->shipping, 'save_fee', 10, 2);
		$this->loader->add_filter( 'woocommerce_get_shipping_classes', $this->shipping, 'extend_terms_with_fee');
		$this->loader->add_action( 'woocommerce_cart_calculate_fees', $this->shipping, 'add_fees_to_the_cart' ); }

	public function run() { 
		$this->loader->run(); }
}