<?php

namespace ADB\WPScheduleHomepage;

class Settings
{
    public function __construct()
    {
        $actions = [
            'set_up_settings_section',
            'set_up_page_list_dropdown_field',
            'set_up_time_field',
        ];

        foreach ($actions as $action) {
            add_action('admin_init', [$this, $action]);
        }
    }

    /**
     * Setup the settings section
     *
     * @return void
     */
    public function set_up_settings_section()
    {
        add_settings_section(
            'wp_schedule_homepage',
            __('WP Schedule Homepage', 'wp-schedule-homepage'),
            [$this, 'set_up_wp_schedule_home_settings_section'],
            'reading'
        );
    }

    /**
     * Show a helpfull tooltip which explains the user what to do
     *
     * @param mixed $arg
     * @return void
     */
    public function set_up_wp_schedule_home_settings_section($arg)
    {
        echo '<p>' . __('Specify the page to which the current homepage will be transitioned at your designated time.', 'wp-schedule-homepage') . '</p>';
    }

    /**
     * Register the page id settings
     * Add the page id setting dropdown field
     *
     * @return void
     */
    public function set_up_page_list_dropdown_field()
    {
        register_setting(
            'reading',
            'wp_schedule_homepage_page_id',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => NULL,
            ]
        );

        add_settings_field(
            'wp_schedule_homepage_page_dropdown',
            __('Switch current homepage to', 'wp-schedule-homepage'),
            [$this, 'construct_page_dropdown_field'],
            'reading',
            'wp_schedule_homepage',
            ['label_for' => 'wp_schedule_homepage_page_dropdown']
        );
    }

    /**
     * Render the HTML for the page id setting field
     *
     * @param mixed $args
     * @return void
     */
    public function construct_page_dropdown_field($args)
    {
        $pageId = get_option('wp_schedule_homepage_page_id');

        $items = get_posts([
            'posts_per_page'   => -1,
            'orderby'          => 'name',
            'order'            => 'ASC',
            'post_type'        => 'page',
        ]);

        echo '<select name="wp_schedule_homepage_page_id">';
        echo '<option value="0">' . __('— Select —', 'wordpress') . '</option>';
        foreach ($items as $item) {
            $selected = ($pageId == $item->ID) ? 'selected="selected"' : '';
            echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
        }
        echo '</select>';
    }

    /**
     * Register the time settings
     * Add the time setting field
     *
     * @return void
     */
    public function set_up_time_field()
    {
        register_setting(
            'reading',
            'wp_schedule_homepage_time',
            [
                'type' => 'string',
                'sanitize_callback' => [Validator::class, 'check_time_field'],
                'default' => NULL,
            ]
        );

        add_settings_field(
            'wp_schedule_homepage_time_field',
            __('Time', 'wp-schedule-homepage'),
            [$this, 'construct_time_field'],
            'reading',
            'wp_schedule_homepage',
            ['label_for' => 'wp_schedule_homepage_time_field']
        );
    }

    /**
     * Render the HTML for the time setting field
     *
     * @param mixed $args
     * @return void
     */
    function construct_time_field($args)
    {
        echo '<input type="datetime-local" name="wp_schedule_homepage_time" step="1" value="' . get_option('wp_schedule_homepage_time') . '">';
    }
}
