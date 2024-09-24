=== GravityWP - Merge Tags ===
Contributors: GravityWP
Plugin URI: https://gravitywp.com/add-on/merge-tags/
Tags: gravity forms, mergetag, merge tag, mergetags, form, forms, gravity form
Requires at least: 3.0.1
Tested up to: 6.4
Stable tag: 1.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds an admin page to show the merge tags and form information of a specific Gravity Form. 

== Description ==
The documentation for GravityWP - Merge Tags is available on [GravityWP.com](https://gravitywp.com/docs/merge-tags/). 

This Gravity Forms Add-on adds an admin page to your WordPress back-end with a list of all the merge tags in your form. Besides that it gives you information (in different tabs) about field types (for example text, radio, hidden, select, email, checkbox, etc), Standard (Meta) Gravity Forms Merge Tags (and Merge Tags from GravityView and Gravity Flow), a replacement for the all_fields Merge Tag (with or without fileuploads) and Gravity Flow Step information. 

So... no more clicking on a dropdown to select the Merge Tag you need, but just copy and paste it from the list. And have a quick overview of all relevant information available for every specific Gravity Form on your site, copy it to Excel and use it in a way that suits your needs. 

The plugin adds a link in the toolbar above the Gravity Form you're working on and a menu link in de Forms submenu. 

== Installation ==

Upload the plugin files to the `/wp-content/plugins/gravitywp-merge-tags` directory, or install the plugin through the WordPress plugins screen directly.

== Frequently Asked Questions ==

= Where can I find the Merge Tags list =
You can click on 'Merge Tags' in the Toolbar above the Gravity Form you're working on. Or you can click on 'Merge Tags' in the Forms submenu. 

= What Gravity Form information is available? =
The plugin provides you with several tabs with information about a specific Gravity Form.

* **Merge Tags**: A simple list of Merge Tags available in the Gravity Form. 
* **Advanced**: Field Label, Merge Tag, Short Merge Tag, Field Type. 
* **Dynamic Population**: Query string templates.
* **Conditional Logic**: An overview of all conditional logic rules in the form.
* **Calculations**: An overview of all calculations in the form.
* **Meta**: Available Standard (default) Merge Tags from Gravity Forms, GravityView and Gravity Flow. 
* **Workflow**:  If you're using Gravity Flow, you'll have an extra tab with information about the Gravity Flow Steps that are configured within your Gravity Form. It provides information about the Step Name, the ID, the Type, if the step is active or not, what conditions are set and an automatically generated GravityWP - Count Shortcode to use as a counter for Gravity Flow steps. 
* **All Fields**: An alternative for the all_fields Merge Tag, which you can modify and customize. Option to select a table with or without fileuploads. 

= How can I add merge tags of my own plugin to the Merge Tags Meta tab? =

By using the 'gwp_merge_tags_meta_merge_tags' filter, for example:

`add_filter( 'gwp_merge_tags_meta_merge_tags', 'my_plugin', 10, 1 );
function my_plugin( $gwp_merge_tags ) {
	$gwp_merge_tags['my_plugin']['name']   = 'My custom table';
	$gwp_merge_tags['my_plugin']['url']    = 'https://gravitywp.com';
	$gwp_merge_tags['my_plugin']['values'] = array(
		'merge_tag_1',
		'merge_tag_2',
	);
	return $gwp_merge_tags;
}`

The $gwp_merge_tags variable is an associative array, which you can add your own merge tags to. 
`$gwp_merge_tags['key']` a unique key for your plugin.
`$gwp_merge_tags['key']['name']` contains the title for the table header.
`$gwp_merge_tags['key']['url']` URL for the plugin website.
`$gwp_merge_tags['key']['values']` an array with merge tags.


== Screenshots ==

1. List of Merge Tags in your current Gravity Form.
2. Advanced Merge Tags (label, merge tag, short merge tag, field type like text, radio, hidden, checkbox, select, etc).
3. List of Standard Merge Tags (Gravity Forms, GravityView, Gravity Flow).
4. All Fields Tab. You can replace the all_fields merge tag with this and have full control what is shown. 
5. The menu link that gets added in the Gravity Form toolbar.
6. The menu link under Forms (admin menu).
7. Gravity Flow Step information for the current Gravity Form (Step name, ID, Type, Active, Conditions)
8. Conditional Logic information for the current Gravity Form (Show or Hide / Match All or Any / Rules). Both and overview which fields have active Conditional Logic rules and which fields are used inside Conditional Logic rules. 
9. Calculations overview for the current Gravity Form (Formula, Number Format).

== Changelog ==
= 1.3 =
* Added tab for Calculations.
* Added tab for Dynamic Population.
* Added and fixed translations.
* Added Gravity Forms conditional shortcode to All Fields tab.
* Added GravityView gvlogic shortcode  to All Fields tab.
* Added sub-input fields to Advanced tab.

= 1.2 =
* Added filter for Meta tab.
* Added quick links to Merge Tags in top admin menu for recent forms.
* Added {today} merge tag to standard Merge Tags tab.
* Fix url query string excel formula template.
* Include ENCODEURL in excel formula template + localized version.
* Minor type fixes and code quality improvements.
* Updated Gravity View Merge Tags list for Meta tab.

= 1.1.4 =
* Added Conditional Logic tab.

= 1.1.3 =
* Advanced tab: Fixed output historical values for deactivated dynamic population.

= 1.1.2 =
* Fix all fields table merge tags (remove spaces).
* Fix some PHP notices.
* Added GravityWP Advanced Merge Tags modifiers.

= 1.1.1 =
* Workflow tab: displays labels of workflow conditions
* Updated the Gravity Forms merge tag section with the changed payment merge tags and some new merge tags.

= 1.1 =
* Compatibility with Gravity Forms 2.5 User Interface
* Merged Admin tab into Advanced tab
* Advanced tab: Improved UI with options to toggle columns
* Advanced tab: Optionally include display only fields like section and html
* Advanced tab: Optionally include Merge Tags for radio / checkboc choices  
* Added a link to our (premium) Advanced Merge Tag plugin
* Security enhancements
* Various small changes / fixes

= 1.0.3 =
* Added default Gravity Forms editor menu
* Fix HTML error on first page
* Added column for Gravity Flow Step conditions
* Added dynamic population query urls templates


= 1.0.2 =
* Improved table layout (to wp-list-table widefat striped)
* Rearrange tabs (information about forms merge tags first, than standard merge tags)
* Renamed tabs (shorter descriptions, more focussed)

= 1.0.1 =
* Updated capabilities to give everyone with 'gravityforms_edit_forms' capability the possibility to see the Merge Tag page (thank you @siwax)

= 1.0 =
* Solved the link from the form menu to the Merge Tag page giving errors
* Tested the plugin with many testers. Ready for version 1.0

= 0.9 =
* Added the 'Admin' tab, with an overview of Admin Labels, Dynamic Population, CSS and Field Type in one overview. Ideal if you want to quickly see what CSS is used per field or what text you should use when generating an url with arguments (populate)
* Made the code more readable, added comments

= 0.8 =
* Removed code that added specific extra merge tags because of problems after updating to GF version 2.3

= 0.7 =
* Added a tab for Gravity Flow (when active) to show a table with Gravity Flow Step, Step ID, Step Type, Step Active and GravityWP - Count shortcode in combination with Gravity Flow

= 0.6 =
* Changed tabs layout to make it more convenient to copy and paste to Excel
* First tab with only Merge Tags from the current form
* Second tab (advanced) with more detailed information about the field: Label, Merge Tag, Short Merge Tag, Field Input Type
* Third tab with Standard Gravity Forms Merge Tags
* New tab (All Fields) to replace the allfields Merge Tag from Gravity Forms. It generates a table you can copy and paste and a table without fileuploads (in case you don't want to communicate links to files)

= 0.5 =
* Added Tabs 
* Styled the lists
* Added overview of Field Labels
* Added overview of Field Types
* Removed the shortcode for generating the Merge Tags list
* Added text-domain for translations

= 0.4 =
* Added Gravity Forms standard Merge Tags
* Added GravityView specific Merge Tags
* Added Gravity Flow specific Merge Tags

= 0.3 =
* Added admin page with all the merge tags of a specific form
* Added menu links in the sidebar and in the Gravity Forms toolbar

= 0.2 =
* Added check if Gravity Forms is installed
* Return instead of echo, so the list will be placed in the right place on the page

= 0.1 =
* First launch of the shortcode to show all merge tags