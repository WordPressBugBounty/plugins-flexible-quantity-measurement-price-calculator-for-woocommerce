<?php
/**
 * Plugin Name: Flexible Quantity - Measurement Price Calculator for WooCommerce
 * Plugin URI: https://wpdesk.link/flexible-quantity-measurement-price-calculator-for-woocommerce
 * Description: Measurement Price Calculator for WooCommerce. Add a new unit of measure for every product you want. Calculate the product price based on units.
 * Version: 2.3.6
 * Author: WP Desk
 * Author URI: https://www.wpdesk.net/
 * Text Domain: flexible-quantity-measurement-price-calculator-for-woocommerce
 * Domain Path: /lang/
 * Requires at least: 6.4
 * Tested up to: 6.8
 * WC requires at least: 9.6
 * WC tested up to: 9.9
 * Requires PHP: 7.4
 * Copyright 2020 WP Desk Ltd.
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @package WPDesk\FlexibleQuantityFree
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/* THIS VARIABLE CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '2.3.6';

$plugin_name        = 'Flexible Quantity - Measurement Price Calculator for WooCommerce';
$plugin_class_name  = 'WPDesk\FlexibleQuantityFree\Plugin';
$plugin_text_domain = 'flexible-quantity-measurement-price-calculator-for-woocommerce';
$product_id         = 'Flexible Quantity Free';
$plugin_file        = __FILE__;
$plugin_dir         = __DIR__;

define( 'FLEXIBLE_QUANTITY_FREE_VERSION', $plugin_version );
define( 'FLEXIBLE_QUANTITY_FREE_PLUGIN_DIR', $plugin_dir );
define( 'FLEXIBLE_QUANTITY_FREE_PLUGIN_FILE', $plugin_file );
define( $plugin_class_name, $plugin_version );

$requirements = [
	'php'     => '7.4',
	'wp'      => '5.0',
	'plugins' => [
		[
			'name'      => 'woocommerce/woocommerce.php',
			'nice_name' => 'WooCommerce',
			'version'   => '5.5',
		],
	],
];

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/plugin-init-php52-free.php';
