<?php


if (! defined('ABSPATH')) {
    exit;
}

/**
 *  Traits for RestFox API
 */

require_once __DIR__ . '/traits/Routes.php';
require_once __DIR__ . '/traits/Login.php';
require_once __DIR__ . '/traits/Settings.php';
require_once __DIR__ . '/traits/Handlers.php';
require_once __DIR__ . '/traits/Permissions.php';


class API
{

    use Routes;
    use Login;
    use Settings;
    use Handlers;
    use Permissions;


    private $token_prefix = 'restfox_admin_token_';


    public function __construct()
    {
        // admin menu
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_restfox_settings']);

        // register routes
        add_action('rest_api_init', [$this, 'register_routes']);
    }
}


new API();
