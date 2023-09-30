<?php

use ADB\WPScheduleHomepage\Plugin;
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    public function test_plugin_initialization()
    {
        $plugin = new Plugin();

        // Check if the Plugin class is instantiated successfully
        $this->assertInstanceOf(Plugin::class, $plugin);

        // Check if the 'plugins_loaded' action is added
        $this->assertTrue(has_action('plugins_loaded', [$plugin, 'initModules']));
    }

    public function test_init_modules()
    {
        $plugin = new Plugin();
        $plugin->initModules();

        // Check if the 'init' action is added
        $this->assertTrue(has_action('init', function () {
            return !is_admin();
        }));

        // You can add more specific tests related to the 'initModules' method here
    }
}
