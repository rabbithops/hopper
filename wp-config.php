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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hopper' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'mysql' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'y,JFoFZBhqUK~muV@Pt26OUhX./HqI@jrju sxc;PyvqffI;:?z/Eyi)67%MD>&(');
define('SECURE_AUTH_KEY',  'Wu/{+1L7XG,gzA#nd{+xc%_q2!*IKuB;Sw(x;X>hQFqKQGj4-b!IAx2*fRKA~1K1');
define('LOGGED_IN_KEY',    '2jB)@(dAK%?a%o/gR`-yTh]Lh-t5o6ymDsvs(3&D]}L;Tm`{_b62KjGGLPL<8c<t');
define('NONCE_KEY',        'xSJyqJpvX,,X|k&odTJC&0Ro1|-},[|iAtR||gMSb#}2L.%y<rubN]Ovy0)+zQp)');
define('AUTH_SALT',        '9sl:/T3Ti82uESY-.+U`o[O=W>eHw@K%=zDe b%Od1q&KQj|%>K&|~+RX1A3-`c)');
define('SECURE_AUTH_SALT', 'Rs|cy4`u)rwb7ahIqi/296aiMD4LQ5$E*K?t8IL9@eR4;Z8,~:|3yHSwsV:tH[Hd');
define('LOGGED_IN_SALT',   'T=<=0L<nJEzni!l8+Yf[Wi1v/SWNFHj%}~;DDHVAW}`oR+Sj3}CIX:]x:Ne}6zs`');
define('NONCE_SALT',       'N=3cN~!]A21)?}#|%3utK/bfatF-_c+%-&+<dCo`>bj59>-@#&sRJ,x_a@v +a-^');

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
