<?php

// Prevent direct access.
class_exists( 'GFForms' ) || die();

GFForms::include_addon_framework();


/**
 * GWPMergeTags.
 *
 * @author GravityWP
 * @since v0.0.1
 * @version v1.0.0
 * @see GFAddOn
 *
 * @global
 */
class GWPMergeTags extends GFAddOn {

	/**
	 * @var string $_version
	 */
	protected $_version = GWP_MERGETAGS_VERSION;
	/**
	 * @var string $_min_gravityforms_version
	 */
	protected $_min_gravityforms_version = '1.9';

	/**
	 * @var string $_slug
	 */
	protected $_slug = 'gravitywp-merge-tags';
	/**
	 * @var string $_path
	 */
	protected $_path = 'gravitywp-merge-tags/gravitywp-merge-tags.php';
	/**
	 * @var string $_full_path
	 */
	protected $_full_path = __FILE__;
	/**
	 * @var string $_title
	 */
	protected $_title = 'Merge Tags';
	/**
	 * @var string $_short_title
	 */
	protected $_short_title = 'Merge Tags';

	/**
	 * @var GWPMergeTags $_instance
	 */
	private static $_instance = null;

	/**
	 * Function: __construct.
	 *
	 * @author GravityWP
	 * @since v0.0.1
	 * @version v1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		$this->_capabilities_plugin_page   = 'gravityforms_edit_forms';
		$this->_capabilities_settings_page = 'gravityforms_edit_settings';
		parent::__construct();
	}

	/**
	 * Override this function to perform tasks during WordPress initialization.
	 * 
	 * @return void
	 */
	public function init() {
		parent::init();
		add_filter('wp_before_admin_bar_render', [__CLASS__, 'admin_bar'], 20);

		// Enqueue GP Live Preview plugin styles on Merge Tags page of a form.
		if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === 'gravitywp-merge-tags' && isset( $_GET[ 'id' ] ) )  {
		
			if ( class_exists( 'GP_Live_Preview' ) ) {
				wp_enqueue_style( 'gp-live-preview-admin', plugins_url( '../gp-live-preview/css/gp-live-preview-admin.min.css', __FILE__ ), array(), $this->_version );
				wp_enqueue_script( 'gp-live-preview-admin', plugins_url( '../gp-live-preview/js/gp-live-preview-admin.js', __FILE__ ), array( 'jquery' ), $this->_version, true );
			}
		}
	}

	/**
	 * Get an instance of this class.
	 *
	 * @return GWPMergeTags
	 */
	public static function get_instance() {
		if ( self::$_instance === null ) {
			self::$_instance = new GWPMergeTags();
		}

		return self::$_instance;
	}

	/**
	 * Function: scripts.
	 *
	 * @author GravityWP
	 * @since v0.0.1
	 * @version v1.0.0
	 * @access public
	 *
	 * @return array<mixed>
	 */
	public function scripts() {
		return array_merge(
			parent::scripts(),
			array(
				array(
					'handle'  => 'gform_form_admin',
					'enqueue' => array( array( 'admin_page' => array( 'plugin_page' ) ) ),
				),
				array(
					'handle'  => 'gform_gravityforms',
					'enqueue' => array( array( 'admin_page' => array( 'plugin_page' ) ) ),
				),
			)
		);
	}

	/**
	 * Plugin page container
	 * Target of the plugin menu left nav icon. Displays the outer plugin page markup and calls plugin_page() to render the actual page.
	 * Override plugin_page() in order to provide a custom plugin page
	 *
	 * @author GravityWP
	 * @since v0.0.1
	 * @version v1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function plugin_page_container() {

		if ( ! version_compare( GFCommon::$version, '2.5', '<' ) ) {
			?>
			<div class="wrap">
				<?php
				$icon = $this->plugin_page_icon();
				if ( ! empty( $icon ) ) {
					?>
					<img alt="<?php echo esc_attr( $this->get_short_title() ); ?>" style="margin: 15px 7px 0pt 0pt; float: left;" src="<?php echo esc_attr( $icon ); ?>" />
					<?php
				}
				?>

					<header class="gform-settings-header" style="background-color: #66abcc50; ">
						<div class="gform-settings__wrapper" style="background: url(<?php echo esc_attr( plugin_dir_url( __FILE__ ) ); ?>assets/img/gwp_astronaut2.svg) no-repeat bottom right; height: 40px; padding: 1.375rem; ">
							<a href="https://gravitywp.com" target=_blank title='Do you love our Merge Tags plugin? Visit gravitywp.com for more!'><img src="<?php echo esc_attr( plugin_dir_url( __FILE__ ) ); ?>assets/img/gravitywp-logo.svg" alt="GravityWP" width="140"/></a>
						</div>
					</header>

				<?php

				$this->plugin_page();
				?>

			</div>
			<?php
		} else {
			parent::plugin_page_container();
		}
	}

	// # ADMIN FUNCTIONS -----------------------------------------------------------------------------------------------

	/**
	 * Modifies the top WordPress toolbar to add Gravity Forms menu items.
	 *
	 * @since   Unknown
	 *
	 * @global $wp_admin_bar
	 *
	 * @used-by GFForms::init()
	 * 
	 * @return void
	 */
	public static function admin_bar( ) {
		/**
		 * @var  WP_Admin_Bar $wp_admin_bar
		 */
		global $wp_admin_bar;

		$recent_form_ids = GFFormsModel::get_recent_forms();

		if ( $recent_form_ids ) {
			$forms = GFFormsModel::get_form_meta_by_id( $recent_form_ids );

			foreach ( $recent_form_ids as $recent_form_id ) {

				if ( GFCommon::current_user_can_any( 'gravityforms_edit_forms' ) ) {
					$wp_admin_bar->add_node(
						array(
							'id'     => 'gform-form-' . $recent_form_id . '-mergetags',
							'parent' => 'gform-form-' . $recent_form_id,
							'title'  => esc_html__( 'Merge Tags', 'gravityforms' ),
							'href'   => admin_url( 'admin.php?page=gravitywp-merge-tags&tab=merge-tags&id=' . $recent_form_id ),
						)
					);
				}
			}
		}
	}
	
	/**
	 * Creates a custom admin page for GravityWP - Merge Tags
	 *
	 * @author GravityWP
	 * @since v0.0.1
	 * @version v1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function plugin_page() {

		if ( isset( $_GET['id'] ) && ! empty( absint( $_GET['id'] ) ) ) {
			// Include gforms admin styles.
			wp_print_styles( array( 'jquery-ui-styles', 'gform_admin', 'gform_settings', 'wp-pointer' ) );
			echo '<style>table.wp-list-table { margin-bottom: 10px;  }</style>';

			$active_tab = isset( $_GET['tab'] ) ? wp_unslash( $_GET['tab'] ) : 'merge-tags';
			$form       = RGFormsModel::get_form_meta( absint( $_GET['id'] ) );

			/**
			 * Function: gwp_create_menu_item.
			 *
			 * @author GravityWP
			 * @since v0.0.1
			 * @version v1.0.0
			 * @param string $slug
			 * @param string $title
			 *
			 * @return void
			 */
			function gwp_create_menu_item( $slug, $title ) {
				$url    = 'href=?page=gravitywp-merge-tags&id=' . absint( $_GET['id'] );
				$active = '';
				if ( isset( $_GET['tab'] ) && $_GET['tab'] === $slug ) {
					$active = ' nav-tab-active';
				}
				echo '<a ' . esc_attr( $url ) . '&tab=' . esc_attr( $slug ) . ' class="nav-tab' . esc_attr( $active );
				echo '">' . esc_html( $title ) . '</a>';
			}

			// Add selectable form title for GF 2.4 and lower.
			if ( version_compare( GFCommon::$version, '2.5', '<' ) ) {
				GFCommon::form_page_title( GFAPI::get_form( absint( $_GET['id'] ) ) );
			}

			// Add top toolbar.
			GFForms::top_toolbar();

			// Start wrapper
			echo '<div class="gwp-wrapper-full" style="margin: 0 1.25rem 0;">';

			// Create menu.
			echo '<h2 style="padding-left: 10px;">' . esc_html( $form['title'] ) . '</h2><h2 class="nav-tab-wrapper">';

			// Create menu items.
			$var_merge_tags = esc_html__( 'Merge Tags', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'merge-tags', $var_merge_tags );

			$var_merge_tags_advanced = esc_html__( 'Advanced', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'merge-tags-advanced', $var_merge_tags_advanced );

			$var_dynamic_population = esc_html__( 'Dynamic Population', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'dynamic-population', $var_dynamic_population );

			$var_conditional_logic = esc_html__( 'Conditional Logic', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'conditional-logic', $var_conditional_logic );

			$var_calculations = esc_html__( 'Calculations', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'calculations', $var_calculations );

			$var_merge_tags_standard = esc_html__( 'Meta', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'standard-merge-tags', $var_merge_tags_standard );

			if ( class_exists( 'Gravity_Flow_API' ) ) {
				$var_merge_tags_gravity_flow = esc_html__( 'Workflow', 'gravitywp-merge-tags' );
				gwp_create_menu_item( 'gravity-flow', $var_merge_tags_gravity_flow );
			}

			$var_merge_tags_all_fields = esc_html__( 'All Fields', 'gravitywp-merge-tags' );
			gwp_create_menu_item( 'all-fields', $var_merge_tags_all_fields );

			echo '</h2><div style="padding: 7px;">';

			// Create Tabs
			$fields = array();

			$template = $this->get_base_path() . '/templates/template-' . $active_tab . '.php';
			file_exists( $template ) ? include $template : esc_html_e( 'Template not found.', 'gravitywp-merge-tags' );

			// Advanced mergetags Teaser.
			if ( ! defined( 'GWP_ADVANCED_MERGE_TAGS_VERSION' ) ) {
				echo '<div class=teaser style="background: #ddecf5; border: 1px solid #65a9cc; max-width:400px;margin-left:auto;"><div class=teaser-text style="width: 60%; padding: 20px 5%; text-align: left; float: left;">
			<h2 style="margin-top:0;">Advanced Merge Tags</h2>
			Add Advanced Merge Tags & Modifiers to your Gravity Forms, Views and Flows. <br><br>
			<span>Discount Coupon:</span>
			<span style="background:#eee;padding: 5px 10px;border: 1px solid;">GWPMERGETAGS</span><br><br>
			<a href="https://gravitywp.com/add-ons/advanced-merge-tags/?utm_source=merge-tags-plugin-page&utm_medium=display&utm_campaign=pre-release" target=_blank style="margin-top:5px;">Get Advanced Merge Tags</a></div>
			<div class=teaser-image style="width: 20%; float: left; padding-top: 20px;">
			<img src="' . esc_attr( plugin_dir_url( __FILE__ ) ) . 'assets/img/gwp_astronaut.svg" alt="GravityWP" width="80"/></div>
			<div class="clear"></div>
			</div>';
			}

			// End wrapper
			echo '</div>';

		} else {
			$forms = RGFormsModel::get_forms( null, 'title' );
			echo "<table class='wp-list-table widefat striped'' cellspacing='0'><thead><tr><th>" .
				esc_html__( 'Select Form', 'gravitywp-merge-tags' )
				. '</th></tr></thead><tbody>';

			foreach ( $forms as $form ) :
				echo '<tr><td>
                    <a href="' . esc_attr( $_SERVER['REQUEST_URI'] ) . '&id=' . esc_attr( $form->id ) . '"&tab=merge-tags target=_self>' . esc_attr( $form->title ) .
					'</a></td></tr>';
				endforeach;
			echo '</tbody></table>';

		}
	}
}
