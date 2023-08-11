<?php

namespace ADB\WPScheduleHomepage;

use DateTime;

class Validator
{
    /**
     * First sanitize the text field the WordPress way, afterwards make sure the user enters a time which lies in the future
     *
     * @param string $value
     * @return void
     */
    public static function check_time_field($value)
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
                'wp_schedule_homepage_time',
                'wp_schedule_homepage_time_id',
                __(
                    'An error has occurred. The given time must be in the future',
                    'wp-schedule-homepage'
                )
            );

            return;
        }

        return $sanitizedTimeValue;
    }
}
