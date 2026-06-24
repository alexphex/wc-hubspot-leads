<?php
/**
 * Plugin Name: WooCommerce HubSpot Leads
 * Description: Send WooCommerce customers to HubSpot.
 * Version: 1.0.0
 * Author: alex_dev
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

(new WCHubSpot\Plugin())->run();