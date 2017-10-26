<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::extensions(['json', 'xml']);


// Público
Router::scope('/', function (RouteBuilder $routes) {
    //$routes->resources('Users');
    //$routes->resources('Communes');

    //Router::connect('/api/users/register', ['controller' => 'Users', 'action' => 'add']);

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'index']);
    //$routes->connect('/login', ['controller' => 'Users', 'action' => 'login','prefix'=>'admin']);
    //$routes->connect('/admin', ['controller' => "Pages", 'action' => 'dashboard','prefix'=>'admin']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});


Router::prefix('admin', function ($routes) {
    $routes->extensions(['json', 'xml', 'xlsx']);

    // Login
    $routes->resources('Users');
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'dashboard']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

    // Base
    $routes->fallbacks('DashedRoute');
});


Router::prefix('api', function ($routes) {
    $routes->extensions(['json', 'xml']);
    $routes->resources('Cities');
    $routes->resources('Communes');
    $routes->resources('Users');
    $routes->resources('Roles');
    $routes->resources('Cars');

    Router::connect('/api/users/register', ['controller' => 'Users', 'action' => 'add', 'prefix' => 'api']);
    Router::connect('/api/reports/health', ['controller' => 'Reports', 'action' => 'health', 'prefix' => 'api']);

    // solicitudes
    $routes->resources('Requests');


    //Calificaciones
    $routes->resources('QualificationsToMechanics');

    // tipos de solicitudes
    $routes->resources('RequestsTypes');

    // tipos de servicios
    $routes->resources('AvailableServices');

    // metodos de pago
    $routes->resources('PaymentMethods');

    // facturas
    $routes->resources('Invoices');

    // Marcas de autos
    $routes->resources('CarBrands');

    // Modelos de autos
    $routes->resources('CarModels');

    // Modelos de ayudame a identificar mi problema
    $routes->resources('HelpsWheres');
    $routes->resources('HelpsWhatsups');
    $routes->resources('HelpsWhens');
    $routes->resources('HelpsSituations');
    $routes->resources('HelpsHowOftens');
    $routes->resources('Diagnostics');



    //Router::connect('/api/users/login', ['controller' => 'Users', 'action' => 'login', 'prefix' => 'api']);
    $routes->fallbacks('InflectedRoute');
});



/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
