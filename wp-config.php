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
define('DB_NAME', 'fullybos_WPGYA');
/** MySQL database username */
define('DB_USER', 'fullybos_WPGYA');

/** MySQL database password */
define('DB_PASSWORD', '9o8vOtnjj!Yo:dtB8');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', 'd3c2d49466ffc35a1bedb2d776a7a44a8712957a535679be534d3bf771c53a9f');
define('SECURE_AUTH_KEY', '5cb8336ce0bd98922ecbc87489754c5a33c6ea565e527cbca83aff9e6e9bc9e2');
define('LOGGED_IN_KEY', 'f26938f9c011fd41c80fd1f002df20778b380c8ed7d957c35c9b49beca5c23b9');
define('NONCE_KEY', 'aa55f38959c27828832f71707e5ced6b19fc86dc5cdc20fd6f9475256a26be94');
define('AUTH_SALT', 'bb6587557e5ac80f240eac6363521575d5a94fbfd847bd69dfe663bc3962f51d');
define('SECURE_AUTH_SALT', '54ed7bfff11acc4f37ae97859d33f32f635f347ce9a11b83217b2a513f5d181b');
define('LOGGED_IN_SALT', '7e9bda7077439818bec13a839adf283f773482939429a9614654048ced0ebdae');
define('NONCE_SALT', '9d23c02c6f879cc36addec59906d6bae2b7f63394d8e9079317c7b0d16829a3c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'XDk_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', false);

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
define( 'WP_DEBUG',false);
define('TESTING_EMAIL_FROM', 'shaminder.devouttest@gmail.com');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
