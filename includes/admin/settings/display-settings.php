<?php
/**
 * Admin Options Page
 *
 * @package     MYC
 * @subpackage  Admin/Settings
 * @copyright   Copyright (c) 2017, Daniel Powney
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Options Page
 *
 * Renders the options page contents.
 *
 * @since 1.0
 * @return void
 */
function myc_options_page() {
	?>
	<div class="wrap">
		
		<h2 class="nav-tab-wrapper">
			<?php
			$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'myc_general_settings';
			$tabs = array (
					'myc_general_settings'		=> __( 'General', 'my-chatbot' )
			);
			
			$tabs = apply_filters( 'myc_settings_tabs', $tabs );
			
			foreach ( $tabs as $tab_key => $tab_caption ) {
				$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
				echo '<a class="nav-tab ' . $active . '" href="options-general.php?page=my-chatbot&tab=' . $tab_key . '">' . $tab_caption . '</a>';
			}
			?>
		</h2>
		
		<?php
		if ( isset( $_GET['updated'] ) && isset( $_GET['page'] ) ) {
			add_settings_error( 'general', 'settings_updated', __( 'Settings saved.', 'my-chatbot' ), 'updated' );
		}
				
		settings_errors();
		
		if ( $current_tab == 'myc_general_settings' ) {
			?>
			<form method="post" name="myc_general_settings" action="options.php">
				<?php
				wp_nonce_field( 'update-options' );
				settings_fields( 'myc_general_settings' );
				do_settings_sections( 'my-chatbot' );
				submit_button(null, 'primary', 'submit', true, null);
				?>
			</form>
			<?php
		}
		
		?>
	</div>
	<?php
}

/**
 * General settings section
 */
function myc_section_general_desc() {

}

/**
 * Field input setting
 */
function field_input( $args ) {
	$settings = (array) get_option( $args['option_name' ] );
	?>
	<input class="regular-text" type="text" name="<?php echo $args['option_name']; ?>[<?php echo $args['setting_id']; ?>]" value="<?php echo $settings[$args['setting_id']]; ?>" />
	<label><?php echo $args['label']; ?></label>
	<?php 
}