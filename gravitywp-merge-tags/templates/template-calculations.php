<?php
class_exists( 'GFForms' ) || die();
?>
<p></p>

<!-- This table contains number fields with calculations enabled. -->

<table class='wp-list-table widefat striped' cellspacing='0' style="margin-bottom: 20px;">
<thead>
	<tr><th colspan="6"><h4 style="margin:5px auto;"><?php esc_html_e( 'Fields with calculations', 'gravitywp-merge-tags' ); ?></h4></th></tr>
	</thead>
			<thead>
			<tr>
				<th style="width:5%"><?php esc_html_e( 'ID', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:25%"><?php esc_html_e( 'Field Label', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:25%"><?php esc_html_e( 'Admin Label', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:30%"><?php esc_html_e( 'Formula', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:15%"><?php esc_html_e( 'Number Format', 'gravitywp-merge-tags' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php

			$count_output = 0;

			foreach ( $form['fields'] as $field ) {

				
					/**
					 * Check if calculations are enabled.
					 * If enabled, output calculation data.
					 */
					if ( isset( $field[ 'enableCalculation' ] ) && $field[ 'enableCalculation' ] !== true ) {

						continue;
					} else {

						// Increment output counter. When this stays 0, a 'no results found' text is displayed.

						$count_output++;

						// Save field information.
						$field_label       		= isset( $field['label'] ) ? $field['label'] : '';
						$field_id          		= isset( $field['id'] ) ? $field['id'] : '';
						$field_admin_label 		= isset( $field['adminLabel'] ) ? $field['adminLabel'] : '';
						$field_formula     		= isset( $field['calculationFormula'] ) ? $field['calculationFormula'] : '';
						$field_number_format    = isset( $field['numberFormat'] ) ? $field['numberFormat'] : '';
						?>
				<tr>
					<!-- Output field information. -->
					<td><?php echo esc_html($field_id ); ?></td>
					<td><?php echo esc_html( $field_label ); ?></td>
					<td><?php echo esc_html( $field_admin_label ); ?></td>
					<td><?php echo esc_html( $field_formula ); ?></td>
					<td><?php echo esc_html( $field_number_format ); ?></td>
				</tr>
						<?php
					}
				
			}
			if ( isset( $count_output ) && $count_output === 0 ) {
				echo '<tr><td colspan="6">No results found</td></tr>';
			}
			?>
		<tbody>
</table>

