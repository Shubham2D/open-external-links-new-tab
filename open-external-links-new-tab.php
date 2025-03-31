<?php
/**
 * Plugin Name: Open External Links in New Tab
 * Description: Automatically opens all external links in a new tab with rel="noopener".
 * Version: 1.0
 * Author: Your Name
 * License: MIT
 */

if (!defined('ABSPATH')) exit; // Prevent direct access

function open_external_links_in_new_tab($content) {
    $pattern = '/<a href=["\'](https?:\/\/[^"\']+)["\']/i';
    $content = preg_replace_callback($pattern, function($matches) {
        $url = $matches[1];
        $site_url = get_site_url();
        if (strpos($url, $site_url) === false) {
            return '<a href="' . esc_url($url) . '" target="_blank" rel="noopener"';
        }
        return $matches[0];
    }, $content);
    return $content;
}
add_filter('the_content', 'open_external_links_in_new_tab');