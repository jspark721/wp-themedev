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
define('DB_NAME', 'juliepark_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '&@l&@rFmS~b/vm<:,H4E@(C1>8pzVB,Pww8}0C_al _41x~Acx,ewR.{D+1:.UM?');
define('SECURE_AUTH_KEY',  ']9d9Q?+SxT.bMpck<l{Bph4&Hk]G#=!5yUe]/hQi%WE)Y?n=nR^anncnPkjGI#%}');
define('LOGGED_IN_KEY',    ',_%oz]f ,%_|+BALsigqPy{GvEXQ&ECzL-*LZC|):v7urNtdle]MtK~PtTO2`fzB');
define('NONCE_KEY',        'x*A2 0/~c^t*GC>uAK6?&f5PK_n#,I[`5|{w9#di!S%#0klZO>wT`7 i[lTTXYF-');
define('AUTH_SALT',        'I~U<=G)w>Te$ytV!AJElKe8C?9b-J<yzPy4%9YR1f.uyTj7#eM sp=#0Lj%G&zS)');
define('SECURE_AUTH_SALT', 'Y>nbRIQ84{**rm3 >0WTBmod@G!tPp.!{s{Gl]5V=<&|~S`N9NeRWB88n{`Icl%K');
define('LOGGED_IN_SALT',   'KA7SBMfk!R*V@o)Yl8z;Q;v-aA3B/z|TpoLJwv-vu&;Y]mQjV=k)Yo6^D]B>RjhY');
define('NONCE_SALT',       'Q5T0gc$e1+(cMkU.dA!^1GozAcy)l{#:}vfCAg4G}53bbEJj+k}?,&.?^6$z/J#T');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
