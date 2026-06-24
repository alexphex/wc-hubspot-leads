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
        if (isset($_POST['wc_hubspot_token'])) {

            if (!current_user_can('manage_options')) {
                return;
            }

            if (
                !isset($_POST['wc_hubspot_nonce']) ||
                !wp_verify_nonce(
                    sanitize_text_field(wp_unslash($_POST['wc_hubspot_nonce'])),
                    'wc_hubspot_save_settings'
                )
            ) {
                return;
            }

            $token = sanitize_text_field(
                wp_unslash($_POST['wc_hubspot_token'])
            );

            update_option(
                'wc_hubspot_token',
                $token
            );

            echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';
        }

        $savedToken = get_option(
            'wc_hubspot_token',
            ''
        );
        ?>

        <div class="wrap">
            <h1>HubSpot Settings</h1>

            <form method="post">

                <?php
                wp_nonce_field(
                    'wc_hubspot_save_settings',
                    'wc_hubspot_nonce'
                );
                ?>

                <table class="form-table">

                    <tr>
                        <th scope="row">
                            <label for="wc_hubspot_token">
                                HubSpot Token
                            </label>
                        </th>

                        <td>
                            <input
                                type="text"
                                id="wc_hubspot_token"
                                name="wc_hubspot_token"
                                value="<?php echo esc_attr($savedToken); ?>"
                                class="regular-text"
                            />
                        </td>
                    </tr>

                </table>

                <?php submit_button('Save Settings'); ?>

            </form>

        </div>

        <?php
    }
}