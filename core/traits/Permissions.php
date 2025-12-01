<?php


trait Permissions
{
    public function permissions_check(WP_REST_Request $request): WP_Error | Bool
    {
        $auth_header = $request->get_header('authorization');

        if (empty($auth_header)) {
            return new WP_Error(
                'restman_no_auth_header',
                'Missing authorization header.',
                ['status' => 401]
            );
        }

        if (stripos($auth_header, 'Bearer ') !== 0) {
            return new WP_Error(
                'restman_bad_auth_header',
                'Wrong authorization header (use Bearer token instead).',
                ['status' => 401]
            );
        }

        $token = trim(substr($auth_header, 7));

        if (empty($token)) {
            return new WP_Error(
                'restman_admin_empty_token',
                'restman token is empty',
                ['status' => 401]
            );
        }

        $user_id = get_transient($this->token_prefix . $token);

        if (! $user_id) {
            return new WP_Error(
                'restman_admin_invalid_token',
                'restman token is invalid or expired',
                ['status' => 401]
            );
        }

        $user = get_user_by('id', $user_id);

        if (! $user) {
            return new WP_Error(
                'restman_user_not_found',
                'Request user not exist',
                ['status' => 401]
            );
        }

        if (! user_can($user, 'manage_options')) {
            return new WP_Error(
                'restman_admin_user_not_allowed',
                'This user dont have administrator access',
                ['status' => 403]
            );
        }

        wp_set_current_user($user_id);

        return true;
    }
}
