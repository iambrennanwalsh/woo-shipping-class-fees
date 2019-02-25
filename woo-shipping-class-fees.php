<?php

/**
 * WooCommerce Shipping Class Fees
 * 
 * Shipping classes are used to group products with similar 
 * shipping needs. Products assigned to a shipping class inherit 
 * its settings and default shipping cost. This functionality comes
 * with WooCommerce by default. This plugin allows you to attach a 
 * seperate and unrelated fee to your shipping classes. It adds an 
 * additonal "Fee" field to the shipping class table (found under 
 * WooComerce Settings -> Shipping -> Shipping Classes). This Fee 
 * is displayed along side the shipping class description on the cart and
 * checkout pages.
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Shipping Class Fees
 * Plugin URI:        https://github.com/iambrennanwalsh/woo-shipping-class-fees
 * Description:       Attach simple fees to your WooCommerce shipping classes. 
 * Version:           1.0.0
 * Author:            Brennan Walsh
 * Author URI:        https://www.brennanwal.sh
 */

if ( ! defined( 'WPINC' ) ) {
	die; }

require plugin_dir_path( __FILE__ ) . 'src/class-init.php';

function init() {
	$plugin = new WCFSInit();
	$plugin->run(); }

init();