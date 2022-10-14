<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbmdgr2xipgajp' );

/** Database username */
define( 'DB_USER', 'ubdhllhxgdgbj' );

/** Database password */
define( 'DB_PASSWORD', 'rhxp05eowljd' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '_K8^wOda@ 3BdqawrQ@}LYv0qgFFdJ.3U-xXyw$?4HBVtxJEV`m},h/7dG+-cj(h' );
define( 'SECURE_AUTH_KEY',   'oT>n)M}%|8]kOUy4EK2Rw3ES}!ma}6:Vol/E_dpVnzV kD9+~q4y?yeH{0tRqT s' );
define( 'LOGGED_IN_KEY',     'tsU)Xk=L& oj-K(N,%fcq!$IWZ1J(meKO/O1(:s>#73#IgY^$x9qvnmW%]J(`s:u' );
define( 'NONCE_KEY',         '|s0 ?]XW|-v?|J.eyv*r3JjVL`AwlRE/ePV3fy6by9CK/jy~S{&ju,avIvE5$@}0' );
define( 'AUTH_SALT',         '5us7sB=h2PTSYA*f|hpL}sX)oA SvW?L0^cDUMbJQ~WUFA[6_bi{n-U?m1.w9Q{;' );
define( 'SECURE_AUTH_SALT',  't|0?FAd)pNh69ng|szLuY(g5[p|7YXqJ]RE`?({&<a,z!|!U@*v$<M4t|<F5>[W&' );
define( 'LOGGED_IN_SALT',    'G)u85d?x$$y,n~2w-PMb;_Zp#0,([T@Mzt<u1zpRP+ AohzXBxq@IfltV:/3;uM}' );
define( 'NONCE_SALT',        'W/Hz4D(gh.#L(US,+{)]1-0%,7J$8l)?w%)|L@isv!%|t@Zz+|kUP +[bZ$69r,A' );
define( 'WP_CACHE_KEY_SALT', 'PCazH6LWKD!.Qr`sY;2cD/6{mXt r~><aa?p~Wv]W*Szu6k[ aE0dLyOz:w/L!]4' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'xse_';

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


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
