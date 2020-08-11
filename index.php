<?php

/**
 * Only Drinks Rum
 *
 * @package only_drinks_rum
 * @author Mike Kühnapfel <mailto:mike.kuehnapfel@piraten-rek.de>
 * @copyright 2020 Mike Kühnapfel
 * @license GPL-3.0-or-later
 * @version 1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Only Drinks Rum!
 * Plugin URI: https://github.com/piraten-rek/only_drinks_rum
 * Description: Fügt die Möglichkeit hinzu spezielle Seiten für Steckbriefe anzulegen
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Mike Kühnapfel
 * Author URI: mailto:mike.kuehnapfel@piraten-rek.de
 * License: GNU General Public License 3.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 * Text Domain: piraten_odr
 */

// kill script if executed outside of wordpress
if (!function_exists('add_action')) {
	die("Hi there! I'm just a plugin not much I can do when called directly.");
}

// Setup

// Includes
include('includes/activate.php');
include('includes/init.php');
include('process/save-post.php');
include('includes/meta.php');

// Hooks
register_activation_hook(__FILE__, 'odr_activate_plugin');
add_action('init', 'odr_init');
add_action('save_post_signalment', 'odr_save_post_admin', 10, 3);
add_action('add_meta_boxes_signalment', 'odr_add_meta_box');

// Shortcodes