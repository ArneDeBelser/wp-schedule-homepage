<?php

namespace ADB\WPScheduleHomepage\Tests;

use ADB\WPScheduleHomepage\Scheduler;
use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;

class SchedulerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        \WP_Mock::setUp();
    }

    public function tearDown(): void
    {
        \WP_Mock::tearDown();
        parent::tearDown();
    }

    public function testRunWithSameHomepage()
    {
        // Mock the get_option function to return the same page ID for both options
        \WP_Mock::userFunction('get_option', ['return' => 'page_id']);

        // Mock the update_option function and ensure it's not called
        \WP_Mock::userFunction('update_option', ['times' => 0]);

        $scheduler = new Scheduler();
        $scheduler->run(); // Call the run method

        // Assert that update_option was not called
        $this->assertTrue(true); // You can add a meaningful assertion here
    }
}
