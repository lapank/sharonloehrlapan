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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kaylinla_WPOAO');

/** Database username */
define('DB_USER', 'kaylinla_WPOAO');

/** Database password */
define('DB_PASSWORD', 'wD[ctvBPqdYA)8i5m');

/** Database hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY', 'd08a88055b5d3fabdfeba86bced827f0dfa6569d6f95707cff7a96312b798c7c');
define('SECURE_AUTH_KEY', '2b540bc442a6c17224bdbb4ab2ae7549a44f7ad084278fbaa173b9efb1d6cb25');
define('LOGGED_IN_KEY', '02c356cd65d624edef0ba4606c8f7e0607d89371cd4bfc8b0433029d0eb25397');
define('NONCE_KEY', '0f13a8a7cc0016f588f997a98801160dd3fd505a2e37dd9cc6e84788e3e9c54d');
define('AUTH_SALT', '238ba14c78cdd7d3f8149c52524d466ed42c394b31abe2aa50d505397545812f');
define('SECURE_AUTH_SALT', 'd1e2d3f329f88d3afa9a711fef86c28f1ad649371cfc46d7c6e4988c6a1081d9');
define('LOGGED_IN_SALT', '95df0bbe74f11f2d7e88c4cc3dd154ba53ff90c9f495c50b82cae5d22207adc6');
define('NONCE_SALT', '122e1ed00d4c55fcf977496e7ca5e7c6505c0e7a132ccccd020e6383430a43f2');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'KFW_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 20);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
