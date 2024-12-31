<?php
class_exists( 'GFForms' ) || die();

/**
 * Outputs a row for each calculation that is enabled.
 *
 * @param array<mixed> $values Array with output values.
 *
 * @return void
 */
function gwp_output_table_row( $values ) {

	echo '<tr>';
	foreach ( $values as $value ) {
		echo '<td>' . esc_html( $value ) . '</td>';
	}
	echo '</tr>';
}
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
				<th style="width:30%"><?php esc_html_e( 'Calculation', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:15%"><?php esc_html_e( 'Number Format', 'gravitywp-merge-tags' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php

			$count_output = 0;

			if ( isset( $form['fields'] ) ) {

				foreach ( $form['fields'] as $field ) {


					/**
					 * Check if calculations are enabled.
					 * If enabled, output calculation data.
					 */
					if ( isset( $field['enableCalculation'] ) && $field['enableCalculation'] === true ) {

						// Field value calulation enabled.

						// Increment output counter. When this stays 0, a 'no results found' text is displayed.

						$count_output++;
						$values = array();

						// Save field information.
						$values['field_id']               = isset( $field['id'] ) ? $field['id'] : '';
						$values['field_label']            = isset( $field['label'] ) ? $field['label'] : '';
						$values['field_admin_label']      = isset( $field['adminLabel'] ) ? $field['adminLabel'] : '';
						$values['field_formula']          = isset( $field['calculationFormula'] ) ? $field['calculationFormula'] : '';
						$values['field_calculation_type'] = 'value';
						$values['field_number_format']    = isset( $field['numberFormat'] ) ? $field['numberFormat'] : '';

						gwp_output_table_row( $values );
					}
					if ( isset( $field['gwp']['minValueCalculation']['enabled'] ) && $field['gwp']['minValueCalculation']['enabled'] === true ) {

						// Min value calulation enabled.

						// Increment output counter. When this stays 0, a 'no results found' text is displayed.

						$count_output++;
						$values = array();

						// Save field information.
						$values['field_id']               = isset( $field['id'] ) ? $field['id'] : '';
						$values['field_label']            = isset( $field['label'] ) ? $field['label'] : '';
						$values['field_admin_label']      = isset( $field['adminLabel'] ) ? $field['adminLabel'] : '';
						$values['field_formula']          = isset( $field['gwp']['minValueCalculation']['formula'] ) ? $field['gwp']['minValueCalculation']['formula'] : '';
						$values['field_calculation_type'] = 'min';
						$values['field_number_format']    = isset( $field['numberFormat'] ) ? $field['numberFormat'] : '';

						gwp_output_table_row( $values );
					}
					if ( isset( $field['gwp']['maxValueCalculation']['enabled'] ) && $field['gwp']['maxValueCalculation']['enabled'] === true ) {

						// Max value calulation enabled.

						// Increment output counter. When this stays 0, a 'no results found' text is displayed.

						$count_output++;
						$values = array();

						// Save field information.
						$values['field_id']               = isset( $field['id'] ) ? $field['id'] : '';
						$values['field_label']            = isset( $field['label'] ) ? $field['label'] : '';
						$values['field_admin_label']      = isset( $field['adminLabel'] ) ? $field['adminLabel'] : '';
						$values['field_formula']          = isset( $field['gwp']['maxValueCalculation']['formula'] ) ? $field['gwp']['maxValueCalculation']['formula'] : '';
						$values['field_calculation_type'] = 'max';
						$values['field_number_format']    = isset( $field['numberFormat'] ) ? $field['numberFormat'] : '';

						gwp_output_table_row( $values );
					}
				}
			}
			if ( $count_output === 0 ) {
				echo '<tr><td colspan="6">' . esc_html( 'No results found.' ) . '</td></tr>';
			}
			?>
		<tbody>
</table>

