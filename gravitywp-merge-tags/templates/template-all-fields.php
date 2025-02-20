<?php

class_exists( 'GFForms' ) || die(); ?>

<?php
	// True when required plugin for additional functionality is activated, otherwise false.
	$gf_all_fields_template_plugin_activated = class_exists( 'GW_All_Fields_Template' );
	$gview_plugin_activated                  = class_exists( 'GravityView_Plugin' );
?>
<script>
// Genereted All Fields Merge Tag: select/unselect all checkboxes.
function gwpAllFieldsToggleCheckboxes(element){
	if ( jQuery(element).is(':checked') ) {
		jQuery('table input[type="checkbox"].field_input_id ').prop('checked', true);
	} else {
		jQuery('table input[type="checkbox"].field_input_id ').prop('checked', false);
	}
	// Call function to output All Fields Merge Tag.
	gwpAllFieldsGenerateMergeTag();
}

// Genereted All Fields Merge Tag: generate and output ALl Fields Merge Tag.
function gwpAllFieldsGenerateMergeTag(){
	var fieldIds = [];
	var includeExclude = jQuery('input[name="include_exclude"]:checked').attr('include_exclude');
	if (includeExclude !== undefined) {
		jQuery('table tr input[type="checkbox"].field_input_id ').each(function() {
			if(jQuery(this).prop('checked')) {
				fieldIds.push(jQuery(this).attr('id'));
			}
		})
		jQuery('#gwp_all_fields_custom_merge_tag #gwp_all_fields_custom_merge_tag_output').text('{all_fields:' + includeExclude + '[' + fieldIds + ']}');
	} else {
		jQuery('#gwp_all_fields_custom_merge_tag #gwp_all_fields_custom_merge_tag_output').text('{all_fields}');
	}
}

// Genereted All Fields Merge Tag: copy output to clipboard.
const gwpAllFieldsCopyToClipboard = async () => {
	try {
	const element = document.getElementById("gwp_all_fields_custom_merge_tag_output");
	await navigator.clipboard.writeText(element.textContent);
	} catch (error) {
	console.error("Failed to copy to clipboard:", error);
	}
};

/** Show/hides dynamic field labels */
function gwpAllFieldsDynamicFieldLabels() {
	var dynamic_labels = jQuery('input[name="gwp_all_fields_dynamic_labels"]:checked').val();
	if (dynamic_labels === 'yes') {
		jQuery('.with-dynamic-field-label').show();
		jQuery('.without-dynamic-field-label').hide();
	} else {
		jQuery('.with-dynamic-field-label').hide();
		jQuery('.without-dynamic-field-label').show();
	}
}
</script>

<!-- Copy to clipboard button -->

<style>table.fixed { table-layout: auto;  }</style>
<p></p>
<?php if ( $gf_all_fields_template_plugin_activated ) { ?>
<!-- Genereted All Fields Merge Tag Settings  -->
<div id="gwp_all_fields_custom_merge_tag" style="width: 100%; border: 1px solid #c3c4c7; background: white; margin-right:10px; display:flex; flex-wrap: wrap; flex-direction: column; margin-top:10px; margin-bottom:10px; align-items:start; word-break: break-word;" >
	<span style="margin: 10px 10px 0px 10px; border: 1px solid; background: #f6f7f7; padding: 5px;" id="gwp_all_fields_custom_merge_tag_output"><?php echo esc_html( '{all_fields}' ); ?></span>
	<span style="width:100%; padding: 10px;">
		<button id="copy-btn" type="button" class="button" onclick="gwpAllFieldsCopyToClipboard();"><?php esc_html_e( 'Copy', 'gravitywp-merge-tags' ); ?></button>
	</span>
</div>
	<?php
}
?>

<!-- Genereted All Fields Merge Tag Settings  -->

<div id="gwp_toggle_settings_all_fields" style="margin-bottom:10px; display:flex; flex-wrap: wrap; justify-content: space-between;">
	<div id="gwp_toggle_columns_all_fields" style="border: 1px solid #c3c4c7; background: white; display:flex; flex-wrap: wrap; align-items:center;">
		<?php
		// Genereted All Fields Merge Tag: Show message if required plugin is not active.
		if ( ! $gf_all_fields_template_plugin_activated ) {
			?>
			<span style="padding: 10px;"><?php esc_html_e( 'To filter, include ands exclude fields with the {all_fields} Merge Tag, install ' ); ?>
			<a href="<?php echo esc_url( 'https://gravitywiz.com/gravity-forms-all-fields-template/?ref=46' ); ?>" target="_blank">
			<?php esc_html_e( 'Gravity Forms All Fields Template', 'gravitywp-merge-tags' ); ?></a></span>
			<?php
		} else {
			// Genereted All Fields Merge Tag: Show radiobuttons if required plugin is active.
			?>
		<span style="padding:10px;"><?php esc_html_e( 'All Fields filter', 'gravitywp-merge-tags' ); ?>:</span><span class="gfield_required gfield_required_asterisk">*</span>
		<span style="padding:10px;">
			<input type="radio" id="radio_exclude" name="include_exclude" include_exclude="exclude" checked onchange="gwpAllFieldsGenerateMergeTag();">
			<label style="vertical-align: baseline;" for="exclude"><?php esc_html_e( 'Exclude', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="radio" id="radio_include" name="include_exclude" include_exclude="include" onchange="gwpAllFieldsGenerateMergeTag();">
			<label style="vertical-align: baseline;" for="include"><?php esc_html_e( 'Include', 'gravitywp-merge-tags' ); ?></label>
		</span>	
		<span style="padding:10px;">
			<input type="radio" id="radio_filter" name="include_exclude" include_exclude="filter" onchange="gwpAllFieldsGenerateMergeTag();">
			<label style="vertical-align: baseline;" for="filter"><?php esc_html_e( 'Filter', 'gravitywp-merge-tags' ); ?></label>
		</span>	
			<?php
		}
		?>
	</div>

	<!-- Replace All Fields settings -->

	<div id="gwp_all_fields_anchor_links" style="flex-grow: 1; border: 1px solid #c3c4c7; background: white; display:flex; flex-wrap: wrap; align-items:center; margin-left: 10px;">
		<span style="padding:10px;"><?php esc_html_e( 'Replace All Fields:', 'gravitywp-merge-tags' ); ?></span>
		<a style="padding:10px;" href="#gwp-replace-all-fields-regular"><?php esc_html_e( 'All fields', 'gravitywp-merge-tags' ); ?></a>
		<a style="padding:10px;" href="#gwp-replace-all-fields-gf-shortcode"><?php esc_html_e( 'Gravity Forms conditional shortcode', 'gravitywp-merge-tags' ); ?></a>
		<?php if ( $gview_plugin_activated ) { ?>
		<a style="padding:10px;" href="#gwp-replace-all-fields-gview-shortcode"><?php esc_html_e( 'GravityView gvlogic', 'gravitywp-merge-tags' ); ?></a>
		<?php } ?> 
		<a style="padding:10px;" href="#gwp-replace-all-fields-no-uploads"><?php esc_html_e( 'Without fileuploads', 'gravitywp-merge-tags' ); ?></a>
		<div style="margin-left: 10px;">
			<input style="margin-left: 10px;" type="checkbox" onchange="gwpAllFieldsDynamicFieldLabels()" id="gwp_all_fields_dynamic_labels_yes" name="gwp_all_fields_dynamic_labels" value="yes" />
			<label for="gwp_all_fields_dynamic_labels_yes" style="padding-bottom: 4px;"><?php esc_html_e( 'Use {:label}', 'gravitywp-merge-tags' ); ?></label>
		</div>
	</div>
</div>

<?php
if ( $gf_all_fields_template_plugin_activated ) {
	?>
<table class='wp-list-table widefat striped' cellspacing='0'>
	<thead>

		<!-- Table to select fields for a generated merge tag. -->
		<tr>
		<th>
			<input style="margin-left: 0px;" type="checkbox" id="checkbox_select_all" name="checkbox_select_all" onchange="gwpAllFieldsToggleCheckboxes(this);"  tooltip="<?php esc_html_e( 'Select all fields', 'gravitywp-merge-tags' ); ?>">
			</th>
			<th><?php esc_html_e( 'Label', 'gravitywp-merge-tags' ); ?></th>
			<th><?php esc_html_e( 'Admin Label', 'gravitywp-merge-tags' ); ?></th>
			<th><?php esc_html_e( 'Type', 'gravitywp-merge-tags' ); ?></th>
			<th><?php esc_html_e( 'CSS', 'gravitywp-merge-tags' ); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php

	if ( isset( $form['fields'] ) && is_array( $form['fields'] ) ) {

		foreach ( $form['fields'] as $field ) {
			// Output field.
			?>
			<tr>
				<td><input type="checkbox" class=field_input_id name="<?php echo esc_html( $field['id'] ); ?>" id="<?php echo esc_html( $field['id'] ); ?>" onchange="gwpAllFieldsGenerateMergeTag();"></td>
				<td><?php echo $field['label'] !== '' ? esc_html( '{' . $field['label'] . ':' . $field['id'] . '}' ) : ''; ?></td>
				<td><?php echo $field['adminLabel'] !== '' ? esc_html( $field['adminLabel'] ) : ''; ?></td>
				<td><?php echo $field['type'] !== '' ? esc_html( $field['type'] ) : ''; ?></td>
				<td><?php echo $field['cssClass'] !== '' ? esc_html( $field['cssClass'] ) : ''; ?></td>
			</tr>
			<?php

			if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

				foreach ( $field['inputs'] as $input ) {
					// Output field inputs.
					?>
					<tr>
						<td><input type="checkbox" class=field_input_id name="<?php echo esc_html( $input['id'] ); ?>" id="<?php echo esc_html( $input['id'] ); ?>" onchange="gwpAllFieldsGenerateMergeTag();"></td>
						<td><?php echo $input['label'] !== '' ? esc_html( '{' . $input['label'] . ':' . $input['id'] . '}' ) : ''; ?></td>
						<td><?php echo $field['adminLabel'] !== '' ? esc_html( $field['adminLabel'] ) : ''; ?></td>
						<td><?php echo $field['type'] !== '' ? esc_html( $field['type'] ) : ''; ?></td>
						<td><?php echo $field['cssClass'] !== '' ? esc_html( $field['cssClass'] ) : ''; ?></td>
					</tr>
					<?php
				}
			}
		}
	}
	?>
	</tbody>
</table>
<?php } ?>
<table class='wp-list-table widefat striped fixed' cellspacing='0'>
	<thead>
	<tr>
	<th class='gwp_title'>
		<?php esc_html_e( 'All Fields', 'gravitywp-merge-tags' ); ?> <?php esc_html_e( 'Type', 'gravitywp-merge-tags' ); ?>
	</th>
	<th>
		<?php esc_html_e( 'All Fields', 'gravitywp-merge-tags' ); ?> <?php esc_html_e( 'Table', 'gravitywp-merge-tags' ); ?>
	</th>
	</tr>
	</thead>
	<tbody>

		<!-- All fields including file upload fields. -->

		<tr>
			<td id="gwp-replace-all-fields-regular"><?php esc_html_e( 'Replace All Fields Merge Tag', 'gravitywp-merge-tags' ); ?></td>
			<td>
			<?php echo esc_html( '<table><tbody>' ); ?><br>
			<?php

			if ( isset( $form ) && is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

						foreach ( $field['inputs'] as $input ) {
							?>
							<span class="without-dynamic-field-label">
							<?php
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>' );
							?>
							</span>
							<span class="with-dynamic-field-label" style="display:none;">
							<?php
							echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) . ':' . $field['id'] . ':label}' );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>' );
							?>
							</span>
							<br>
							<?php
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
						?>
						<span class="without-dynamic-field-label">
						<?php
						echo esc_html( "<tr><td class='gwp-allfields-label'>" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>' );
						?>
						</span>
						
						<span class="with-dynamic-field-label" style="display:none;">
						<?php
						echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
						echo esc_html( GFCommon::get_label( $field ) . ':' . $field['id'] . ':label}' );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>' );
						?>
						</span>
						<br>
						<?php
					}
				}
			}
			echo esc_html( '</tbody></table>' );
			?>
			</td>
		</tr>

		<!-- All fields including GF conditional shortcode. -->

		<tr>
			<td id="gwp-replace-all-fields-gf-shortcode" ><?php esc_html_e( 'Replace All Fields Merge Tag with Gravity Forms shortcode', 'gravitywp-merge-tags' ); ?></td>
			<td>
			<?php echo esc_html( '<table><tbody>' ); ?><br>
			<?php

			if ( isset( $form ) && is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

						foreach ( $field['inputs'] as $input ) {
							?>
							<span class="without-dynamic-field-label">
							<?php
							$mergetag = "{{$field['label']}:{$field['id']}}";
							echo esc_html( '[gravityforms action="conditional" merge_tag="' . $mergetag . '" condition="isnot" value=""]' );
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>[/gravityforms]' );
							?>
							</span>
							
							<span class="with-dynamic-field-label" style="display:none;">
							<?php
							$mergetag = "{{$field['label']}:{$field['id']}}";
							echo esc_html( '[gravityforms action="conditional" merge_tag="' . $mergetag . '" condition="isnot" value=""]' );
							echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) . ':' . $input['id'] . ':label}' );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>[/gravityforms]' );
							?>
							</span>
							<br>
							<?php
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
						?>
						<span class="without-dynamic-field-label">
						<?php
						$mergetag = "{{$field['label']}:{$field['id']}}";
						echo esc_html( '[gravityforms action="conditional" merge_tag="' . $mergetag . '" condition="isnot" value=""]' );
						echo esc_html( "<tr><td class='gwp-allfields-label'>" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>[/gravityforms]' );
						?>
						</span>
						
						<span class="with-dynamic-field-label" style="display:none;">
						<?php
						$mergetag = "{{$field['label']}:{$field['id']}}";
						echo esc_html( '[gravityforms action="conditional" merge_tag="' . $mergetag . '" condition="isnot" value=""]' );
						echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
						echo esc_html( GFCommon::get_label( $field ) . ':' . $field['id'] . ':label}' );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>[/gravityforms]' );
						?>
						</span>
						<br>
						<?php
					}
				}
			}
			echo esc_html( '</tbody></table>' );
			?>
			</td>
		</tr>

		<!-- All fields including GV conditional shortcode. -->

		<?php
		if ( class_exists( 'GravityView_Plugin' ) ) {
			?>

		<tr>
			<td id="gwp-replace-all-fields-gview-shortcode"><?php esc_html_e( 'Replace All Fields Merge Tag with Gravity View shortcode', 'gravitywp-merge-tags' ); ?></td>
			<td>
			<?php echo esc_html( '<table><tbody>' ); ?><br>
			<?php

			if ( isset( $form ) && is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {
						
						foreach ( $field['inputs'] as $input ) {
							?>
						<span class="without-dynamic-field-label">
						<?php
							$mergetag = "{{$field['label']}:{$field['id']}}";
							echo esc_html( '[gvlogic if="' . $mergetag . '" isnot=""]' );
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>[/gvlogic]' );
							?>
							</span>

							<span class="with-dynamic-field-label" style="display:none;">
							<?php
								$mergetag = "{{$field['label']}:{$field['id']}}";
								echo esc_html( '[gvlogic if="' . $mergetag . '" isnot=""]' );
								echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) . ':' . $input['id'] . ':label}' );
								echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
								echo esc_html( ':' );
								echo esc_html( $input['id'] );
								echo esc_html( '}</td></tr>[/gvlogic]' );
							?>
							</span>
							<br>
								<?php
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
						?>
						<span class="without-dynamic-field-label">
						<?php
						$mergetag = "{{$field['label']}:{$field['id']}}";
						echo esc_html( '[gvlogic if="' . $mergetag . '" isnot=""]' );
						echo esc_html( "<tr><td class='gwp-allfields-label'>" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>[/gvlogic]' );
						?>
						</span>

						<span class="with-dynamic-field-label" style="display:none;">
						<?php
						$mergetag = "{{$field['label']}:{$field['id']}}";
						echo esc_html( '[gvlogic if="' . $mergetag . '" isnot=""]' );
						echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
						echo esc_html( GFCommon::get_label( $field ) . ':' . $field['id'] . ':label}' );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>[/gvlogic]' );
						?>
						</span>
						<br>
						<?php
					}
				}
			}
				echo esc_html( '</tbody></table>' );
			?>
			</td>
		</tr>

		<?php
		}
		?>

		<!-- All fields without file upload fields. -->

		<tr>
			<td id="gwp-replace-all-fields-no-uploads">
			<?php
				esc_html_e( 'Replace All Fields Merge Tag without fileuploads', 'gravitywp-merge-tags' );
			?>
			</td>
			<td>
			<?php
			echo esc_html( '<table><tbody>' );
			?>
			<br>
			<?php
			if ( isset( $form ) && is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {
						
						foreach ( $field['inputs'] as $input ) {
							?>
							<span class="without-dynamic-field-label 1">
							<?php
							if ( RGFormsModel::get_input_type( $field ) !== 'fileupload' ) {
								echo esc_html( "<tr><td class='gwp-allfields-label'>" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
								echo esc_html( "</td><td class='gwp-allfields-value'>{" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
								echo esc_html( ':' );
								echo esc_html( $input['id'] );
								echo esc_html( '}</td></tr>' );
								?>
						</span>

						<span class="with-dynamic-field-label 2" style="display:none;">
								<?php
								echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) . ':' . $input['id'] . ':label}' );
								echo esc_html( "</td><td class='gwp-allfields-value'>{" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
								echo esc_html( ':' );
								echo esc_html( $input['id'] );
								echo esc_html( '}</td></tr>' );
								?>
						</span>
								<br>
								<?php
							}
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {

						if ( RGFormsModel::get_input_type( $field ) !== 'fileupload' ) {
							?>
						<span class="without-dynamic-field-label 3">
							<?php
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" );
							echo esc_html( GFCommon::get_label( $field ) );
							echo esc_html( ':' );
							echo esc_html( $field['id'] );
							echo esc_html( '}</td></tr>' );
							?>
							</span>

							<span class="with-dynamic-field-label 4" style="display:none;">
							<?php
							echo esc_html( "<tr><td class='gwp-allfields-label'>{" );
							echo esc_html( GFCommon::get_label( $field ) . ':' . $field['id'] . ':label}' );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" );
							echo esc_html( GFCommon::get_label( $field ) );
							echo esc_html( ':' );
							echo esc_html( $field['id'] );
							echo esc_html( '}</td></tr>' );
							?>
							</span>
							<br>
							<?php
						}
					}
				}
			}
				echo esc_html( '</tbody></table>' );
			?>
			</td>
		</tr>
	</tbody>
</table>
