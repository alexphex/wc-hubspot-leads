<?php
/**
 * Plugin Name: WooCommerce HubSpot Leads
 * Description: A plugin to integrate WooCommerce with HubSpot for lead generation.
 * Version: 1.0.0
 * Author: alex_dev
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-plugin.php';

WCHubSpot\Plugin::init();