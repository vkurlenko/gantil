<?php
/**
 * Organize Media Library by Folders
 * 
 * @package    Organize Media Library
 * @subpackage OrganizeMediaLibraryRegist registered in the database
/*  Copyright (c) 2015- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

class OrganizeMediaLibraryRegist {


	/* ==================================================
	 * Settings Upload folder constant
	 * @since	6.01
	 */
	function upload_folder_constant() {

		include_once ORGANIZEMEDIALIBRARY_PLUGIN_BASE_DIR.'/inc/OrganizeMediaLibrary.php';
		$organizemedialibrary = new OrganizeMediaLibrary();
		list($upload_dir, $upload_url, $upload_path) = $organizemedialibrary->upload_dir_url_path();
		define("ORGANIZEMEDIALIBRARY_PLUGIN_UPLOAD_DIR", $upload_dir);
		define("ORGANIZEMEDIALIBRARY_PLUGIN_UPLOAD_URL", $upload_url);
		define("ORGANIZEMEDIALIBRARY_PLUGIN_UPLOAD_PATH", $upload_path);
		$dirs = $organizemedialibrary->scan_dir(ORGANIZEMEDIALIBRARY_PLUGIN_UPLOAD_DIR);
		define("ORGANIZEMEDIALIBRARY_DIRS", json_encode($dirs));
		unset($organizemedialibrary ,$upload_dir, $upload_url, $upload_path, $dirs);

	}

	/* ==================================================
	 * Settings register
	 * @since	1.0
	 */
	function register_settings(){

		if( strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && get_locale() === 'ja' ) { // Japanese Windows
			$character_code = 'CP932';
		} else {
			$character_code = 'UTF-8';
		}

		$user = wp_get_current_user();
		$userid = $user->ID;
		$wp_options_name = 'organizemedialibrary_settings'.'_'.$userid;

		if ( !get_option($wp_options_name) ) {
			if ( get_option('organizemedialibrary_settings') ) { // old settings
				$organizemedialibrary_settings = get_option('organizemedialibrary_settings');
				if ( array_key_exists( "character_code", $organizemedialibrary_settings ) ) {
					$character_code = $organizemedialibrary_settings['character_code'];
				}
				delete_option( 'organizemedialibrary_settings' );
			}
		} else {
			$organizemedialibrary_settings = get_option($wp_options_name);
			if ( array_key_exists( "character_code", $organizemedialibrary_settings ) ) {
				$character_code = $organizemedialibrary_settings['character_code'];
			}
		}
		$organizemedialibrary_tbl = array(
						'character_code' => $character_code
					);
		update_option( $wp_options_name, $organizemedialibrary_tbl );

	}

	/* ==================================================
	 * Register Taxonomy
	 * @since	6.0
	 */
	function media_folder_taxonomies() {

		$args = array(
			'hierarchical'			=> false,
			'label'					=> __('Folder', 'organize-media-library'),
			'show_ui'				=> false,
			'show_admin_column'		=> false,
			'update_count_callback'	=> '_update_generic_term_count',
			'query_var'				=> true,
			'rewrite'				=> true
		);

		register_taxonomy( 'media_folder', 'attachment', $args);

	}

	/* ==================================================
	 * Register Media Folder Term
	 * @since	6.0
	 */
	function media_folder_term() {

		$user = wp_get_current_user();
		$userid = $user->ID;
		$wp_options_name = 'organizemedialibrary_settings'.'_'.$userid;
		$organizemedialibrary_settings = get_option($wp_options_name);
		$character_code = $organizemedialibrary_settings['character_code'];

		include_once ORGANIZEMEDIALIBRARY_PLUGIN_BASE_DIR.'/inc/OrganizeMediaLibrary.php';
		$organizemedialibrary = new OrganizeMediaLibrary();

		$dirs = json_decode(ORGANIZEMEDIALIBRARY_DIRS,true);
		$wordpress_path = wp_normalize_path(ABSPATH);
		foreach ($dirs as $linkdir) {
			if ( strstr($linkdir, $wordpress_path ) ) {
				$linkdirenc = $organizemedialibrary->mb_utf8(str_replace($wordpress_path, '', $linkdir), $character_code);
				$linkdirenc = str_replace(ORGANIZEMEDIALIBRARY_PLUGIN_UPLOAD_PATH, '', $linkdirenc);
			} else {
				$linkdirenc = $organizemedialibrary->mb_utf8(str_replace(ORGANIZEMEDIALIBRARY_PLUGIN_UPLOAD_DIR, "", $linkdir), $character_code);
			}
			if ( !term_exists($linkdirenc, 'media_folder') ) {
				wp_insert_term( $linkdirenc, 'media_folder' );
			}
		}
		unset($organizemedialibrary);
		if ( !term_exists('/', 'media_folder') ) {
			wp_insert_term( '/', 'media_folder' );
		}

		delete_option("media_folder_children");

		global $wpdb;
		$attachments = $wpdb->get_results("
						SELECT	post_id, meta_value
						FROM	$wpdb->postmeta
						WHERE	meta_key = '_wp_attached_file'
						");
		foreach ( $attachments as $attachment ) {
			$filename = wp_basename($attachment->meta_value);
			$foldername = '/'.untrailingslashit(str_replace($filename, '', $attachment->meta_value));
			$terms = $wpdb->get_results($wpdb->prepare("
							SELECT	term_id
							FROM	$wpdb->terms
							WHERE	name = %s
							",$foldername
							),ARRAY_A);
			if ( $terms ) {
				$term_taxonomy_ids = wp_set_object_terms( intval($attachment->post_id), intval($terms[0]['term_id']), 'media_folder' );
				if ( is_wp_error( $term_taxonomy_ids ) ) {
				} else {
				}
			}
		}

	}

}

?>