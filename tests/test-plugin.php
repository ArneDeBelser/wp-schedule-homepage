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

        // Check if the 'plugins_loaded' action is added, when checking a specific function, the priority of that hook is returned, that's why we check for 10.
        $this->assertEquals(10, has_action('plugins_loaded', [$plugin, 'initModules']));
    }
}
