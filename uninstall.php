<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

unregister_setting('reading', 'adb_homepage_planner_page_id');
delete_option('adb_homepage_planner_page_id');

unregister_setting('reading', 'adb_homepage_planner_time');
delete_option('adb_homepage_planner_time');
