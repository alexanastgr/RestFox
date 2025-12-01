<?php

require_once __DIR__ . '/handlers/Themes.php';
require_once __DIR__ . '/handlers/Plugins.php';
require_once __DIR__ . '/handlers/Settings.php';
require_once __DIR__ . '/handlers/Users.php';



trait Handlers
{

    use ThemesHandler;
    use PluginsHandler;
    use UsersHandler;
    use SettingsHandler;
}
