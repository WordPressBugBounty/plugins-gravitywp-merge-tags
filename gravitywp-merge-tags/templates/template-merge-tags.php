<?php class_exists( 'GFForms' ) || die(); ?>

<p></p>
<table class='wp-list-table widefat striped' cellspacing='0'>
	<thead>
		<tr><th><?php esc_html_e( 'Merge Tags', 'gravitywp-merge-tags' ); ?></th></tr>
	</thead>
	<tbody>
	<?php

	if ( isset( $form['fields'] ) && is_array( $form['fields'] ) ) {
		foreach ( $form['fields'] as $field ) {
			if ( ! rgar( $field, 'displayOnly' ) ) {
				?>
					<tr><td class="gwp-value-select">{<?php echo esc_html( GFCommon::get_label( $field ) . ':' . $field['id'] ); ?>}</td></tr>
					<?php
			}
			if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) && $field->type !== 'date' ) {

				foreach ( $field['inputs'] as $input ) {
					?>
						<tr><td class="gwp-value-select">{<?php echo esc_html( GFCommon::get_label( $field, $input['id'] ) . ':' . $input['id'] ); ?>}</td></tr>
						<?php
				}
			}
		}
	}
	?>
	</tbody>
</table>
