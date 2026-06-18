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

use WCHubSpot\Plugin;
use WCHubSpot\Services\Logger;
use WCHubSpot\Services\HubSpotClient;

$logger = new Logger();

$hubSpotClient = new HubSpotClient($logger);

$plugin = new Plugin(
    $logger,
    $hubSpotClient
);

$plugin->init();