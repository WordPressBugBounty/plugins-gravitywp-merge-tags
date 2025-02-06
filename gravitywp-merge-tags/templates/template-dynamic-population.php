<?php
class_exists( 'GFForms' ) || die();
?>
<p></p>

<?php
$gwp_prefill_plugin_activated = class_exists( '\GravityWP\Prefill\GWP_Prefill' );
$pre_fill_url                 = '/?';
$pre_fill_url_excel           = '"/?';
$pre_fill_url_mergetags       = '/?';
$pre_fill_url_jwt             = '';
$gwp_prefill_plugin_activated = class_exists( '\GravityWP\Prefill\GWP_Prefill' );
$pre_fill_url                 = '/?';
$pre_fill_url_excel           = '"/?';
$pre_fill_url_mergetags       = '/?';
$pre_fill_url_jwt             = '';
if ( isset( $form['fields'] ) && is_array( $form['fields'] ) ) {
	foreach ( $form['fields'] as $field ) {
		$displayonly = rgar( $field, 'displayOnly' ) ? 'displayonly' : '';
		if ( isset( $field['choices'] ) && is_array( $field['choices'] ) ) {
			$num_choices = count( $field['choices'] );
			for ( $i = 0;$i < $num_choices;$i++ ) {
				$choices_id = $i + 1;
			}
		}

		if ( ! empty( $field['inputName'] ) && property_exists( $field, 'allowsPrepopulate' ) && $field['allowsPrepopulate'] === true ) {
			$pre_fill_url           .= $field['inputName'] . '=MERGETAG&';
			$pre_fill_url_excel     .= $field['inputName'] . '="&ENCODEURL(CELL)&"&';
			$pre_fill_url           .= $field['inputName'] . '=MERGETAG&';
			$pre_fill_url_excel     .= $field['inputName'] . '="&ENCODEURL(CELL)&"&';
			$pre_fill_url_mergetags .= ( strlen( $field['adminLabel'] ) > 0 ) ? $field['inputName'] . '={' . $field['adminLabel'] . ':' . $field['id'] . '}&' : $field['inputName'] . '={' . $field['label'] . ':' . $field['id'] . '}&';
			if ( $gwp_prefill_plugin_activated ) {
				$pre_fill_url_jwt .= ( strlen( $field['adminLabel'] ) > 0 ) ? $field['inputName'] . '=\'{' . $field['adminLabel'] . ':' . $field['id'] . '}\' ' : $field['inputName'] . '=\'{' . $field['label'] . ':' . $field['id'] . '}\' ';
			}
			if ( $gwp_prefill_plugin_activated ) {
				$pre_fill_url_jwt .= ( strlen( $field['adminLabel'] ) > 0 ) ? $field['inputName'] . '=\'{' . $field['adminLabel'] . ':' . $field['id'] . '}\' ' : $field['inputName'] . '=\'{' . $field['label'] . ':' . $field['id'] . '}\' ';
			}
		}
	}
}
?>

<div id="gwp-dynamic-population-anchor-links-wrapper" style="margin-bottom:10px; display:flex; flex-wrap: wrap; justify-content: space-between;">
	<div id="gwp-dynamic-population-anchor-links" style="flex-grow: 1; border: 1px solid #c3c4c7; background: white; display:flex; flex-wrap: wrap; align-items:center;">
		<span style="padding:10px;"><?php esc_html_e( 'Dynamic Population Type:', 'gravitywp-merge-tags' ); ?></span>
		<a style="padding:10px;" href="#gwp-dynamic-population-url-no-mt"><?php esc_html_e( 'URL', 'gravitywp-merge-tags' ); ?></a>
		<a style="padding:10px;" href="#gwp-dynamic-population-url-mt"><?php esc_html_e( 'URL with merge tags', 'gravitywp-merge-tags' ); ?></a>
		<a style="padding:10px;" href="#gwp-dynamic-population-excel-international"><?php esc_html_e( 'Excel formula (International)', 'gravitywp-merge-tags' ); ?></a>
		<a style="padding:10px;" href="#gwp-dynamic-population-excel-localized"><?php esc_html_e( 'Excel formula (Localized)', 'gravitywp-merge-tags' ); ?></a>
		<?php if ( $gwp_prefill_plugin_activated ) { ?>
		<a style="padding:10px;" href="#gwp-dynamic-population-hwt-prefill"><?php esc_html_e( 'JWT Prefill', 'gravitywp-merge-tags' ); ?></a>
		<?php } ?> 
		
	</div>
</div>

<table class='wp-list-table widefat break-all striped'>
	<tbody>
		<thead>
			<tr>
				<th style="width:15%"><?php esc_html_e( 'Type', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Value', 'gravitywp-merge-tags' ); ?></th>
			</tr>
		</thead>

		<tr>
			<td id="gwp-dynamic-population-url-no-mt" class="break-word"><?php esc_html_e( 'Url query string template for dynamic population', 'gravitywp-merge-tags' ); ?></td>
			<td class='user-select-all'><?php echo esc_html( rtrim( $pre_fill_url, '&' ) ); ?></td>
		</tr>
		<tr>
			<td id="gwp-dynamic-population-url-mt" class="break-word"><?php esc_html_e( 'Url query string template with merge tags for dynamic population', 'gravitywp-merge-tags' ); ?></td>
			<td class='user-select-all'><?php echo esc_html( rtrim( $pre_fill_url_mergetags, '&' ) ); ?></td>
		</tr>
		<tr>
			<td id="gwp-dynamic-population-excel-international" class="break-word"><?php esc_html_e( 'Excel formula for generating url (encoded) query string (International)', 'gravitywp-merge-tags' ); ?></td>
		
			<td class='user-select-all'><?php echo esc_html( rtrim( $pre_fill_url_excel, '&"&' ) ); ?></td>
		</tr>
		<tr>
			<td id="gwp-dynamic-population-excel-localized" class="break-word"><?php esc_html_e( 'Excel formula for generating url (encoded) query string (Localized)', 'gravitywp-merge-tags' ); ?></td>
			<td class='user-select-all'>
			<?php
			/* translators: Translate to localized excel function. */
			$excel_replace = esc_html__( 'ENCODEURL', 'gravitywp-merge-tags' );
			echo esc_html( str_replace( 'ENCODEURL', $excel_replace, rtrim( $pre_fill_url_excel, '&"&' ) ) );
			?>
			</td>
		</tr>
		<?php
		if ( $gwp_prefill_plugin_activated ) {
			?>
		<tr>
			<td id="gwp-dynamic-population-hwt-prefill" class="break-word"><a href="https://gravitywp.com/add-on/jwt-prefill/?utm_source=merge-tags-plugin-page&utm_medium=display&utm_campaign=prefill-string"><?php echo esc_html__( 'JWT Prefill', 'gravitywp-merge-tags' ); ?></a><?php echo ' ' . esc_html__( 'shortcode string for dynamic population', 'gravitywp-merge-tags' ); ?></td>

			<td class='user-select-all'><?php echo esc_html( rtrim( $pre_fill_url_jwt, '&"&' ) ); ?></td>
		</tr>
			<?php
		}
		?>
	</tbody>
</table>
