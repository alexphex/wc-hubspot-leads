<?php

namespace WCHubSpot;

class SettingsPage
{
    public function __construct()
    {
        add_action(
            'admin_menu',
            [$this, 'addMenuPage']
        );
    }

    public function addMenuPage(): void
    {
        add_options_page(
            'HubSpot Settings',
            'HubSpot Leads',
            'manage_options',
            'wc-hubspot-leads',
            [$this, 'renderPage']
        );
    }

    public function renderPage(): void
    {
        echo '<div class="wrap">';
        echo '<h1>HubSpot Settings</h1>';
        echo '</div>';
    }
}