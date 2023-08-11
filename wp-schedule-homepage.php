<?php

use ADB\WPScheduleHomepage\Plugin;

/**
 * Plugin Name:       WP Schedule Homepage
 * Plugin URI:        https://www.arnedebelser.be
 * Description:       This innovative plugin empowers you with the ability to effortlessly schedule a page to become your website's homepage at any desired moment. Seamlessly enhance your website's user experience by controlling when specific content takes center stage. With our plugin, the process of dynamically curating your homepage content becomes a breeze, enabling you to captivate your audience precisely when it matters most. Elevate your website's engagement and impact by orchestrating your content with precision and finesse.
 * Version:           1.0.0
 * Author:            De Belser Arne
 * Author URI:        https://www.arnedebelser.be
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-schedule-homepage
 * Domain Path:       /languages
 */

require __DIR__ . '/vendor/autoload.php';

new Plugin();
