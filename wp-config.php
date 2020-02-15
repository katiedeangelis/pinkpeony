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
define( 'DB_NAME', 'pinkpeony_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '-6DESdL@eiTEi=wvTG,swg|e+u,~5y,BuXG$7JX05X~E=fI[g`PoEGUEFF<lVMSa' );
define( 'SECURE_AUTH_KEY',  'o-bRc%w|A_} vi|(a@>g}4CI1Ya*?lUxU66KBO|X^$}nQF$0V>c^+!K]{0epQs8&' );
define( 'LOGGED_IN_KEY',    'Op_g2kih:nZ;~$}8Tereo(<-V<%5w4`K0#,Hvavs8O{P_EdNIg31tTB?CmZMj@}7' );
define( 'NONCE_KEY',        '_$^mY<xITb@QK.=(t*AZ3Y/Y*,+ogA>Yiz%73IZ;X|Nk7]=f@aJ|5o~:3a4Ffc.&' );
define( 'AUTH_SALT',        'W<zH.(P7!eEKP/>G{Y&Bc61p5-h5~F0IzRwT1ehiBJv.D&b03uGg 5>H/b4/;x*y' );
define( 'SECURE_AUTH_SALT', '/Cl-7o#|}hs)C|{pD/]irpF`SZ)T21{{v_*DFxB7~v<?%ZA2Qw#6Jlf}ru;Fl%g;' );
define( 'LOGGED_IN_SALT',   'yTPF&3<{cAy$wb&}wd6z RQs%F?KAfsxAnH`bdK1CkQKlp}SZZorHG2+diBJ&<WY' );
define( 'NONCE_SALT',       ')^qt(yr$J6AkxoYg0/v*k7XH0(gm%_LD$p}HL[tU.#MYuFn;+%3Pu!FOm1GOw6=J' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
