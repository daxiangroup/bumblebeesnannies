<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $_ENV['BBN_DB_ENV_NAME']);

/** MySQL database username */
define('DB_USER', $_ENV['BBN_DB_ENV_USER']);

/** MySQL database password */
define('DB_PASSWORD', $_ENV['BBN_DB_ENV_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $_ENV['BBN_DB_ENV_HOST']);

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
define('AUTH_KEY',         '!dzuyg;WUHcEKbn7d{h|p=>&xa?(/L%|bNLOn5;@h ashMhQvauR~e`~,74d _&<');
define('SECURE_AUTH_KEY',  ']ggTf~^fXgb U]Rc33&.);3R8GLXi}WHoPzxcsBt>)@n^`E<n}kUIv<k2dkUKGt1');
define('LOGGED_IN_KEY',    '~}r<q=S]<|Y|0TZiN/X0W/DS4f4z)4(n:xIThu.>fLVYsc(-nt@t_sW*EyoI}1wY');
define('NONCE_KEY',        'x`VU,E$l]4glhoB{dWf/lAqRBi,k1[y16C?&xIwXL?s|LENfr6.oy.)|&:@/Rq$n');
define('AUTH_SALT',        '~yEBH@:XocU8(Ze5K p20zs(Mj3eMkT:WkNsH#K@`tfVgkAAb3Ql.Sf5IIkz1j.r');
define('SECURE_AUTH_SALT', 'f`HAN_%I1|!3aDWKJ7#bpY)M8I7{<2gULX@3Ryvo__HGlB]cyFahzL!q_~+%sqgA');
define('LOGGED_IN_SALT',   'a{ny!?.nAk*36z}s2&sSR/|>Ao- C,baU 1(=<NWCJxxSGCz5A){~B[4jL*&Zk,`');
define('NONCE_SALT',       'nE|ENQYU=dEr_Z8JR{iaB`Bz8WE*;heF5k`Gzy,TQ[=9Vbo<j^;%9Y>yK70S2~Oa');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bbn';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
