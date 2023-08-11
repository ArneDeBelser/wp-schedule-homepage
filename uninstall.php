<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

unregister_setting('reading', 'wp_schedule_homepage_page_id');
delete_option('wp_schedule_homepage_page_id');

unregister_setting('reading', 'wp_schedule_homepage_time');
delete_option('wp_schedule_homepage_time');
