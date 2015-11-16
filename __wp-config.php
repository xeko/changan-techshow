<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'gmoserver');

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
define('AUTH_KEY',         'GB.,#MGYsAzG ;%g8h]V=LPL.iWc118(8ksPHrdYN1AOS-F-{>3V,2-W{2%JgLK>');
define('SECURE_AUTH_KEY',  'c3%cnR2cmv#{%K ZcZ9Jehby(1KP,/f;$[N%hC8Df`E|Lq2oKMxezzUPZIGtAKf]');
define('LOGGED_IN_KEY',    '>W=.a{z!zZ$-ixK/3egB]41KcT[a.REZOei#|[lG_il_;D2/(cB+R{0oP|u>J}jM');
define('NONCE_KEY',        '?Ln(1[S@*,=Xh88OB@C,GDqmj 1FXB7@-*tKN3r{ V5!aQn@kwPMQQ:f S&yCh#T');
define('AUTH_SALT',        '0C+-^1;`ou;<9-((tm#B50tZ+I|#l*=wqZ&:zQoVT2+I;-fhXAgLtLij)`QQQ}^u');
define('SECURE_AUTH_SALT', '$27{r/_6 CMugEw/yx|> 0W+@?ovx#I>N/s+m.LzS-Pr>9<iD?OJzm3 @sG.V/|:');
define('LOGGED_IN_SALT',   'fT?m|:M%P{PU:{w5~x{P6 |tOkWpMK<-R*&X5+@Mpx0+Ct5TH(pkVH,CtP|^+6fF');
define('NONCE_SALT',       '13Z+LN+IZj?7ZV=E9-[S>6yysz?9=ZdA||219:=4lM][/){cvhj+xkB5hkU0jOqO');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'gm_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
