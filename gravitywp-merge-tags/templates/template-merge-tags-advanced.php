<?php class_exists( 'GFForms' ) || die(); ?>

<script>
function gwp_mt_toggle( element ){
	if ( ! element.checked ) {
		jQuery('table.merge-tags-table .' + element.name).hide();
	} else {
		jQuery('table.merge-tags-table .' + element.name).show();
	}
}
</script>
<div id="gwp_toggle_settings" style="margin-bottom:10px; display:flex; flex-wrap: wrap;">
	<div id="gwp_toggle_columns" style="border: 1px solid #c3c4c7; background: white; margin-right:10px; display:flex; flex-wrap: wrap; margin-top:10px;">
		<span style="padding:10px;"><?php esc_html_e( 'Toggle columns:', 'gravitywp-merge-tags'); ?></span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_fieldlabel" name="fieldlabel" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_fieldlabel"><?php esc_html_e( 'Field Label', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_adminlabel" name="adminlabel" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_adminlabel"><?php esc_html_e( 'Admin Label', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_mergetag" name="mergetag" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_mergetag"><?php esc_html_e( 'Merge Tag', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_mergetagadmin" name="mergetagadmin" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_mergetagadmin"><?php esc_html_e( 'Merge Tag (admin)', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_mergtagshort" name="mergtagshort" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_mergtagshort"><?php esc_html_e( 'Merge Tag (short)', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_populate" name="populate" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_populate"><?php esc_html_e( 'Populate', 'gravitywp-merge-tags' ); ?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_css" name="css" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_css"><?php esc_html_e( 'CSS', 'gravitywp-merge-tags' );?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_fieldtype" name="fieldtype" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_fieldtype"><?php esc_html_e( 'Field Type', 'gravitywp-merge-tags' );?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_fieldid" name="fieldid" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_fieldid"><?php esc_html_e( 'Field ID', 'gravitywp-merge-tags' );?></label>
		</span>
	</div>
	<div style="border: 1px solid #c3c4c7; background: white; margin-top:10px; display:flex; flex-wrap: wrap;">
		<span style="padding:10px;"><?php esc_html_e( 'Toggle field types: ', 'gravitywp-merge-tags' ); ?></span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_choice" name="choice" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_choice"><?php esc_html_e( 'Choices', 'gravitywp-merge-tags' );?></label>
		</span>
		<span style="padding:10px;">
			<input type="checkbox" id="checkbox_displayonly" name="displayonly" checked oninput="gwp_mt_toggle(this)">
			<label style="vertical-align: baseline;" for="checkbox_displayonly"><?php esc_html_e( 'Non-input fields', 'gravitywp-merge-tags' ); ?></label>
		</span>
	</div>
</div>
<table class='wp-list-table widefat striped merge-tags-table' cellspacing='0'>
	<thead>
		<tr>
			<th class=fieldlabel><?php esc_html_e( 'Field Label', 'gravitywp-merge-tags' ); ?></th>	
			<th class=adminlabel><?php esc_html_e( 'Admin Label / value', 'gravitywp-merge-tags' ); ?></th>
			<th class=mergetag><?php esc_html_e( 'Merge Tag', 'gravitywp-merge-tags' ); ?></th>
			<th class=mergetagadmin><?php esc_html_e( 'Merge Tag (admin)', 'gravitywp-merge-tags' ); ?></th>
			<th class=mergtagshort><?php esc_html_e( 'Merge Tags (short)', 'gravitywp-merge-tags' ); ?></th>
			<th class=populate><?php esc_html_e( 'Populate', 'gravitywp-merge-tags' ); ?></th>
			<th class=css><?php esc_html_e( 'CSS', 'gravitywp-merge-tags' ); ?></th>
			<th class=fieldtype><?php esc_html_e( 'Field Type', 'gravitywp-merge-tags' ); ?></th>
			<th class=fieldid><?php esc_html_e( 'Field ID', 'gravitywp-merge-tags' ); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ( is_array( $form['fields'] ) ) {
		foreach ( $form['fields'] as $field ) {
			$displayonly = rgar( $field, 'displayOnly' ) ? 'displayonly' : '';
			?>
			<tr class='<?php echo esc_html( $displayonly ); ?>'>
				<td class=fieldlabel><?php echo esc_html( $field['label'] ); ?></td>
				<td class=adminlabel><?php echo esc_html( $field['adminLabel'] ); ?></td>
				<td class=mergetag>{<?php echo esc_html( $field['label'] ); ?>:<?php echo esc_html( $field['id'] ); ?>}</td>
				<td class=mergetagadmin>{<?php echo esc_html( $field['adminLabel'] ); ?>:<?php echo esc_html( $field['id'] ); ?>}</td>
				<td class=mergtagshort>{:<?php echo esc_html( $field['id'] ); ?>}</td>
				<td class=populate><?php echo esc_html( $field['allowsPrepopulate'] ? $field['inputName'] : '' ); ?></td>
				<td class=css><?php echo esc_html( $field['cssClass'] ); ?></td>
				<td class=fieldtype><?php echo esc_html( RGFormsModel::get_input_type( $field ) ); ?></td>
				<td class=fieldid><?php echo esc_html( $field['id'] ); ?></td>
			</tr>
			<?php
			if ( isset( $field['choices'] ) && is_array( $field['choices'] ) && ! isset( $field['inputs'] ) ) {
				$num_choices = count( $field['choices'] );
				for ( $i = 0;$i < $num_choices;$i++ ) {
					$choices_id = $i + 1;
					?>
					<tr class='choice'>	
						<td class=fieldlabel><?php echo esc_html( $field['choices'][ $i ]['text'] ); ?></td>
						<td class=adminlabel><?php echo esc_html( $field['choices'][ $i ]['value'] ); ?></td>
						<td class=mergetag>{<?php echo esc_html( $field['choices'][ $i ]['text'] . ':' . $field['id'] . '.' . $choices_id ); ?>}</td>
						<td class=mergetagadmin>{<?php echo esc_html( $field['choices'][ $i ]['value'] . ':' . $field['id'] . '.' . $choices_id ); ?>}</td>
						<td class=mergtagshort>{:<?php echo esc_html( $field['id'] . '.' . $choices_id ); ?>}</td>
						<td class=populate></td>
						<td class=css></td>
						<td class=fieldtype><?php echo esc_html( RGFormsModel::get_input_type( $field ) . '-choice' ); ?></td>
						<td class=fieldid><?php echo esc_html( $field['id'] . '.' . $choices_id ); ?></td>
					</tr>
					<?php
				}
			}

			if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {
				$num_inputs = count( $field['inputs'] );
				for ( $i = 0;$i < $num_inputs;$i++ ) {
					if ( ! empty( $field['inputs'][ $i ]['name'] ) ) {
						$pre_fill_url       .= $field['inputs'][ $i ]['name'] . '=MERGETAG&';
						$pre_fill_url_excel .= $field['inputs'][ $i ]['name'] . '="&ENCODEURL(CELL)&"&';
					}
					$inputs_id = $i + 1;
					?>
					<tr class='input'>	
						<td class=fieldlabel><?php echo isset( $field['inputs'][ $i ]['customLabel'] ) ? esc_html( $field['inputs'][ $i ]['customLabel'] ) : esc_html( $field['inputs'][ $i ]['label'] ); ?></td>
						<td class=adminlabel><?php echo esc_html( $field['inputs'][ $i ]['label'] ); ?></td>
						<td class=mergetag>{
						<?php
						echo isset( $field['inputs'][ $i ]['customLabel'] ) ? esc_html( $field['inputs'][ $i ]['customLabel'] ) : esc_html( $field['inputs'][ $i ]['label'] );
						echo esc_html( ':' . $field['inputs'][ $i ]['id'] );
						?>
						}</td>
						<td class=mergetagadmin>{<?php echo esc_html( $field['inputs'][ $i ]['label'] . ':' . $field['inputs'][ $i ]['id'] ); ?>}</td>
						<td class=mergtagshort>{:<?php echo esc_html( $field['inputs'][ $i ]['id'] ); ?>}</td>
						<td class=populate><?php echo isset( $field['inputs'][ $i ]['name'] ) ? esc_html( $field['inputs'][ $i ]['name'] ) : ''; ?></td>
						<td class=css></td>
						<td class=fieldtype><?php echo esc_html( RGFormsModel::get_input_type( $field ) . '-input' ); ?></td>
						<td class=fieldid><?php echo esc_html( $field['inputs'][ $i ]['id'] ); ?></td>
					</tr>
					<?php
				}
			}
		}
	}
	?>
	</tbody>
</table>
