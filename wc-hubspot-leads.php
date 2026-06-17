<?php
/**
 * Plugin Name: WooCommerce HubSpot Leads
 * Description: A plugin to integrate WooCommerce with HubSpot for lead generation.
 * Version: 1.0.0
 * Author: alex_dev
 * License: GPL2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}  

// Include the main plugin class
require_once __DIR__ . '/vendor/autoload.php';

use WCHubSpot\Services\Logger;

$logger = new Logger();

$plugin = new WCHubSpot\Plugin($logger);

$plugin->init();