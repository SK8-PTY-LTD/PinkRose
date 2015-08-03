<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pinkrose');

/** MySQL database username */
define('DB_USER', 'pinkrose');

/** MySQL database password */
define('DB_PASSWORD', 'pinkrose');

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
define('AUTH_KEY',         'dA/oSwb=q,j8`?M`$L07:D<llbz:S6$ZZb>0;*0|lh+<&XL8@CZ5dLzdoRDCEMvq');
define('SECURE_AUTH_KEY',  ':cmYw5_D7uQ`g:`7x^.*+XEn**eVio.!V-<5T>wC$KE)=!^$ZzW1@sDw#L_6ahD.');
define('LOGGED_IN_KEY',    'a1J#-e<myEg;ulz4@^wPW%b|O^@.f@s{v UQ+]T?aF5MIAu%,%i{CVFs=-djls>L');
define('NONCE_KEY',        '-3*CD>&X^o]blirsQAM$HdMBfM5c%~dWo||?O1qf)f+3> -TdB:OV+^pE:_i?I),');
define('AUTH_SALT',        '&,z&-r-Yz&j5Ci+7&BK`je[|,(J~xh7=(_zc-#T3 Q-1u/<+p753yOOw(u[}+|7<');
define('SECURE_AUTH_SALT', 'c7[<A:S|D5`3wV-b@}$3h6r1U|3)Ih^6(iH{3I-bP_yn*9J~A=})e^9LL+(Q,>%_');
define('LOGGED_IN_SALT',   '>G$|npz8wuviXQBZUK=oHV+eMG%jCY&|))6fNpTACc!<iSkJ)RlGGy4j 2Bhk|s+');
define('NONCE_SALT',       'iixQ.?fXHVH^T~d`n-vK{-GD*C+2.P^8MNry8gEcu?KLY`!>dcG?EhL8-I#eMv4?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
