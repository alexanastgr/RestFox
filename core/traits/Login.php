<?php


trait Login
{

    public function login(WP_REST_Request $request): WP_Error | WP_REST_Response
    {
        $username = $request->get_param('username');
        $password = $request->get_param('password');

        if (empty($username) || empty($password)) {
            return new WP_Error(
                'remote_admin_missing_credentials',
                'Username and Password fields is required for authentication',
                ['status' => 400]
            );
        }

        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            return new WP_Error(
                'remote_admin_invalid_credentials',
                'Wrong username or password',
                ['status' => 401]
            );
        }

        //role checker
        if (! user_can($user, 'manage_options')) {
            return new WP_Error(
                'remote_admin_not_allowed',
                'You have not administrator rights',
                ['status' => 403]
            );
        }

        // generates token
        $token = wp_generate_password(64, false, false);

        $expiration = 2 * HOUR_IN_SECONDS;
        set_transient($this->token_prefix . $token, $user->ID, $expiration);

        return new WP_REST_Response(
            [
                'token'      => $token,
                'expires_in' => $expiration,
                'user'       => [
                    'id'       => $user->ID,
                    'username' => $user->user_login,
                    'email'    => $user->user_email,
                ],
            ],
            200
        );
    }
}
