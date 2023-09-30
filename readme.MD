# WP Schedule Homepage Plugin

Enhance your WordPress website with the power to schedule changes to your homepage. Easily switch your homepage to a predefined page at a specific time, providing a seamless user experience and allowing you to control content visibility precisely.

## Features

- Schedule your homepage to switch to a designated page at a specified time.
- Choose between immediate transition or use the WordPress Cron system for more controlled scheduling.
- Customize the content displayed on your homepage to captivate your audience effectively.

## Installation

1. Download the plugin ZIP file from the [GitHub repository](https://github.com/yourusername/wp-schedule-homepage).
2. In your WordPress admin, go to **Plugins > Add New**.
3. Click the **Upload Plugin** button and select the downloaded ZIP file.
4. Activate the plugin through the **Plugins** menu in WordPress.

## Usage

1. In your WordPress admin, go to **Settings > Reading**.
2. Scroll down to the "WP Schedule Homepage" section.
3. Choose the page you want to set as the future homepage using the dropdown field.
4. Specify the time at which the transition should occur using the time field.
5. Save your changes.


Certainly! Here's the testing section for your README.md with all the commands together for easy copying:

## Testing (Using Docker)

To facilitate testing of the WP Schedule Homepage Plugin, you can set up a Docker environment. Follow these steps:

1. Build the Docker image for the plugin:

   ```sh
   docker build -t wp-schedule-homepage .
   ```

2. Run a Docker container with the built image, exposing port 8080:

   ```sh
   docker run --rm -p 8080:80 wp-schedule-homepage
   ```

3. Once your Docker container is up and running, you can perform tests on the plugin.

4. After testing, you can remove the Docker image:

   ```sh
   docker image rmi wp-schedule-homepage
   ```

5. If you want to set up plugin tests, you can use WP-CLI and Docker Compose:

   - Scaffold the plugin tests using WP-CLI:

     ```sh
     docker-compose exec wp wp-cli scaffold plugin-tests wp-schedule-homepage
     ```

   - Run PHPUnit tests:

     ```sh
     docker-compose exec wp composer phpunit
     ```

These steps will help you test the WP Schedule Homepage Plugin in a Docker environment.

Usefull links with information:
[WordPress Plugin Development using TDD, Docker and WpUnitTestCase](https://marioyepes.com/wordpress-plugin-tdd-with-docker-phpunit/#pre-requisites)
[How to Run PHPUnit in a WordPress Plugin on Windows Using LocalWP - DEV Community](https://dev.to/eliehanna/how-to-run-phpunit-in-a-wordpress-plugin-on-windows-using-localwp-1414)

## License

This plugin is licensed under the [MIT License](LICENSE).

## Feedback and Contributions

Feel free to provide feedback or contribute to the development of this plugin by submitting issues or pull requests on the [GitHub repository](https://github.com/yourusername/wp-schedule-homepage).

## Author

- **Author:** De Belser Arne
- **Website:** [https://www.arnedebelser.be](https://www.arnedebelser.be)

---

**Disclaimer:** This plugin is provided as-is with no guarantee of functionality. Use it at your own risk.
