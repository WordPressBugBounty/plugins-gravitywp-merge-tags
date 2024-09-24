<?php
class_exists( 'GFForms' ) || die();
?>
<p></p>

<!-- First tabel contains fields that have an active conditional logic set. -->

<table class='wp-list-table widefat striped' cellspacing='0' style="margin-bottom: 20px;">
<thead>
	<tr><th colspan="6"><h4 style="margin:5px auto;"><?php esc_html_e( 'Fields with active conditional logic rules', 'gravitywp-merge-tags' ); ?></h4></th></tr>
	</thead>
			<thead>
			<tr>
				<th style="width:5%"><?php esc_html_e( 'ID', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:25%"><?php esc_html_e( 'Field Label', 'gravitywp-merge-tags' ); ?></th>
				<th style="width:15%"><?php esc_html_e( 'Admin Label', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Show / Hide', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Match', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Rules', 'gravitywp-merge-tags' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php

			$count_output = 0;

			foreach ( $form['fields'] as $field ) {

				// Check if field has conditional logic set.
				if ( is_array( $field['conditionalLogic'] ) && is_array( $field['conditionalLogic']['rules'] ) ) {

					/**
					 * Check if conditional logic is enabled (does not apply on older forms).
					 * If enabled, output conitional logic rules,
					 */
					if ( isset( $field['conditionalLogic']['enabled'] ) && $field['conditionalLogic']['enabled'] === false ) {

						continue;
					} else {

						// Increment output counter. When this stays 0, a 'no results found' text is displayed.

						$count_output++;

						// Save field information.
						$field_label       = isset( $field['label'] ) ? $field['label'] : '';
						$field_id          = isset( $field['id'] ) ? $field['id'] : '';
						$field_admin_label = isset( $field['adminLabel'] ) ? $field['adminLabel'] : '';
						$field_show_hide   = isset( $field['conditionalLogic']['actionType'] ) ? $field['conditionalLogic']['actionType'] : '';
						$field_match       = isset( $field['conditionalLogic']['logicType'] ) ? $field['conditionalLogic']['logicType'] : '';
						?>
				<tr>
					<!-- Output field information. -->
					<td><?php echo $field_id; ?></td>
					<td><?php echo esc_html( $field_label ); ?></td>
					<td><?php echo esc_html( $field_admin_label ); ?></td>
					<td><?php echo esc_html( $field_show_hide ); ?></td>
					<td><?php echo esc_html( $field_match ); ?></td>
					<td>
						<?php
						foreach ( $field['conditionalLogic']['rules'] as $rule ) {

							// Save rule information.
							$rule_field_id = isset( $rule['fieldId'] ) ? $rule['fieldId'] : '';
							$rule_operator = isset( $rule['operator'] ) ? $rule['operator'] : '';
							$rule_value    = isset( $rule['value'] ) ? $rule['value'] : '';

							// Save field ID of rule.
							$connected_field = GFAPI::get_field( $form, $rule['fieldId'] );

							// Output rule.
							$conditional_logic_rule = $connected_field['label'] . ':' . $rule_field_id . '--' . $rule_operator . '--' . $rule_value;
							echo esc_html( $conditional_logic_rule );

							// Reset rule in case there are multiple rules.
							$rule = '';
							?>
							<br>
							<?php
						}
						?>
					</td>
				</tr>
						<?php
					}
				}
			}
			if ( isset( $count_output ) && $count_output === 0 ) {
				echo '<tr><td colspan="6">No results found</td></tr>';
			}
			?>
		<tbody>
</table>

<!-- Second table contains fields where conditional logic is based upon. -->

<table class='wp-list-table widefat striped' cellspacing='0'>
	<thead>
	<tr><th colspan="4"><h4 style="margin:5px auto;"><?php esc_html_e( 'Fields used in conditional logic rules', 'gravitywp-merge-tags' ); ?></h4></th></tr>
	</thead>
	<thead>
		<tr>
			<th style="width:5%"><?php esc_html_e( 'ID', 'gravitywp-merge-tags' ); ?></th>
			<th style="width:25%"><?php esc_html_e( 'Field Label', 'gravitywp-merge-tags' ); ?></th>
			<th style="width:15%"><?php esc_html_e( 'Admin Label', 'gravitywp-merge-tags' ); ?></th>
			<th><?php esc_html_e( 'Used in conditional logic of field with ID', 'gravitywp-merge-tags' ); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php

	// Initialize empty output array.
	$output_arr = array();

	foreach ( $form['fields'] as $field ) {

			// Check if field has conditional logic set.
		if ( is_array( $field['conditionalLogic'] ) && is_array( $field['conditionalLogic']['rules'] ) ) {

			/**
			 * Check if conditional logic is enabled (does not apply on older forms).
			 * If enabled, output conitional logic rules,
			 */
			if ( isset( $field['conditionalLogic']['enabled'] ) && $field['conditionalLogic']['enabled'] === false ) {

				continue;
			} else {

				// Check if fieldId is found in rule. If no, skip output.
				if ( ! isset( $field['conditionalLogic']['rules']['0']['fieldId'] ) ) {

					continue;
				} else {

					// Get and save data for output.
					$condition_field_id = $field['conditionalLogic']['rules']['0']['fieldId'];

					// Get field info of field that is used in rule by the ID.
					$condition_field = GFAPI::get_field( $form['id'], $condition_field_id );

					// Save data for output
					$condition_field_label       = isset( $condition_field['label'] ) ? $condition_field['label'] : '';
					$condition_field_admin_label = isset( $condition_field['adminLabel'] ) ? $condition_field['adminLabel'] : '';

					// Create array for ouput.

					// If field ID in rule is already present in array, add main field ID to exisitng value.
					if ( isset( $output_arr[ $condition_field_id ] ) ) {

						$output_arr[ $condition_field_id ]['main_field'] .= '<br>' . $field['id'] . ':' . $field['label'];
					} else {

						$output_arr[ $condition_field_id ] = array(
							'contition_field_label'       => $condition_field_label,
							'contition_field_admin_label' => $condition_field_admin_label,
							'main_field'                  => $field['id'] . ':' . $field['label'],
						);
					}
				}
			}
		}
	}

	// Show no results if there is no output.

	if ( isset( $output_arr ) && count( $output_arr ) === 0 ) {
		echo '<tr><td colspan="4">No results found</td></tr>';
	}

	// Loop through array anf output values.

	foreach ( $output_arr as $key => $value ) {

		?>
		<tr>
			<td><?php echo esc_html( $key ); ?></td>
			<td><?php echo esc_html( $value['contition_field_label'] ); ?></td>
			<td><?php echo esc_html( $value['contition_field_admin_label'] ); ?></td>
			<td><?php echo $value['main_field']; ?></td>
		</tr>
		<?php
	}
	?>
</tbody>
</table>
