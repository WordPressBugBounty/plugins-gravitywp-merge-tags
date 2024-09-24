<?php class_exists( 'GFForms' ) || die(); ?>

<p></p>
<table class='wp-list-table widefat striped' cellspacing='0'>
	<thead>
		<tr><th><?php esc_html_e( 'Merge Tags', 'gravitywp-merge-tags' ); ?></th></tr>
	</thead>
	<tbody>
	<?php

	if ( is_array( $form['fields'] ) ) {
		foreach ( $form['fields'] as $field ) {
			if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

				foreach ( $field['inputs'] as $input ) {
					?>
						<tr><td>{<?php echo esc_html( GFCommon::get_label( $field, $input['id'] ) . ':' . $input['id'] ); ?>}</td></tr>
						<?php
				}
			} elseif ( ! rgar( $field, 'displayOnly' ) ) {
				?>
					<tr><td>{<?php echo esc_html( GFCommon::get_label( $field ) . ':' . $field['id'] ); ?>}</td></tr>
					<?php
			}
		}
	}
	?>
	</tbody>
</table>
