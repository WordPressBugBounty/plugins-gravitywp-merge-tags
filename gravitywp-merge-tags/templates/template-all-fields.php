<?php class_exists( 'GFForms' ) || die(); ?>

<style>table.fixed { table-layout: auto;  }</style>
<p></p>
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
			<td><?php esc_html_e( 'Replace All Fields Merge Tag', 'gravitywp-merge-tags' ); ?></td>
			<td>
			<?php echo esc_html( '<table><tbody>' ); ?><br>
			<?php

			if ( is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

						foreach ( $field['inputs'] as $input ) {
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>' );
							?>
							<br>
							<?php
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
						echo esc_html( "<tr><td class='gwp-allfields-label'>" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( '</td>' );
						echo esc_html( "<td class='gwp-allfields-value'>{" );
						echo esc_html( GFCommon::get_label( $field ) );
						echo esc_html( ':' );
						echo esc_html( $field['id'] );
						echo esc_html( '}</td></tr>' );
						?>
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
			<td><?php esc_html_e( 'Replace All Fields Merge Tag with Gravity Forms shortcode', 'gravitywp-merge-tags' ); ?></td>
			<td>
			<?php echo esc_html( '<table><tbody>' ); ?><br>
			<?php

			if ( is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

						foreach ( $field['inputs'] as $input ) {
							$mergetag = "{{$field['label']}:{$field['id']}}";
							echo esc_html( '[gravityforms action="conditional" merge_tag="' . $mergetag . '" condition="isnot" value=""]' );
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>[/gravityforms]' );
							?>
							<br>
							<?php
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
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

		<?php if ( class_exists( 'GravityView_Plugin' ) ) { ?>

		<tr>
			<td><?php esc_html_e( 'Replace All Fields Merge Tag with Gravity View shortcode', 'gravitywp-merge-tags' ); ?></td>
			<td>
			<?php echo esc_html( '<table><tbody>' ); ?><br>
			<?php

			if ( is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

						foreach ( $field['inputs'] as $input ) {
							$mergetag = "{{$field['label']}:{$field['id']}}";
							echo esc_html( '[gvlogic if="' . $mergetag . '" isnot=""]' );
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" . GFCommon::get_label( $field, $input['id'] ) );
							echo esc_html( ':' );
							echo esc_html( $input['id'] );
							echo esc_html( '}</td></tr>[/gvlogic]' );
							?>
							<br>
							<?php
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
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
			<td>
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

			if ( is_array( $form['fields'] ) ) {
				foreach ( $form['fields'] as $field ) {
					if ( isset( $field['inputs'] ) && is_array( $field['inputs'] ) ) {

						foreach ( $field['inputs'] as $input ) {
							if ( RGFormsModel::get_input_type( $field ) !== 'fileupload' ) {
								echo esc_html( "<tr><td class='gwp-allfields-label'>" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
								echo esc_html( "</td><td class='gwp-allfields-value'>{" );
								echo esc_html( GFCommon::get_label( $field, $input['id'] ) );
								echo esc_html( ':' );
								echo esc_html( $input['id'] );
								echo esc_html( '}</td></tr>' );
								?>
								<br>
								<?php
							}
						}
					} elseif ( ! rgar( $field, 'displayOnly' ) ) {
						if ( RGFormsModel::get_input_type( $field ) !== 'fileupload' ) {
							echo esc_html( "<tr><td class='gwp-allfields-label'>" );
							echo esc_html( GFCommon::get_label( $field ) );
							echo esc_html( "</td><td class='gwp-allfields-value'>{" );
							echo esc_html( GFCommon::get_label( $field ) );
							echo esc_html( ':' );
							echo esc_html( $field['id'] );
							echo esc_html( '}</td></tr>' );
							?>
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

