# WooCommerce HubSpot Leads

A simple educational WordPress plugin that sends WooCommerce customers to HubSpot after a successful order.

> **Purpose**
>
> This project was built for learning purposes to understand how a real WooCommerce → HubSpot API integration works.
>
> It demonstrates the basic architecture that a WordPress/WooCommerce developer may implement in a custom agency project.

---

## Features

- Create a HubSpot contact after a WooCommerce order
- HubSpot API integration using WordPress HTTP API (`wp_remote_post`)
- Admin settings page for storing HubSpot Access Token
- Object-Oriented architecture
- Dependency Injection
- Basic logging
- Response handling (201, 400, 401, 403, 409)
- WordPress Coding Standards friendly structure

---

## Project Structure

```
wc-hubspot-leads/
│
├── includes/
│   ├── Plugin.php
│   ├── OrderListener.php
│   ├── HubSpotAPI.php
│   ├── SettingsPage.php
│   └── Logger.php
│
├── composer.json
├── wc-hubspot-leads.php
└── README.md
```

---

## How it works

```
WooCommerce Order
        │
        ▼
OrderListener
        │
        ▼
HubSpotAPI
        │
        ▼
HubSpot CRM
```

When a customer places an order:

1. WooCommerce fires an action.
2. `OrderListener` collects customer information.
3. `HubSpotAPI` sends the data to HubSpot.
4. The response is processed.
5. Results are written to the log.

---

## Requirements

- WordPress
- WooCommerce
- HubSpot Private App
- HubSpot Access Token

---

## Installation

1. Clone the repository into the `wp-content/plugins/` directory.
2. Activate the plugin.
3. Open:

```
Settings → HubSpot Leads
```

4. Paste your HubSpot Access Token.
5. Save settings.
6. Create a WooCommerce order.

---

## Educational Goals

This project was created to practice:

- WordPress Plugin Development
- WooCommerce Hooks
- Object-Oriented PHP
- Dependency Injection
- WordPress HTTP API
- Working with REST APIs
- JSON requests
- API authentication using Bearer Token
- Error handling
- Basic plugin architecture

---

## Notes

This plugin is intentionally simple.

It focuses on understanding the integration process rather than implementing every HubSpot feature.

Possible future improvements include:

- Update existing contacts
- Create Deals
- Associate Contacts with Deals
- Webhooks
- Retry queue
- Better error reporting
- Unit tests

---

## License

GPL-2.0