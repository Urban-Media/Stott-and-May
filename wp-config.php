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
define('DB_NAME', 'stottandmay');

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
define('AUTH_KEY',         'tj1mIN>M)A(>}>J(y/~EXTi]}WMnh*w?{LHeAt0OE)p5+;9sL)UanGhW_:|l eSh');
define('SECURE_AUTH_KEY',  'umB:HI@kP6=SV(]S(G<RWD+mUgeHdk?|b^K1N]*[HKLIu,f+UD[wJjk#wG~6EAO(');
define('LOGGED_IN_KEY',    'v aB} &}*c9?d.,I_W?E>W&L-pJM)<_t9`9*vS+W4QdQQo:}VPQMig_{n1~=GH><');
define('NONCE_KEY',        'G_d n:K_x8oM+NIT@!$NRaE1|hOlry2=iXM`r9]<]f?0 w).1x=[uDNk%SuIer4h');
define('AUTH_SALT',        'wj`9J QXw7XanwS^|9Tj#69r}l?scJ$IPdW-]cCcaxSGN`VQ!+u4KuX]_Rt8nHXS');
define('SECURE_AUTH_SALT', '>(nXB*_bPT*N0~*SQ;]t[%2#=uEtMBYl<wa1`;9.Y~C$UR|,W*6rWF/!!^,1ak%j');
define('LOGGED_IN_SALT',   'j=`3s;TfN#vuOE6<@z9d%DOs@2y>u=zHV4l;)=py<ME3vb5r_vIGrWQXtpMiWR+f');
define('NONCE_SALT',       'q@r2g&e1hx!Z2Zkx,t!+sRvJYj#NC(m%wr].tn<|5xS>BY:CQw]KQ}^.]Y9Ly#}V');

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
