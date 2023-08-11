<?php

namespace ADB\WPScheduleHomepage;

use ADB\WPScheduleHomepage\Scheduler;

class Plugin
{
    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'initModules']);
    }

    public function initModules()
    {;
        new Settings();

        add_action('init', function () {
            if (!is_admin()) {
                (new Scheduler)->run();
            }
        });
    }
}
