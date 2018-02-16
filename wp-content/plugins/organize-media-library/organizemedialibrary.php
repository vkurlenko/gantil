<?php
/*
Plugin Name: Organize Media Library by Folders
Plugin URI: https://wordpress.org/plugins/organize-media-library/
Version: 6.05
Description: Organize Media Library by Folders. URL in the content, replace with the new URL.
Author: Katsushi Kawamori
Author URI: http://riverforest-wp.info/
Text Domain: organize-media-library
Domain Path: /languages
*/

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

	load_plugin_textdomain('organize-media-library');
//	load_plugin_textdomain('organize-media-library', false, basename( dirname( __FILE__ ) ) . '/languages' );

	define("ORGANIZEMEDIALIBRARY_PLUGIN_BASE_FILE", plugin_basename(__FILE__));
	define("ORGANIZEMEDIALIBRARY_PLUGIN_BASE_DIR", dirname(__FILE__));
	define("ORGANIZEMEDIALIBRARY_PLUGIN_URL", plugins_url($path='',$scheme=null).'/organize-media-library');

	require_once( ORGANIZEMEDIALIBRARY_PLUGIN_BASE_DIR.'/req/OrganizeMediaLibraryRegist.php' );
	$organizemedialibraryregist = new OrganizeMediaLibraryRegist();
	add_action( 'admin_init', array($organizemedialibraryregist, 'register_settings') );
	add_action( 'admin_init', array($organizemedialibraryregist, 'upload_folder_constant') );
	add_action( 'admin_init', array($organizemedialibraryregist, 'media_folder_taxonomies'), 10 );
	add_action( 'admin_head-upload.php', array($organizemedialibraryregist, 'media_folder_term'), 11 );
	unset($organizemedialibraryregist);

	require_once( ORGANIZEMEDIALIBRARY_PLUGIN_BASE_DIR.'/req/OrganizeMediaLibraryAdmin.php' );
	$organizemedialibraryadmin = new OrganizeMediaLibraryAdmin();
	add_filter( 'plugin_action_links', array($organizemedialibraryadmin, 'settings_link'), 10, 2 );
	add_action( 'admin_menu', array($organizemedialibraryadmin, 'add_pages') );
	add_action( 'admin_enqueue_scripts', array($organizemedialibraryadmin, 'load_custom_wp_admin_style') );
	add_filter( 'manage_media_columns', array($organizemedialibraryadmin, 'muc_column') );
	add_action( 'manage_media_custom_column', array($organizemedialibraryadmin, 'muc_value'), 12, 2 );
	add_action( 'restrict_manage_posts', array( $organizemedialibraryadmin, 'add_folder_filter' ), 13 );
	add_action( 'admin_footer', array( $organizemedialibraryadmin, 'custom_bulk_admin_footer') );
	add_action( 'load-upload.php', array( $organizemedialibraryadmin, 'custom_bulk_action') );
	add_action( 'admin_notices', array( $organizemedialibraryadmin, 'custom_bulk_admin_notices') );
	add_action( 'wp_enqueue_media', array( $organizemedialibraryadmin, 'insert_media_custom_filter') );
	unset($organizemedialibraryadmin);

?>
