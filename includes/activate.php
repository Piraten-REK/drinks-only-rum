<?php

function odr_activate_plugin() {
	if ( version_compare( get_bloginfo('version'), '5.0', '<') ) {
		wp_die(__('You must update WordPress to use this plugin', 'piraten_odr'));
	}
}