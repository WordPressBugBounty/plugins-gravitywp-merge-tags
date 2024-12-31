<?php class_exists( 'GFForms' ) || die();

$gwp_workflow       = new Gravity_Flow_API( absint( $_GET['id'] ) );
$gwp_workflow_steps = $gwp_workflow->get_steps();
$formid = $form ? $form['id'] : ''; 
?>
<p></p>
<a class="button" style="margin-bottom:10px;" href="<?php echo admin_url() . esc_html( 'admin.php?page=gravityflow-status&entry-id=&start-date&end-date&form-id=' . $formid . '&gravityflow-print-timelines=print_timelines&gravityflow-print-page-break=print_page_break' ); ?>"><?php esc_html_e( 'Worfklow Status' ); ?></a>

<table class='wp-list-table widefat striped' cellspacing='0'>
			<thead>
			<tr>
				<th><?php esc_html_e( 'Gravity Flow Step', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'ID', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Type', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Active', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Conditions', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Next Step (id)', 'gravitywp-merge-tags' ); ?></th>
				<th><?php esc_html_e( 'Count Shortcode', 'gravitywp-merge-tags' ); ?></th>
			</tr>
			</thead>
		<tbody>
		<?php

		foreach ( $gwp_workflow_steps as $step ) {

			$feed_meta            = $step->get_feed_meta();
			$is_condition_enabled = rgar( $feed_meta, 'feed_condition_conditional_logic' ) == true;
			$logic                = rgars( $feed_meta, 'feed_condition_conditional_logic_object/conditionalLogic' );
			$condition_str        = '';

			$next_step_str = rgar( $feed_meta, 'destination_complete' );
			?>
			<tr>
				<td><a href="<?php echo esc_attr( admin_url() . 'admin.php?page=gf_edit_forms&view=settings&subview=gravityflow&id=' . absint( $_GET['id'] ) . '&fid=' . $step->get_id() ); ?>"><?php echo esc_html( $step->get_name() ); ?></a></td>
				<td><?php echo esc_html( strval( $step->get_id() ) ); ?></td>
				<td><?php echo esc_html( $step->get_type() ); ?></td>
				<td><?php echo esc_html( ( ( $step->is_active() == '1' ) ? '&#10003;' : '&#10007;' ) ); ?></td>
				<td>
				<?php
				if ( $is_condition_enabled && ! empty( $logic ) ) {
					if ( is_array( $logic['rules'] ) ) {

						// Output workflow condition type when multiple conditions are set.

						if ( count( $logic['rules'] ) > 1 ) {

							echo esc_html( $logic['logicType'] );
							?>
							:
							<br>
							<?php
						}

						foreach ( $logic['rules'] as $rule ) {

							// Retrieve field info from field with same ID.

							if ( isset( $form ) ) {
								$field = GFFormsModel::get_field( $form, $rule['fieldId'] );
							}

							// If this field contains choices, save number of choices.

							if ( isset( $field['choices'] ) && is_array( $field['choices'] ) ) {
								$num_choices = count( $field->choices );

								// Loop through choices to find match between value of rule and value of choice.

								for ( $i = 0;$i < $num_choices;++$i ) {

									// If value of choice from field matches value of workflow condition for this choice, save field label of choice for output.

									if ( $field['choices'][ $i ]['value'] === $rule['value'] ) {

										$condition = $field['choices'][ $i ]['text'];
									}
								}
							}

							// If no match is found or when there are no choices set, save value from workflow condition for output.

							if ( empty( $condition ) ) {
								$condition = ( $rule['value'] );
							}

							// Output workflow condition string.

							echo esc_html( GFAPI::get_field( absint( $_GET['id'] ), $rule['fieldId'] )->label . ':' . $rule['fieldId'] . '--' . $rule['operator'] . '--' . $condition );

							// Reset $condition in case of multiple workflow condtions without choices.

							$condition = '';

							?>
							<br>
							<?php
						}
					}
				}
				?>
				</td> 
				<td><?php echo esc_html( $next_step_str ); ?></td>
				<td>[gravitywp_count formid=<?php echo esc_html( (string) absint( $_GET['id'] ) ); ?> workflow_step=<?php echo esc_html( (string) $step->get_id() ); ?>]</td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>
