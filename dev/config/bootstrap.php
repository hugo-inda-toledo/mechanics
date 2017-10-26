<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/*
 * You can remove this if you are confident that your PHP version is sufficient.
 */
if (version_compare(PHP_VERSION, '5.5.9') < 0) {
    trigger_error('Your PHP version must be equal or higher than 5.5.9 to use CakePHP.', E_USER_ERROR);
}

/*
 *  You can remove this if you are confident you have intl installed.
 */
if (!extension_loaded('intl')) {
    trigger_error('You must enable the intl extension to use CakePHP.', E_USER_ERROR);
}

/*
 * You can remove this if you are confident you have mbstring installed.
 */
if (!extension_loaded('mbstring')) {
    trigger_error('You must enable the mbstring extension to use CakePHP.', E_USER_ERROR);
}

/*
 * Configure paths required to find CakePHP + general filepath
 * constants
 */
require __DIR__ . '/paths.php';

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Network\Request;
use Cake\Utility\Inflector;
use Cake\Utility\Security;


/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load an environment local configuration file.
 * You can use a file like app_local.php to provide local overrides to your
 * shared configuration.
 */
//Configure::load('app_local', 'default');

/*
 * When debug = false the metadata cache should last
 * for a very very long time, as we don't want
 * to refresh the cache while users are doing requests.
 */
if (!Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+1 years');
    Configure::write('Cache._cake_core_.duration', '+1 years');
}

/*
 * Set server timezone to UTC. You can change it to another timezone of your
 * choice but using UTC makes time calculations / conversions easier.
 */
date_default_timezone_set('UTC');

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/*
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/*
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

/*
 * Include the CLI bootstrap overrides.
 */
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/*
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 *
 * If you define fullBaseUrl in your config file you can remove this.
 */
if (!Configure::read('App.fullBaseUrl')) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
    }
    unset($httpHost, $s);
}

Cache::config(Configure::consume('Cache'));
ConnectionManager::config(Configure::consume('Datasources'));
Email::configTransport(Configure::consume('EmailTransport'));
Email::config(Configure::consume('Email'));
Log::config(Configure::consume('Log'));
Security::salt(Configure::consume('Security.salt'));

/*
 * The default crypto extension in 3.0 is OpenSSL.
 * If you are migrating from 2.x uncomment this code to
 * use a more compatible Mcrypt based implementation
 */
//Security::engine(new \Cake\Utility\Crypto\Mcrypt());

/*
 * Setup detectors for mobile and tablet.
 */
Request::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isMobile();
});
Request::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isTablet();
});

/*
 * Enable immutable time objects in the ORM.
 *
 * You can enable default locale format parsing by adding calls
 * to `useLocaleParser()`. This enables the automatic conversion of
 * locale specific date formats. For details see
 * @link http://book.cakephp.org/3.0/en/core-libraries/internationalization-and-localization.html#parsing-localized-datetime-data
 */
Type::build('time')
    ->useImmutable();
Type::build('date')
    ->useImmutable();
Type::build('datetime')
    ->useImmutable();

/*
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 */
//Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
//Inflector::rules('irregular', ['red' => 'redlings']);
//Inflector::rules('uninflected', ['dontinflectme']);
//Inflector::rules('transliteration', ['/å/' => 'aa']);

/*
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on Plugin to use more
 * advanced ways of loading plugins
 *
 * Plugin::loadAll(); // Loads all plugins at once
 * Plugin::load('Migrations'); //Loads a single plugin named Migrations
 *
 */

/*
 * Only try to load DebugKit in development mode
 * Debug Kit should not be installed on a production system
 */
if (Configure::read('debug')) {
    Plugin::load('DebugKit', ['bootstrap' => true]);
}

Plugin::load('Migrations');
Plugin::load('Crud');

Plugin::load('ADmad/JwtAuth');
Plugin::load('Search');

//Notificaciones de Fireba
Configure::write([
    'Push' => [
        'adapters' => [
            'Fcm' => [
                'api' => [
                    'key' => 'AAAAClVjgfE:APA91bGthqXNUtprPexTJ7axD1KmzFBiwRAqrZkabjXQ7IB4kZM1Hx6XayphngstS_gN3jEmf4aeDKIQQuzu1jva76j6fMGWkTBix1f8aD-EIkNEGL3anHBPAG2eDPEhAuq7exX3kw9a',
                    'url' => 'https://fcm.googleapis.com/fcm/send',
                ],
            ],
        ],
    ],
]);
Plugin::load('ker0x\Push', ['path' => ROOT]);

/**
 * Acá se definen las variables globales del sistema
 * Se crean variables globales estilo USR_GRP_CLIENT
 * @var [type]
 */
$variables_globales = [
    'USR_GRP' => [
        'SUPER_ADMIN'  => 1,  // super admin (no se puede crear ni borrar ni bloquear)
        'BASIC_ADMIN' => 2,  // admin básico
        'MID_ADMIN' => 3,  // admin medio
        'ADV_ADMIN' => 4,  // admin avanzado
        'CLIENT' => 5,  // persona humana, simple mortal, cliente
        'MECHANIC' => 6,  // persona humana, simple mortal, mecánico
    ]
];
foreach ($variables_globales as $group_key => $group) {
    foreach ($group as $key => $var) {
        if (! defined($group_key . '_' . $key)) {
            define($group_key . '_' . $key, $var);
        }
    }
}



/**
 * Functión para imprimir la fecha con formato dd/mm/YYYY HH:ii
 * @param String  $datetime_string String a imprimir con nuevo formato
 * @return String                  String con el formato deseado
 * @author Matías Pardo G. <matias.pardo@ideauno.cl>
 */
function datetime_fecha_horas($datetime_string) {
    $date = new DateTime($datetime_string);
    return $date->format('d/m/Y H:i');
}

/**
 * [get_server_url description]
 * @param  boolean $internal [description]
 * @param  boolean $full     [description]
 * @return [type]            [description]
 */
function get_server_url($internal = false, $full = false) {
    $s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
    $p = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr($p, 0, strpos($p, '/')) . $s;
    $name_addr = $internal ? $_SERVER['SERVER_ADDR'] : $_SERVER['HTTP_HOST'];
    $port = ($_SERVER['SERVER_PORT'] == '80') ? '' : (':'.$_SERVER['SERVER_PORT']);
    $uri = $_SERVER['REQUEST_URI'];
    return $protocol . '://' . $name_addr . $port . ($full ? $uri : '');
}//en get_server_url

/**
 * [__token description]
 * @param  integer $id [id user]
 * @param  integer $tiempo_expiracion     [tiempo de expiracion del token]
 * @return [string]            [token generado]
 */
function __token($id=0,$tiempo_expiracion=60){
    return \Firebase\JWT\JWT::encode([
        'sub' => $id,
        'exp' =>  time() + $tiempo_expiracion,
        'id' => $id
        ],
        Security::salt());
}//end __token


function __token_decode($token=null){
    $now = time();
    try{
        return ['token'=>\Firebase\JWT\JWT::decode($token, Security::salt(), ['HS256']),'now'=>$now];
    }catch(\Exception $e){
        return 0;
    }
}//end __token_user_id

function __token_user_id($token=null){
    try{
        $extract = __token_decode($token);
        if(isset($extract['token'])){
            if($extract['token']->exp>=$extract['now']){
                return $extract['token']->id;
            }
        }
        return 0;
    }catch(\Exception $e){
        return 0;
    }

}

// Incluir entonces ENUM
require_once "app_enums.php";

//Allow CORS
Plugin::load('Cors', ['bootstrap' => true, 'routes' => false]);

//Plugin Excel
Plugin::load('Cewi/Excel', ['bootstrap' => true, 'routes'=>true]);

// Load and config Theme
Plugin::load('AdminLTE', ['bootstrap' => true, 'routes' => false,'autoload'=>true]);
Configure::write('Theme', [
    'title' => 'Fullmec Administración',
    'logo' => [
        'mini' => '<b>F</b>M',
        'large' => '<b>Full</b>Mec'
    ],
    'login' => [
        'show_remember' => true,
        'show_register' => false,
        'show_social' => false
    ],
    'folder' => ROOT,
    // Ejemplo de Menú para Links
    // Single para 1 Links
    // Multiple para un padre con hijos, es decir, título con links hijos.
    // title = nombre mostrar para el links
    // icon = icono a mostrar en link.
    'menu' => [
        // Ejemplos
        /*['type'=>'single','controller'=>'Items','action'=>'index','icon'=>'fa fa-circle-o','title'=>'Demo single'],
          ['type'=>'multiple',
          'title' =>'Demo Multiple',
          'childs'=>[
            ['controller'=>'Users','action'=>'index','title'=>'User index'],
            ['controller'=>'Users','action'=>'add','title'=>'User add']
          ]
          ]
        Fin ejemplos */
        ['type'=>'single','controller'=>'Users','action'=>'index','icon'=>'fa fa-circle-o','title'=>'Usuarios'],
        ['type'=>'single','controller'=>'Items','action'=>'index','icon'=>'fa fa-circle-o','title'=>'Items'],
    ]
]);
