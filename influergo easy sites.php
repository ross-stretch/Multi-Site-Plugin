<?php
/**
 * Plugin Name: Influergo Easy Sites Lite
 * Description: Plugin to allow users to create new sites in a WordPress Multisite network.
 */

// Register the shortcode for displaying the site creation form
if (!function_exists('my_create_site_form_shortcode')) {
    function my_create_site_form_shortcode() {
        ob_start();
        ?>
        <form method="post">
            <label for="domain">Domain:</label>
            <span class="example">Example: your-site</span>
            <input type="text" name="domain" id="domain" required>
            <br>
            <label for="path">Path:</label>
            <span class="example">Example: /path</span>
            <input type="text" name="path" id="path" required>
            <br>
            <label for="title">Site Title:</label>
            <span class="example">Example: My Awesome Site</span>
            <input type="text" name="title" id="title" required>
            <br>
            <label for="admin_email">Admin Email:</label>
            <span class="example">Example: admin@example.com</span>
            <input type="email" name="admin_email" id="admin_email" required>
            <br>
            <input type="submit" name="create_site" value="Create Site">
        </form>
        <?php
        return ob_get_clean();
    }
}

// Handle the form submission
if (!function_exists('my_create_site_handler')) {
    function my_create_site_handler() {
        if (isset($_POST['create_site'])) {
            // Show the "Site is being created" alert
            echo '<script>alert("Your site is being created");</script>';

            // Retrieve form data
            $domain = sanitize_text_field($_POST['domain']);
            $path = sanitize_text_field($_POST['path']);
            $title = sanitize_text_field($_POST['title']);
            $admin_email = sanitize_email($_POST['admin_email']);

            // Create site logic here
            // ...

            // Redirect to the new site
            $new_site_url = 'https://' . $domain . '.' . $_SERVER['HTTP_HOST'] . $path;
            wp_redirect($new_site_url);
            exit;
        }
    }
}

// Register the shortcode
add_shortcode('create_site_form', 'my_create_site_form_shortcode');
