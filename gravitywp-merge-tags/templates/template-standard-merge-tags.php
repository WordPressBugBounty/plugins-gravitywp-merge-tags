<?php

class_exists( 'GFForms' ) || die();

$gwp_merge_tags = array();

$gwp_merge_tags['gravity_forms_merge_tags']['name']   = 'Gravity Forms Merge Tags';
$gwp_merge_tags['gravity_forms_merge_tags']['url']    = '';
$gwp_merge_tags['gravity_forms_merge_tags']['values'] = array(
	'all_fields',
	'all_fields:admin',
	'all_fields:value',
	'all_fields:empty',
	'all_fields:noadmin',
	'all_fields:nohidden',
	'entry_id',
	'entry:id',
	'entry:created_by',
	'entry:date_created',
	'entry:currency',
	'entry:payment_status',
	'entry:payment_date',
	'entry:payment_amount',
	'entry:transaction_id',
	'entry_url',
	'form_title',
	'date_mdy',
	'date_dmy',
	'embed_url',
	'ip',
	'user_agent',
	'referer',
	'admin_email',
	'approval_status',
	'is_fulfilled',
	'date_created',
	'date_created:time',
	'date_updated',
	'date_updated:time',
	'payment_date',
	'payment_date:time',
	'payment_action:type',
	'payment_action:amount',
	'payment_action:amount_formatted',
	'payment_action:transaction_type',
	'payment_action:transaction_id',
	'payment_action:subscription_id',
	'payment_action:entry_id',
	'payment_action:payment_status',
	'payment_action:note',
	'payment_action:type',
	'today',
	'today:time',
	'today:format:Y-m-d',
	'today:timestamp',
	'user:display_name',
	'user:user_email',
	'user:user_login',
	'user:[meta_key]',
);

$gwp_merge_tags['gravity_view_merge_tags']['name']   = 'Gravity View';
$gwp_merge_tags['gravity_view_merge_tags']['url']    = 'https://gravitykit.com/?ref=115';
$gwp_merge_tags['gravity_view_merge_tags']['values'] = array(
	'get',
	'approval_status',
	'approval_status:label',
	'approval_status:value',
	'date_created',
	'date_created:time',
	'date_created:format:m/d/Y',
	'date_created:format:m/d/Y\ \a\t\ H\:i\:s',
	'date_created:human',
	'date_created:human:time',
	'date_created:diff',
	'date_created:diff:format:I submitted %s in the past',
	'created_by',
	'created_by:ID',
	'current_post',
	'current_post:ID',
	'current_post:title',
	'current_post:post_type',
	'current_post:permalink',
	'sequence',
	'sequence start=[number]',
	'sequence reverse',
	'sequence reverse start=[number]',
	'is_starred',

);

$gwp_merge_tags['gravity_view_modifiers']['name']   = 'Gravity View Modifiers';
$gwp_merge_tags['gravity_view_modifiers']['url']    = 'https://gravitykit.com/?ref=115';
$gwp_merge_tags['gravity_view_modifiers']['values'] = array(
	':esc_html',
	':sanitize_title',
	':wpautop',
	':maxwords{number}',
	':timestamp',
);

$gwp_merge_tags['gravity_flow_merge_tags']['name']   = 'Gravity Flow';
$gwp_merge_tags['gravity_flow_merge_tags']['url']    = 'https://gravityflow.io/?ref=2';
$gwp_merge_tags['gravity_flow_merge_tags']['values'] = array(
	'workflow_entry_link',
	'workflow_entry_url',
	'workflow_inbox_link',
	'workflow_inbox_url',
	'workflow_cancel_link',
	'workflow_cancel_url',
	'workflow_note',
	'workflow_timeline',
	'assignees',
	'workflow_approve_link',
	'workflow_approve_url',
	'workflow_reject_token',
);

$gwp_merge_tags['advanced_merge_tags_modifiers']['name']   = 'GravityWP Advanced Merge Tags - Modifiers';
$gwp_merge_tags['advanced_merge_tags_modifiers']['url']    = 'https://gravitywp.com/add-on/advanced-merge-tags/?utm_source=merge-tag-plugin&utm_medium=plugin-ad&utm_campaign=meta-tab-addon-link';
$gwp_merge_tags['advanced_merge_tags_modifiers']['values'] = array(
	':gwp_append',
	':gwp_case',
	':gwp_count_matched_entries',
	':gwp_current_timestamp',
	':gwp_date_created',
	':gwp_date_field',
	':gwp_date_updated',
	':gwp_get_matched_entries_values',
	':gwp_get_matched_entry_value',
	':gwp_length',
	':gwp_parent_slug',
	':gwp_remove_accents',
	':gwp_replace',
	':gwp_reverse',
	':gwp_urlencode',
	':gwp_word_count',
);

$gwp_merge_tags = apply_filters( 'gwp_merge_tags_meta_merge_tags', $gwp_merge_tags )
?>

<p></p>
<div class="inner-wrap" style="column-count: 3;">

<?php foreach ( $gwp_merge_tags as $gwp_merge_tag ) { ?>

<table class='wp-list-table widefat striped gwp_div' cellspacing='0' style="break-inside: avoid-column;">
	<thead>
		<tr>
			<td><a href="<?php echo esc_attr( $gwp_merge_tag['url'] ) ?>" target="_blank">
			<span class="dashicons dashicons-external"></span><?php echo esc_html( $gwp_merge_tag['name'] ); ?></a></td>
		</tr>
	</thead>
	<tbody>
			<?php foreach ( $gwp_merge_tag['values'] as $value ) { ?>
				<tr>
					<td style="position:relative;">
						<?php echo esc_html( $value ); ?>
					</td>
				</tr>
				<?php
			}  ?>
	</tbody>
</table>
	<?php
}
?>

</div>
<div class=clear></div>

