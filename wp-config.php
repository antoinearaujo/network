<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */
define('FS_METHOD', 'direct');
// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'network');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'simone');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}4zt|Fw(SS9;[+d$7/uQhIFSS*;RH@NTkgNtLB*ZeJALsC`KN4<7+{gmK:{o <2y');
define('SECURE_AUTH_KEY',  '|_cm/v-,43=6<,0C^9BnTBh/a>L{|X,=W0=&bS(rx=@E7ARZKq7H<JGk|(X[h2x_');
define('LOGGED_IN_KEY',    'LSMnq[h/:7R_FF[H*Fzd.^E^}G+^#NZF-z{L:3x-p-y`U^l2v{1^EWy:|9xas|S@');
define('NONCE_KEY',        '}+po-EOk)7 ,?_BS{]3@w[-fS*$O$c=$qk*IWS_V%Ej!7_gaBuWqpD2SlK@#8cfn');
define('AUTH_SALT',        'aJw37,Lc*n<Jwm:~N<g1_eAdJgrlVNuwwy%|Qq$zz^2Mx/W0}>G-vO<l)),NH^T.');
define('SECURE_AUTH_SALT', 'o`-L,nTQy=?Qv04JH7,A=WE8i:Q! pUT^d)xYd*]:UtJA!p;%LzAf3/FU;ZAbQA,');
define('LOGGED_IN_SALT',   'u6AGN%?89]XWunv).IK&njrH;L#_0hMd!__3MVguY b;NFgYP5o7Mb1W05VC5#be');
define('NONCE_SALT',       'Aqq.p.q|u2%f&6^#R1:Yw  A-Fy;28]z@{59x#rZ!@M7i{}*x{VA#cT&]Q)|aJ1<');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');