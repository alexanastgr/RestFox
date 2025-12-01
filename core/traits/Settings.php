<?php


trait Settings
{

    /**
     * Register options to WordPress.
     */
    public function register_restfox_settings()
    {
        register_setting(
            'restfox_settings_group',
            'restfox_show_themes',
            [
                'type'    => 'boolean',
                'default' => 0,
                'sanitize_callback' => fn($v) => (int) (bool) $v,
            ]
        );

        register_setting(
            'restfox_settings_group',
            'restfox_show_plugins',
            [
                'type'    => 'boolean',
                'default' => 0,
                'sanitize_callback' => fn($v) => (int) (bool) $v,
            ]
        );


        register_setting(
            'restfox_settings_group',
            'restfox_show_users',
            [
                'type'    => 'boolean',
                'default' => 0,
                'sanitize_callback' => fn($v) => (int) (bool) $v,
            ]
        );


        register_setting(
            'restfox_settings_group',
            'restfox_change_config',
            [
                'type'    => 'boolean',
                'default' => 0,
                'sanitize_callback' => fn($v) => (int) (bool) $v,
            ]
        );
    }

    /**
     * Admin menu page.
     */
    public function add_settings_page()
    {
        add_menu_page(
            'RestFox Settings',
            'Rest Fox',
            'manage_options',
            'restfox-settings',
            [$this, 'render_settings_page'],
            plugin_dir_url(__FILE__) . '../../assets/icons/menuicon.svg',
            30
        );
    }

    /**
     *  Fields of settings page
     */
    public function render_settings_page()
    {
        $show_themes   = get_option('restfox_show_themes', 0);
        $show_plugins  = get_option('restfox_show_plugins', 0);
        $show_users  = get_option('restfox_show_users', 0);
        $show_versions  = get_option('restfox_show_versions', 0);
        $change_config  = get_option('restfox_change_config', 0);
?>
        <div class="restfox-wrap">

            <div class="logoarea">
                <div class="logo"></div>
            </div>

            <div class="restfox-card">
                <div class="restfox-card__header">
                    RestFox API Settings
                </div>

                <form method="post" action="options.php">
                    <?php settings_fields('restfox_settings_group'); ?>


                    <div class="restfox-options">


                        <!-- installed themes option -->
                        <div class="restfox-option">
                            <div class="option-details">
                                <div class="iconarea">
                                    <div class="icon ic-themes"></div>
                                </div>

                                <div class="restfox-option-text">
                                    <strong>View Themes</strong><br>
                                    <span>See all installed themes</span>
                                </div>
                            </div>

                            <label class="toggle">
                                <input type="hidden"
                                    name="restfox_show_themes"
                                    value="0">

                                <input type="checkbox"
                                    name="restfox_show_themes"
                                    value="1"
                                    <?php checked(1, $show_themes); ?>>

                                <span class="toggle track"></span>
                            </label>
                        </div>


                        <!-- installed plugins option -->
                        <div class="restfox-option">
                            <div class="option-details">
                                <div class="iconarea">
                                    <div class="icon ic-plugins"></div>
                                </div>

                                <div class="restfox-option-text">
                                    <strong>View Plugins</strong><br>
                                    <span>See all installed plugins</span>
                                </div>
                            </div>

                            <label class="toggle">
                                <input type="hidden"
                                    name="restfox_show_plugins"
                                    value="0">

                                <input type="checkbox"
                                    name="restfox_show_plugins"
                                    value="1"
                                    <?php checked(1, $show_plugins); ?>>

                                <span class="toggle track"></span>
                            </label>
                        </div>


                        <!--  allow to change website info -->
                        <div class="restfox-option">
                            <div class="option-details">
                                <div class="iconarea">
                                    <div class="icon ic-users"></div>
                                </div>

                                <div class="restfox-option-text">
                                    <strong>View Users</strong><br>
                                    <span>See all registered users</span>
                                </div>
                            </div>

                            <label class="toggle">
                                <input type="hidden"
                                    name="restfox_show_users"
                                    value="0">

                                <input type="checkbox"
                                    name="restfox_show_users"
                                    value="1"
                                    <?php checked(1, $show_users); ?>>

                                <span class="toggle track"></span>
                            </label>
                        </div>


                        <!--  allow to change wordpress config -->
                        <div class="restfox-option">

                            <div class="option-details">
                                <div class="iconarea">
                                    <div class="icon ic-config"></div>
                                </div>

                                <div class="restfox-option-text">
                                    <strong>Update WP Settings</strong><br>
                                    <span>Update your website configuaration</span>
                                </div>
                            </div>

                            <label class="toggle">
                                <input type="hidden"
                                    name="restfox_change_config"
                                    value="0">

                                <input type="checkbox"
                                    name="restfox_change_config"
                                    value="1"
                                    <?php checked(1, $change_config); ?>>

                                <span class="toggle track"></span>
                            </label>
                        </div>

                    </div>

                    <?php submit_button('Update RestFox Settings'); ?>
                </form>


                <!-- footer area -->
                <div class="footer">
                    <div class="copy">
                        <p>&copy; 2025 <a href="https://alexanast.gr">Alexander Anastasiadis</a></p>
                    </div>

                    <div class="links">
                        <a target="_blank" href="https://github.com/alexanastgr/RestFox">Repo</a>
                        <a target="_blank" href="https://docs.alexanast.gr/restfox">Docs</a>
                        <a target="_blank" href="https://github.com/alexanastgr/RestFox/issues">Issues</a>
                    </div>
                </div>
                <!-- end footer area -->
            </div>

        </div>
<?php
    }
}
