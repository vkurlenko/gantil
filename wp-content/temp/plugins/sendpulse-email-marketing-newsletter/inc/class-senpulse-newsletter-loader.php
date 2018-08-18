<?php

/**
 * Loader plugin class.
 *
 * Class Send_Pulse_Newsletter_Loader
 */
class Send_Pulse_Newsletter_Loader {

	/**
	 * @var string Plugin version
	 */
	private $version = '2.0.1';

	/**
	 * @var string Plugin url. Useful for enqueue assets.
	 */
	private $plugin_url;

	/**
	 * @var string Plugin relative patch.
     *
	 */

	private $plugin_rel_patch;


	/**
	 * Send_Pulse_Newsletter constructor.
	 *
	 * @var $plugin_url string
	 * @var $plugin_rel_patch string
	 *
	 */
	public function __construct( $plugin_url, $plugin_rel_patch) {

		$this->plugin_url = $plugin_url;

		$this->plugin_rel_patch = $plugin_rel_patch;

		add_action( 'plugins_loaded', [$this, 'load_textdomain' ] );

		$this->inc();

		add_action( 'admin_enqueue_scripts', [ $this, 'admin_assets' ] );

	}

	/**
	 * Include libraries and additional class.
	 */
	protected function inc() {

		include_once ( 'class-senpulse-newsletter-forms.php');

		include_once( 'class-sendpulse-newsletter-api.php' );
		include_once( 'class-sendpulse-newsletter-settings.php' );
		include_once( 'class-senpulse-newsletter-shortcodes.php' );
		include_once( 'class-sendpulse-newsletter-ajax.php' );
		include_once( 'class-sendpulse-newsletter-users.php' );

	}


	public function admin_assets() {
		$prefix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG )? '' : '.min';

		wp_enqueue_style('sp-admin-style', $this->plugin_url . "assets/css/admin{$prefix}.css", [], $this->version );

		wp_enqueue_script('sp-admin-script', $this->plugin_url . "assets/js/admin{$prefix}.js", ['jquery'], $this->version, true);

		$data = array(
			'ajax_url' 		    => admin_url( 'admin-ajax.php' )
		);

		wp_localize_script( 'sp-admin-script', 'sp_admin_params', $data );

	}

	function load_textdomain() {
		load_plugin_textdomain( 'sendpulse-email-marketing-newsletter', FALSE, $this->plugin_rel_patch );
	}

}