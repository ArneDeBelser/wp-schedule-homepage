<?php

namespace Adb\HomepagePlanner;

use Adb\HomepagePlanner\Swapper;
use DateTime;

class Initializer
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'setUpSettingsSection']);
        add_action('admin_init', [$this, 'setUpPageListDropdownField']);
        add_action('admin_init', [$this, 'setUpTimeField']);

        $swapper = new Swapper();
        add_action('init', [$swapper, 'run']);
    }

    /**
     * Setup the settings section
     *
     * @return void
     */
    public function setUpSettingsSection()
    {
        add_settings_section(
            'adb_homepage_planner',
            __('ADB Homepage Planner', 'adb-homepage-planner'),
            [$this, 'setUpAdbHomepagePlannerSettingsSection'],
            'reading'
        );
    }

    /**
     * Show a helpfull tooltip which explains the user what to do
     *
     * @param mixed $arg
     * @return void
     */
    public function setUpAdbHomepagePlannerSettingsSection($arg)
    {
        echo '<p>' . __('Set below the page to which the current homepage will be switched at the time you specify.', 'adb-homepage-planner') . '</p>';
    }

    /**
     * Register the page id settings
     * Add the page id setting dropdown field
     *
     * @return void
     */
    public function setUpPageListDropdownField()
    {
        register_setting(
            'reading',
            'adb_homepage_planner_page_id',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => NULL,
            ]
        );

        add_settings_field(
            'adb_homepage_planner_page_dropdown',
            __('Switch current homepage to', 'adb-homepage-planner'),
            [$this, 'constructPageDropdownField'],
            'reading',
            'adb_homepage_planner',
            ['label_for' => 'adb_homepage_planner_page_dropdown']
        );
    }

    /**
     * Render the HTML for the page id setting field
     *
     * @param mixed $args
     * @return void
     */
    public function constructPageDropdownField($args)
    {
        $pageId = get_option('adb_homepage_planner_page_id');

        $items = get_posts([
            'posts_per_page'   => -1,
            'orderby'          => 'name',
            'order'            => 'ASC',
            'post_type'        => 'page',
        ]);

        echo '<select name="adb_homepage_planner_page_id">';
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
    public function setUpTimeField()
    {
        register_setting(
            'reading',
            'adb_homepage_planner_time',
            [
                'type' => 'string',
                'sanitize_callback' => [$this, 'checkTimeField'],
                'default' => NULL,
            ]
        );

        add_settings_field(
            'adb_homepage_planner_time_field',
            __('Time', 'adb-homepage-planner'),
            [$this, 'constructTimeField'],
            'reading',
            'adb_homepage_planner',
            ['label_for' => 'adb_homepage_planner_time_field']
        );
    }

    /**
     * First sanitize the text field the WordPress way, afterwards make sure the user enters a time which lies in the future
     *
     * @param string $value
     * @return void
     */
    public function checkTimeField($value)
    {
        if ($value == null || empty($value)) {
            return;
        }

        $sanitizedTimeValue = sanitize_text_field($value);

        $opening_date = new DateTime($sanitizedTimeValue);
        $current_date = new DateTime();

        // Make sure the given time is in the future
        if ($opening_date < $current_date) {
            add_settings_error(
                'adb_homepage_planner_time',
                'adb_homepage_planner_time_id',
                __(
                    'An error has occurred. The given time must be in the future',
                    'adb-homepage-planner'
                )
            );

            return;
        }

        return $sanitizedTimeValue;
    }

    /**
     * Render the HTML for the time setting field
     *
     * @param mixed $args
     * @return void
     */
    function constructTimeField($args)
    {
        $currentlySpecifiedTime = get_option('adb_homepage_planner_time');

        echo '<input type="datetime-local" name="adb_homepage_planner_time" step="1" value="' . $currentlySpecifiedTime . '">';
    }
}
