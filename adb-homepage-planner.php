<?php

use Adb\HomepagePlanner\Initializer;

/**
 * Plugin Name:       Homepage Planner
 * Plugin URI:        https://www.arnedebelser.be
 * Description:       This plugin makes it possible to schedule a page as a home page at a given time.
 * Version:           1.0.0
 * Author:            De Belser Arne
 * Author URI:        https://www.arnedebelser.be
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       adb-homepage-planner
 * Domain Path:       /languages
 */

require __DIR__ . '/vendor/autoload.php';

new Initializer();
