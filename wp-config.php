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
define( 'DB_NAME', 'beco' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );

define('WPCF7_AUTOP', false );

define('WPCF7_LOAD_CSS', false);


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'z$G>W~>d8?1ns6hqX`~DI<%rWY0ssb/ C)XOb<Rjl3d$Nc=O%xfTw9}]LX WXd|T' );
define( 'SECURE_AUTH_KEY',  '$Ik1EZEX%ZMHJQ3r|]QnULhMxc)i4^NXUC,b4>OZlDXwQM>(tM6N?U=$mJPHZ&ox' );
define( 'LOGGED_IN_KEY',    'J].RoSo0GYhIda00`$BZXh;Cpoj,J-!%GjpM,bqDmDZWNT.s:Lm}2p+c],_sC_ R' );
define( 'NONCE_KEY',        'IQ7qx@3EJyWVJU]vu7Xj+7r]:$sf6fO.+9C1sRpVwO3t>|E^>L`0omL+Fk5xqCHs' );
define( 'AUTH_SALT',        't9kdRjM3>uVRa#OFyL-yUi[??ka3,%X?Pe<o(Bos41062C^32.OtnQLaM1cH0kQ(' );
define( 'SECURE_AUTH_SALT', 'OY.>/-Sl~Ky3n~|_&V<K0b|X9,NHL4/s.C&(t^?`GMsyF:O0/O1raEJznRwnt0dt' );
define( 'LOGGED_IN_SALT',   'LpfKnQyD@56%~!p[U_2}6h!k<bB1FB70uVJ<%BYwFM>H{N.V68$Ou~{% p =E>-o' );
define( 'NONCE_SALT',       ']2oqK_L(n_CapM:bR#~{!sMa;[?0&abScI>`6VDF>y_~/@3n|e$p:,0x^UkyWk0R' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
