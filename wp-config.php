<?php
define( 'WP_CACHE', false /* Modified by NitroPack */ );
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pr' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '9{ hz0=b5rHi]*G,81`X$^^GXE9x)Ub37z-B=}X=:*.af#yB<y|3_cES%t)R<:{:' );
define( 'SECURE_AUTH_KEY',  'Vm@)b]d>5+*e|O@8;.RoW]Rl&Q1[ev&DmYDPo)m--Kl]FJ<RHSR$Ka]q6MxX2cM.' );
define( 'LOGGED_IN_KEY',    'yiW:orPbedthV!.C,mm~Q_fa7)gbXT4d[i ={DzWB+<XR_0;mNEmpb;h+&9yw)?y' );
define( 'NONCE_KEY',        'YT}G(X@2W{}y51HQm{{>nYG+J^fe|:Xiy7`s54|]6jYz/>Uc@i`9XTGwYRr1r.3R' );
define( 'AUTH_SALT',        '.Fc7E~bG|LP5P!4 Py[jC+vL53P%k@b]Whw.P1.y(xH[&3}%.0bDR` nF!UOc_78' );
define( 'SECURE_AUTH_SALT', '6Qns~zY`:GZt9InhsqGvHste.##A8hfoc`~rW8 9Nf4Yhp[l&-F*. /-%!Mjt1&~' );
define( 'LOGGED_IN_SALT',   'F_d7ws<o]{i0|z}R Z#u`2dn`+swiWq#EqSyr}sgQlFlH<#2AR/$Zrr<w^Ng;]Z^' );
define( 'NONCE_SALT',       'uHEb7w|7<5Ms7*$o?<g5mE#[(j.hl{2&YHkM-m-/HCB;YyqInrbf1Uc:[-Yf:2so' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';



