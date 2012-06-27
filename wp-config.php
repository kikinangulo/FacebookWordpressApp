<?php

/* admin / Adsighv4j */

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

define('FORCE_SSL_ADMIN', true); // Forces SSL for /wp-admin

define('WP_HOME','http://cms.plantcph.dk/assets/facebook_apps/plant/FacebookApp');
define('WP_SITEURL','http://cms.plantcph.dk/assets/facebook_apps/plant/FacebookApp');

/* FACEBOOK APP SETTINGS */
define('FB_LOCALE', 'da_DK');
define('FB_APP_ID', '367409366638200');
define('FB_APP_SECRET', 'aaa5c637d6a84223e250a44b64939b42');
define('FB_PERMISSIONS','');  //'publish_stream'; // scope: 'publish_stream,read_friendlists' ! NO WHITESPACES !
/* EOF - FACEBOOK APP SETTINGS */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'plant_template_facebookApp');
define('DB_USER', 'PlantfacebookApp');
define('DB_PASSWORD', 'vf98fQPBh79aYZNn');
define('DB_HOST', 'db.plnt.dk');
define('DB_CHARSET', 'utf8');
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
define('AUTH_KEY',         'c)Su&$Q2ST&E(g6HvJg9+#q*,f>A)z)0Q`#g79]N)^ut 5$n~Q_P3(,jP,[ue|YG');
define('SECURE_AUTH_KEY',  'U<?pv|#,i^JX5p6xrun>HF@!;=LhnR>Fut,Dm^|{.>0L&.LvY t&h[zp,+;U6+9F');
define('LOGGED_IN_KEY',    'MozKIh`^[+}:9CXs%CAxSz:z9Ff2e{|^w0&$u55&Y4E[@{<_c5.4^qpu;(]0fECV');
define('NONCE_KEY',        'Z(Rr P;g9?4NKE-jo#pL|Lh4!?@,:2#9++-?{3<;TqWH+FNt,z:-9Y#qC/&XE}Lb');
define('AUTH_SALT',        '66o,1?NcGI]~4h}j#_V?Tb1n|gh7p({DJ{]-L45{Ba|+eZXjnx;jOOA*Cm|H0Qqm');
define('SECURE_AUTH_SALT', 'CR82M*iUH0P NE^^CZm<saSsx7Lgpv/R-x?erV>1/i8pg22zT~3QW^+->Pd{pUC%');
define('LOGGED_IN_SALT',   '!.,RlT$>!C8ZzqMg7`hm(/D=w@lCG0gIOSyWO%e;p:fp;/M4En1pV/UJZ [JTO:L');
define('NONCE_SALT',       '*l1f&$EA:+dUUkwW>cl)2xEctM@y!JIc[bAP!Mh%+WCsZ_W2Yn|V6ovPY7ll~hV*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
