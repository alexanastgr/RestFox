<?php


trait SettingsHandler
{


    /**
     *  Callback for /restfox/v1/settings 
     *    [GET]
     */

    public function get_settings(WP_REST_Request $request): WP_REST_RESPONSE
    {
        $data = [
            'site_name'        => get_option('blogname'),
            'site_description' => get_option('blogdescription'),
        ];

        return new WP_REST_Response($data, 200);
    }


    /**
     *  Callback for /restfox/v1/settings 
     *    [POST]
     */
    public function update_settings(WP_REST_Request $request): WP_REST_Response
    {
        $site_name        = $request->get_param('site_name');
        $site_description = $request->get_param('site_description');

        $updated = [];

        if (! is_null($site_name)) {
            $clean_name = sanitize_text_field($site_name);
            update_option('blogname', $clean_name);
            $updated['site_name'] = $clean_name;
        }

        if (! is_null($site_description)) {
            $clean_desc = sanitize_text_field($site_description);
            update_option('blogdescription', $clean_desc);
            $updated['site_description'] = $clean_desc;
        }

        if (empty($updated)) {
            return new WP_REST_Response(
                ['message' => 'Data fields are empty for updates'],
                400
            );
        }

        return new WP_REST_Response(
            [
                'message' => 'New settings saved successfuly',
                'updated' => $updated,
            ],
            200
        );
    }
}
