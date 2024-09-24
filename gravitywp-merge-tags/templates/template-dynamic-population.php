<?php
class_exists( 'GFForms' ) || die();
?>
<p></p>

<?php
$pre_fill_url       = '/?';
$pre_fill_url_excel = '"/?';
$pre_fill_url_mergetags = '/?';
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
			$pre_fill_url       .= $field['inputName'] . '=MERGETAG&';
			$pre_fill_url_excel .= $field['inputName'] . '="&ENCODEURL(CELL)&"&';
			$pre_fill_url_mergetags .= ( strlen( $field['adminLabel'] ) > 0 ) ? $field['inputName'] . '={' . $field['adminLabel'] . ':' . $field['id'] . '}&' : $field['inputName'] . '={' . $field['label'] . ':' . $field['id'] . '}&';
		}
	}
}
?>

<table class='wp-list-table widefat striped'>
	<tbody>
<thead>
	<tr>
		<th colspan='6'><?php esc_html_e( 'Url query string template for dynamic population', 'gravitywp-merge-tags' ); ?></th>
	</tr>
</thead>
<tr>
	<td colspan='6'><?php echo esc_html( rtrim( $pre_fill_url, '&' ) ); ?></td>
</tr>
<thead>
	<tr>
		<th colspan='6'><?php esc_html_e( 'Url query string template with merge tags for dynamic population', 'gravitywp-merge-tags' ); ?></th>
	</tr>
</thead>
<tr>
	<td colspan='6'><?php echo esc_html( rtrim( $pre_fill_url_mergetags, '&' ) ); ?></td>
</tr>
<thead>
	<tr>
		<th colspan='6'><?php esc_html_e( 'Excel formula for generating url (encoded) query string (International)', 'gravitywp-merge-tags' ); ?></th>
	</tr>
</thead>
	<tr>
		<td colspan="6"><?php echo esc_html( rtrim( $pre_fill_url_excel, '&"&' ) ); ?></td>
	</tr>
<thead>
	<tr>
		<th colspan='6'><?php esc_html_e( 'Excel formula for generating url (encoded) query string (Localized)', 'gravitywp-merge-tags' ); ?></th>
	</tr>
</thead>
	<tr>
		<td colspan="6">
		<?php
		/* translators: Translate to localized excel function. */
		$excel_replace = esc_html__( 'ENCODEURL', 'gravitywp-merge-tags' );
		echo esc_html( str_replace( 'ENCODEURL', $excel_replace, rtrim( $pre_fill_url_excel, '&"&' ) ) );
		?>
		</td>
	</tr>
</tbody>
</table>
