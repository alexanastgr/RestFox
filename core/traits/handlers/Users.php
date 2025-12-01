<?php

trait UsersHandler
{

    /**
     *   Handler for /restfox/v1/users
     */
    public function get_users()
    {
        $show_users = (int) get_option('restfox_show_users', 0);

        if (! $show_users) {
            return new WP_Error(
                'rest_forbidden',
                'This feature is disabled by RestFox API settings',
                ['status' => 403]
            );
        }

        $users = get_users();
        $data   = [];

        foreach ($users as $user) {
            $data[] = [
                'username'   => $user->user_login,
                'email'      => $user->user_email,
                'registered' => $user->user_registered,
                'roles'      => $user->roles,
            ];
        }

        return [
            'users' => $data,
        ];
    }
}
