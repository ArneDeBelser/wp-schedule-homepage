<?php

namespace Adb\HomepagePlanner;

use DateInterval;
use DateTime;

class Swapper
{
    /**
     * Swap the homepage the the newly set future homepage. This function only continues running if there is a new future homepage set
     *
     * @return void
     */
    public function run()
    {
        // Return the function early if there is no homepage to switch to
        if ($this->isCurrentHomepageTheSameAsFutureHomepage()) {
            return;
        }

        $pageId = get_option('adb_homepage_planner_page_id');
        $time   = get_option('adb_homepage_planner_time');

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
    private function isCurrentHomepageTheSameAsFutureHomepage()
    {
        return (get_option('page_on_front') == get_option('adb_homepage_planner_page_id'));
    }
}
