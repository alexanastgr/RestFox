<?php


trait ThemesHandler
{
    /**
     * Handler for /restfox/v1/themes
     */
    public function get_themes()
    {
        $show_themes = (int) get_option('restfox_show_themes', 0);

        if (! $show_themes) {
            return new WP_Error(
                'rest_forbidden',
                'This feature is disabled by RestFox API settings',
                ['status' => 403]
            );
        }


        $themes = wp_get_themes();
        $data   = [];

        foreach ($themes as $stylesheet => $theme) {
            $data[] = [
                'name'       => $theme->get('Name'),
                'version'    => $theme->get('Version'),
                'stylesheet' => $stylesheet,
                'template'   => $theme->get_template(),
                'author'     => $theme->get('Author'),
                'active'     => ($stylesheet === get_stylesheet()),
            ];
        }

        return [
            'themes' => $data,
        ];
    }
}
