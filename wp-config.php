<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'gantil_new');
define('DB_NAME', 'gantil2');

/** MySQL database username */
//define('DB_USER', 'gantil_mysql');
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'icbi0dws');
define('DB_PASSWORD', '');

/** MySQL hostname */
//define('DB_HOST', 'gantil.mysql');
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/*define( 'WPCF7_UPLOADS_TMP_DIR', '/wp-content/uploads/wpcf7_uploads' );*/

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'yc~Xg!~/[s+bWx*Dj%^RT<c019N;?sc**pB%kWv(R.?JxdgMpW_P_t48+tC!Iy _');
define('SECURE_AUTH_KEY',  'dC;x.V.0~[+^nGF^jews1x-iJio}HP2=9O7TD;uF32xOmv#wQy2gMGP2u s%{tE$');
define('LOGGED_IN_KEY',    'Pz]6GOw1H~+lg=.-YXKiEgV`bKZtB-4CUUER(dexNw<4=,EaqTEA)M!&z~XhEqO&');
define('NONCE_KEY',        '1b{Th-()oPp~?Qer7}7ZrD!M98A+l{dIUv]Ud:7yPL>KTm!+oJIkyqgq_wjM=CSI');
define('AUTH_SALT',        '%r5|hn#?3Rq6yKMJ ?i$UP0`,y1*AQ$RCS1yGM0a,q4#0LdN]Lp&X*|Z>2el0l%[');
define('SECURE_AUTH_SALT', 'xexsa-$q!$U2Kq0,e_>qUf}2z(|OW8Ld>n|4dfCBW_%u4hQ`TqQuHi6|v)xm..A2');
define('LOGGED_IN_SALT',   'enc$A.Pk4W~qy}.SVQ9qRoI+91NbvBOGL9G[zG/ZjFPf2$1i1y&2J=kUl/E?;fwQ');
define('NONCE_SALT',       ':`^V?D1O NYdf N=/1$lewGCaH84cs~+UZ&[VdR#4Z0*5w=~T*haC~pZbs^kPX?B');

/**#@-*/

define( 'AUTOMATIC_UPDATER_DISABLED', true );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'gn_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', false );

define ('WPCF7_LOAD_JS', true );

/*define('WP_HOME','http://gantil.ru');
define('WP_SITEURL','http://gantil.ru');*/
define('WP_HOME','http://gantil2/');
define('WP_SITEURL','http://gantil2/');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
