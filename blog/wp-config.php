<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u202802032_mSPnY' );

/** MySQL database username */
define( 'DB_USER', 'u202802032_uJzBK' );

/** MySQL database password */
define( 'DB_PASSWORD', 'LiiHkTycUc' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'Dy{j[v:uw]j75dq!Zuy2QZ/|3d2ERq[da[3~He*Wne]xN XLf5G|qUtXK+OW:E?f' );
define( 'SECURE_AUTH_KEY',   'mEHnr| <`e&$g?i[@[gWX!?VqA&9Z(u`wBM-R])T}o.m1B*jeURKE>!Ulng>w3{R' );
define( 'LOGGED_IN_KEY',     '0X`6Ylxr($lZ#a,bys+SnWC%m{<UnV<eXqLq};KrET~PLX`g)Y4w[pJcX|1Jh: i' );
define( 'NONCE_KEY',         'iV!=zs xMdo/67#u/uZ*7|FZIe(Nw#5i;[OHBq!oPv-lJ]#tml8knhC+o/Pwj&]o' );
define( 'AUTH_SALT',         'M+{MnkJ)liJR?T>z*_<BgDU83DV*^1@{@M0u+J<K8<!2fj{N{+vZs,Ui[lh~=Q%0' );
define( 'SECURE_AUTH_SALT',  '[5ig&VzjD*s?i$nZN(>`z)qK!F`-8k:H3-fZp02.Qbmm?<ceNV2Wk+/67j%;;[~h' );
define( 'LOGGED_IN_SALT',    '2H-p_VJik6c~SCVHmf9@<JrI^L:DB{&/e08&rmC4Ct5.!L:(4ti06,2s3Q98aSLh' );
define( 'NONCE_SALT',        '}:!]k~8-:`Qr9UM|A.T.{G?C&MNx,UGC`lFr5d=87^I1q()lX4;~t?&(RLFZX@xo' );
define( 'WP_CACHE_KEY_SALT', '}YRtzfO$p`t{ro*Pc^f.Y38rKNKVusu)Kx_bl@F;VPAmcq3=tEe??n$%JStV[8zI' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
