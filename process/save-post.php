<?php

function odr_save_post_admin( int $post_id, WP_Post $post, bool $update) {
	$odr_data = get_post_meta($post_id, '_odr_data', true);
	$odr_data = empty($odr_data) ? [] : $odr_data;

	$odr_data['email'] = isset($odr_data['email']) && !empty($odr_data['email']) ? sanitize_email($odr_data['email']) : '';
	$odr_data['links'] = isset($odr_data['links'])
	                     && is_array($odr_data['links'])
	                     && !empty($odr_data['links'])
	                     && array_reduce($odr_data, function ($carry, $it) { if ($carry === false || !is_string($it) || empty($it)) { return false; } else { return true; } }, true)
		? array_map(function ($it) { return wp_filter_nohtml_kses($it); }, $odr_data['links']) : [];

	$edit_cap = get_post_type_object( $post->post_type )->cap->edit_post;
	if (!current_user_can($edit_cap, $post_id)) {
		return;
	}
	if (!isset($_POST['odr_update_post_nonce']) || !wp_verify_nonce( $_POST['odr_update_post_nonce'], 'odr_update_post_metabox')) {
		return;
	}

	if (array_key_exists('odr_data_email', $_POST)) {
		$odr_data['email'] = sanitize_email($_POST['odr_data_email']);
	}
	if (array_key_exists('odr_data_link_0', $_POST) && $_POST['odr_data_link_0'] === 0) {
		$odr_data['links'] = [];
	}
	$i = 0;
	while (array_key_exists("odr_data_link_$i", $_POST)) {
		$v = $_POST["odr_data_link_$i"];
		if ($v === "") break;
		array_push($odr_data['links'], $v);
		$i++;
	}

	update_post_meta($post_id, '_odr_data', $odr_data);
}