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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'covid-tracker' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3Kmnr(!VR{,tE=!l:#<4]e:6KRrB4FJ5{?hlcs`Y13Iow$~y_/@fLvgms[aOnBJ3' );
define( 'SECURE_AUTH_KEY',  '5VSv~-l9CQ cS~xNL*=UtCB`+N,#|`*ZO?V%;p]oRcensOlbb p@FbgevoVANJO}' );
define( 'LOGGED_IN_KEY',    'uZMO;`]?~AOW7Q9UuSd7fM? w,]Zpu,+4Fs4(gf(sxh&biRZihUW_*2|aYxx*CtT' );
define( 'NONCE_KEY',        'xggIKU>o+Zi@q#0zbV@-H|#;Hja,.V)*v*t^z380rL/jI;uDF*Gc>,J8yfbh*KeB' );
define( 'AUTH_SALT',        'udhi!Gx];}/EQ}.Y9xL4I#8j:#b~9Jhn>0Zw,MFERx>!o*RoJEJ}#~,9Kk[c9DN-' );
define( 'SECURE_AUTH_SALT', '=aRW1m]c_7~R&Ji|j (5v>90Rl/H!b`ym?}JWGd5[FPeRZ`8k9e^+?n24@E;j5f$' );
define( 'LOGGED_IN_SALT',   'IyNUGq:)WD;yM>So]G<$glrS?a&VZFCy@A^<@+^z05+r1 (sj<kpS]s+w4BQHd=}' );
define( 'NONCE_SALT',       '2k%fJ(`u.rWbb+/^F7KpVtMmjoe6 *.VwE1BFH:QqQ1@mtr^G]f51G#aCkV-rs^#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cov_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
