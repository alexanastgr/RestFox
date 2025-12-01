<?php


trait PluginsHandler
{
    /**
     * Handler for /restfox/v1/plugins
     */

    public function get_plugins()
    {

        $show_plugins = (int) get_option('restfox_show_plugins', 0);

        if (! $show_plugins) {
            return new WP_Error(
                'rest_forbidden',
                'This feature is disabled by RestFox API settings',
                ['status' => 403]
            );
        }

        $plugins = get_plugins();
        $data   = [];

        foreach ($plugins as $plugin) {
            $data[] = [
                'name'       => $plugin['Name'],
                'version'    => $plugin['Version'],
                'author'     => $plugin['Author'],
            ];
        }

        return [
            'plugins' => $data,
        ];
    }
}
