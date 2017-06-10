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
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/Applications/MAMP/htdocs/digitate/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'now_digitate');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'tC!sWNF[?+9U3JkBvUj!Kp q ^o_33WWQ<>(chpNoy)</r5L>mDq[fIxs5pa&d}@');
define('SECURE_AUTH_KEY',  'LCRR{zy3[je70eRj`evSs!m]z_k$K+3*-qU59=;khPf_IO6@_0} 7c+~Fj[w~)R<');
define('LOGGED_IN_KEY',    '=2.@0tg=>:s&j4@eAeH(_n3L70(Bx!k+x1-dV3(}E8$axWG.c[k|NVc;[g=<VF-6');
define('NONCE_KEY',        'wy-g-hht4=G8 6Q=x-uxe[CHb)cDx1s|^4$8u6TW[g3AGe;MrXiH9{cnjh1-p+U6');
define('AUTH_SALT',        '6m]L`|]M^7eAk]URgczAaBW+1Tie;Ix5I=BeDb<|T3mLX)5jO<9^h#YX=/_I5^J/');
define('SECURE_AUTH_SALT', '[sfqX?N}pSXpePtFh2ZHM%*$l5;-H!5)<FdbNIw*l-rlD#Y}XIV6_=~^h@|>K/Xq');
define('LOGGED_IN_SALT',   'Vsj7w1ER@wm+|+sR7 UYY5+Rb|Y`+)b>/NO`,c~A%,ytA-WOzE)?H;=op9OR:+J!');
define('NONCE_SALT',       '0PK8rt+O@Y7L}S[:Vp83 ^UEj>1`}&&}j02HC-m|1#&}VKOgk+]wW?9W(&FY.P>D');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dignio_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
