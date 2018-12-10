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
define('DB_NAME', 'overlandaroundtheworld.com');

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
define('AUTH_KEY',         '_$6k5[)V^gh%Ue;CJs L+T!Lfc?@fsG<$1;U[=Pbm(r1fH~MR(3]=aWe<(IfT zE');
define('SECURE_AUTH_KEY',  '4wmgA{-69pner&^Nj^>{{AR3A:h 7g_MR^EO<00R=i+RFbDw;d(:m!f)w#W./a,`');
define('LOGGED_IN_KEY',    'MZ_Dxdo{,B9 YM4<5U4>1`v%Sh +s>$uIsj:{v.&fIK/X<32^J8<|LWA3Zu@CSSG');
define('NONCE_KEY',        '<0L`sU+VeS:B}(-:3/`=VUk%7Yw417E>Am^y4Nj~OQ0 #6P>(fcsu/e#%4)w3w!W');
define('AUTH_SALT',        ';3N59<T=w~+l@2#sx+k/BQ:ZvaX9IwBj;@4$WpOjt=nzNTx^Nv,s`}tD~0+SgG[V');
define('SECURE_AUTH_SALT', 'jX9]@26~l3W4M._/p(YJ:O6?j=UuS:Q17l/^Spym-`,lqZS_<dK<#=8iQhVy)$=/');
define('LOGGED_IN_SALT',   'Wf6J:CZ&T4g/qpOrg&HW!)QWNT{@$M1Q[Pxv?-A2w-n6u$;MTE&aRE3G:>/B5J5C');
define('NONCE_SALT',       '04l4^uQe44*WeJSB^gU&%)=AkItP/8$Uc&HI-$bwds{*jJWp,`=!b@ekLm&9ghi4');

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
