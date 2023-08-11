<?php

namespace ADB\WPScheduleHomepage;

use DateInterval;
use DateTime;

class Scheduler
{
    /**
     * Swap the homepage the the newly set future homepage. This function only continues running if there is a new future homepage set
     *
     * @return void
     */
    public function run()
    {
        // Return the function early if there is no homepage to switch to
        if ($this->is_current_homepage_the_same_as_future_homepage()) {
            return;
        }

        $pageId = get_option('wp_schedule_homepage_page_id');
        $time   = get_option('wp_schedule_homepage_time');

        $currenDateTime = new DateTime();
        $currenDateTime->add(new DateInterval("PT1H"));

        if ($currenDateTime > new DateTime($time)) {
            update_option('page_on_front', $pageId);
        }
    }

    /**
     * Check to see if the current home page is the same as the future homepage
     *
     * @return boolean
     */
    private function is_current_homepage_the_same_as_future_homepage()
    {
        return (get_option('page_on_front') == get_option('wp_schedule_homepage_page_id'));
    }
}
