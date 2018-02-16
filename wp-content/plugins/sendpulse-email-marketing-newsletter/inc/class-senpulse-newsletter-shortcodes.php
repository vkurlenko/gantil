<?php

/**
 * Register and render plugins shortcodes
 *
 * Class Send_Pulse_Newsletter_Shortcodes
 */
class Send_Pulse_Newsletter_Shortcodes {

	/**
	 * SP_Shortcodes constructor.
	 */
	public function __construct() {

		add_action('init', [$this, 'init']);
	}

	/**
	 * Init action
	 */
	public function init() {
		add_shortcode( 'sendpulse-form',  [ $this, 'subscribe_form' ]  );
	}

	/**
     * Generate subscribe form shortcode
     *
	 * @return string Subscribe form html.
	 */
	public function subscribe_form( $atts ) {

	    $output = '';

	    if ($atts && isset($atts['id'])) {
	        $post_id = $atts['id'];
		    $output =  get_post_meta($post_id, '_sp_form_code', true);
        }

        return $output;
	}


}

new Send_Pulse_Newsletter_Shortcodes();