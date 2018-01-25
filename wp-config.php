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
define('DB_NAME', 'e25_bcs');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '9@~!:4yl.)w(EY!*PUK{:f8)(3`RHe4>tu_H/l[eCWy))}+ylfZO(P,r.ag!I2hg');
define('SECURE_AUTH_KEY',  'p&a}^?[|}/[%,RJYlD$DIr0?L={dmO9[H3a<a;|[[aTf7ev_.J`/aa2!hu8q;v}>');
define('LOGGED_IN_KEY',    '{n/3a=}Rj0c]0uWyRG2Jy%3@?()sbR7qhAd^d&h2GrWpSkl2fn.> ].`#fZ@t0CV');
define('NONCE_KEY',        '!^sq*)}D`[5{i|ljE&Gsi6k094`c>nNj`zSX,lJglgR8#-11mK@4I_^bw@Za R[B');
define('AUTH_SALT',        '=1/pkX/8z,$+2waez>+|c[A>TQxc6uED<nLB0NVy 4#{4(D14=LeGcLXLeAS({[`');
define('SECURE_AUTH_SALT', 'b+{*4^n)UDQtpJ&/aBg=#%)i*}pk4EN~92(OBPU:IY~pt3PLR7hu@I) d  +EzPz');
define('LOGGED_IN_SALT',   'n$|;mEJ9USZB/_~FY04G|!@v6sQ](>/i[ohYBcZR7]sApr@VZNY ^wQavzJxeiA4');
define('NONCE_SALT',       'VC4%H19JO-rwBX_KTcPi0_<KaF-A%@;QT~<dE1/J_+|c;Nok|T;$Hp<`,jU.s6ii');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
