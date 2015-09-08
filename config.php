<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundaci�n Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

define('GOTEO_PATH', __DIR__ . DIRECTORY_SEPARATOR);
if (function_exists('ini_set')) {
    ini_set('include_path', GOTEO_PATH . PATH_SEPARATOR . '.');
} else {
    throw new Exception("No puedo a�adir la API GOTEO al include_path.");
}

// Nodo actual
define('GOTEO_NODE', 'goteo');

define('PEAR', GOTEO_PATH . 'library' . '/' . 'pear' . '/');
if (function_exists('ini_set')) {
    ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . PEAR);
} else {
    throw new Exception("No puedo a�adir las librer�as PEAR al include_path.");
}

/******************************************************
PhpMailer constants
*******************************************************/
if (!defined('PHPMAILER_CLASS')) {
    define ('PHPMAILER_CLASS', GOTEO_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.phpmailer.php');
}
if (!defined('PHPMAILER_LANGS')) {
    define ('PHPMAILER_LANGS', GOTEO_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR);
}
if (!defined('PHPMAILER_SMTP')) {
    define ('PHPMAILER_SMTP', GOTEO_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.smtp.php');
}
if (!defined('PHPMAILER_POP3')) {
    define ('PHPMAILER_POP3', GOTEO_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.pop3.php');
}

/******************************************************
OAUTH APP's Secrets
*******************************************************/
if (!defined('OAUTH_LIBS')) {
    define ('OAUTH_LIBS', GOTEO_PATH . 'library' . DIRECTORY_SEPARATOR . 'oauth' . DIRECTORY_SEPARATOR . 'SocialAuth.php');
}

//Uploads static files
$static_dir = preg_replace('/\/[A-Za-z0-9.]+\.localgood/','/static.localgood',dirname(__FILE__));
define('GOTEO_DATA_PATH', $static_dir . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);

/**
 * Carga de configuraci�n local si existe
 * Si no se carga el real (si existe)
**/
if (file_exists('local-settings.php')) //en .gitignore
    require 'local-settings.php';
elseif (file_exists('live-settings.php')) //se considera en git
    require 'live-settings.php';
else
    die(<<<EOF
No se encuentra el archivo de configuraci&oacute;n <strong>local-settings.php</strong>, debes crear este archivo en la raiz.<br />
Puedes usar el siguiente c&oacute;digo modificado con los credenciales adecuados.<br />
<pre>
&lt;?php

mb_language("Japanese");
mb_internal_encoding("UTF-8");

// LG Base Name
define('LG_PLACE_NAME','--lg-place-name--');

// Metadata
define('GOTEO_META_TITLE', '--meta-title--');
define('GOTEO_META_DESCRIPTION', '--meta-description--');
define('GOTEO_META_KEYWORDS', '--keywords--');
define('GOTEO_META_AUTHOR', '--author--');
define('GOTEO_META_COPYRIGHT', '--copyright--');

//Mail management: ses (amazon), phpmailer (php library)
define("MAIL_HANDLER", "phpmailer");

// Database
define('GOTEO_DB_DRIVER', 'mysql');
define('GOTEO_DB_HOST', 'localhost');
define('GOTEO_DB_PORT', 3306);
define('GOTEO_DB_CHARSET', 'UTF-8');
define('GOTEO_DB_SCHEMA', 'db-schema');
define('GOTEO_DB_USERNAME', 'db-username');
define('GOTEO_DB_PASSWORD', 'db-password');

// LocalGood Common Authentication Database
define('COMMON_AUTH_DB_SCHEMA', 'db_auth');

// Mail
define('GOTEO_MAIL_FROM', '');
define('GOTEO_MAIL_NAME', 'LOCAL NIPPON');
define('GOTEO_MAIL_TYPE', 'smtp'); // mail, sendmail or smtp
define('GOTEO_MAIL_SMTP_AUTH', true);
define('GOTEO_MAIL_SMTP_SECURE', 'ssl');
define('GOTEO_MAIL_SMTP_HOST', 'smtp--host');
define('GOTEO_MAIL_SMTP_PORT', --portnumber--);
define('GOTEO_MAIL_SMTP_USERNAME', 'smtp-usermail');
define('GOTEO_MAIL_SMTP_PASSWORD', 'smtp-password');

define('GOTEO_MAIL', '--localnippon-mail-address--');
define('GOTEO_CONTACT_MAIL', '--localnippon-mail-address--');
define('GOTEO_FAIL_MAIL', '--localnippon-mail-address--');
define('GOTEO_LOG_MAIL', '--localnippon-mail-address--');

//Quota de envio m�ximo para goteo en 24 horas
define('GOTEO_MAIL_QUOTA', 50000);
//Quota de envio m�ximo para newsletters para goteo en 24 horas
define('GOTEO_MAIL_SENDER_QUOTA', round(GOTEO_MAIL_QUOTA * 0.8));
//clave de Amazon SNS para recopilar bounces automaticamente: 'arn:aws:sns:us-east-1:XXXXXXXXX:amazon-ses-bounces'
//la URL de informacion debe ser: goteo_url.tld/aws-sns.php
define('AWS_SNS_CLIENT_ID', 'XXXXXXXXX');
define('AWS_SNS_REGION', 'us-east-1');
define('AWS_SNS_BOUNCES_TOPIC', 'amazon-ses-bounces');
define('AWS_SNS_COMPLAINTS_TOPIC', 'amazon-ses-complaints');

// Language
define('GOTEO_DEFAULT_LANG', 'en');
// name of the gettext .po file (used for admin only texts at the moment)
define('GOTEO_GETTEXT_DOMAIN', 'messages');
// gettext files are cached, to reload a new one requires to restart Apache which is stupid (and annoying while 
//	developing) this setting tells the langueage code to bypass caching by using a clever file-renaming 
// mechanism described in http://blog.ghost3k.net/articles/php/11/gettext-caching-in-php
define('GOTEO_GETTEXT_BYPASS_CACHING', true);

// url
define('SITE_URL', 'http://localfunding.muji.com/'); // endpoint url
define('SRC_URL', 'http://localfunding.muji.com/');  // host for statics
define('SEC_URL', 'http://localfunding.muji.com/');  // with SSL certified
define('LOCALGOOD_WP_BASE_URL', '----wp site address----');
define('LOG_PATH', '/var/www/html/localgood/cf.fukuoka.localgood.jp.il3c.com/htdocs/logs/');
define('LG_INTEGRATION_URL', '----integration site url----');
define('LG_NAME', 'LOCAL GOOD FUKUOKA');


//Sessions
//session handler: php, dynamodb
define("SESSION_HANDLER", "php");

// Cron params (for cron processes using wget)
define('CRON_PARAM', '--------------');
define('CRON_VALUE', '--------------');

/*
Any other payment system configuration should be setted here
*/

/****************************************************
Social Services constants  (needed to login-with on the controller/user and library/oauth)
****************************************************/
// Credentials Facebook app
define('OAUTH_FACEBOOK_ID', '-----------------------------------'); //
define('OAUTH_FACEBOOK_SECRET', '-----------------------------------'); //

// Credentials Twitter app
define('OAUTH_TWITTER_ID', '-----------------------------------'); //
define('OAUTH_TWITTER_SECRET', '-----------------------------------'); //

//SNS link
define('LG_FACEBOOK_PAGE', '----facebook url----');
define('LG_TWITTER', '----twitter url----');

/****************************************************
Google Analytics
****************************************************/
define('GOTEO_ANALYTICS_TRACKER', "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '--your-tracking-ID--', 'auto');
  ga('send', 'pageview');
</script>");

/****************************************************
AWS
****************************************************/
//Amazon Web Services Credentials
define("AWS_KEY", "--------------");
define("AWS_SECRET", "----------------------------------");
define("AWS_REGION", "-----------");

// Credentials SES
define('AWS_SES_SOURCE', '--------------');
define('AWS_SES_ACCESS', '--------------');
define('AWS_SES_SECERET', '--------------');
define('AWS_SES_CHARSET', 'UTF-8');

/****************************************************
AXES
 ****************************************************/
define('AXES_CLIENTIP', '----------');

/****************************************************
Change view type
 ****************************************************/
\$ua = isset(\$_SERVER['HTTP_USER_AGENT']) ? \$_SERVER['HTTP_USER_AGENT'] : "";
if( !empty(\$ua) && ( preg_match('/iPod|iPhone/i', \$_SERVER['HTTP_USER_AGENT']) === 1 || preg_match('/Android.+Mobile/i', \$_SERVER['HTTP_USER_AGENT']) === 1 ) ) {
    define('PC_VIEW', false);
    define('VIEW_PATH', 'view/m');
} else {
    define('PC_VIEW', true);
    define('VIEW_PATH', 'view');
}
?&gt;
</pre>
EOF
);

if (file_exists('tmp-settings.php'))
    require 'tmp-settings.php';
else {
    // Temporary behaviours
    define('DEVGOTEO_LOCAL', false); // backwards compatibility
    define('GOTEO_MAINTENANCE', null); // to show the maintenance page
    define('GOTEO_EASY', null); // to take user overload easy
	define('GOTEO_FREE', true); // used somewhere...
}

$ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
