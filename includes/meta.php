<?php
function odr_add_meta_box() {
	add_meta_box(
		'odr_post_options_metabox',
		'Weitere Infos',
		'odr_post_options_metabox_html',
		'signalment',
		'normal',
		'default'
	);
}

function odr_post_options_metabox_html(WP_Post $post) {
	$odr_data = get_post_meta($post->ID, '_odr_data', true);
	$email = isset($odr_data['email']) && !empty($odr_data['email']) ? sanitize_email($odr_data['email']) : '';
	$links = isset($odr_data['links'])
	         && is_array($odr_data['links'])
	         && !empty($odr_data['links'])
	         && array_reduce($odr_data['links'], function ($carry, $it) { if ($carry === false || !is_string($it) || empty($it)) { return false; } else { return true; } }, true)
		? array_map(function ($it) { return wp_filter_nohtml_kses($it); }, $odr_data['links']) : [];
	wp_nonce_field('odr_update_post_metabox', 'odr_update_post_nonce');
	?>
	<p>
		<label for="odr_data_email"><?php esc_html_e('E-Mail-Adresse','piraten_odr'); ?></label>
		<br />
		<input class="widefat" type="email" name="odr_data_email" id="odr_data_email" value="<?php echo esc_attr($email); ?>" />
		<br>
		<fieldset id="odr_data_links" data-num="<?php echo esc_attr(sizeof($links)); ?>">
			<legend>Links</legend>
			<?php foreach ($links as $id => $link):  ?>
			<input class="widefat" type="text" name="odr_data_link_<?php echo esc_attr($id); ?>" id="odr_data_link_<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($link); ?>">
			<br/>
			<?php endforeach; ?>
			<input class="widefat" type="text" name="odr_data_link_<?php echo esc_attr(sizeof($links)); ?>" id="odr_data_link_<?php echo esc_attr(sizeof($links)); ?>" value="">
		</fieldset>
		<script defer>
			function addInput() {
			    var i = parseInt(this.id.slice(this.id.lastIndexOf('_') + 1)) + 1
			    var e = document.createElement('input')
				e.classList.add('widefat')
				e.type = 'text'
				e.name = 'odr_data_link_' + i
				e.id = 'odr_data_link_' + i
                document.getElementById('odr_data_links').appendChild(e)
				e.addEventListener('input', addInput)
				this.removeEventListener('input', addInput)
			}
            document.getElementById('odr_data_link_' + document.getElementById('odr_data_links').dataset.num).addEventListener('input', addInput)
		</script>
		<style>
			#odr_data_links > input {
				margin-bottom: .4rem;
			}
			#odr_data_links > input:last-child {
				margin: 0;
			}
		</style>
	</p>
	<?php
}