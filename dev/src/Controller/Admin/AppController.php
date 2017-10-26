<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler', [
            'viewClassMap' => ['xlsx' => 'Cewi/Excel.Excel']
        ]);

        $this->loadComponent('Auth', [
            'authenticate' => [
            'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'dashboard'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'index',
                'prefix' => false
            ],
            'unauthorizedRedirect' => [
                 'controller' => 'Users',
                 'action' => 'login',
             ],
            'authError' => 'No estas autorizado para acceder a ese módulo.',
            'flash' => [
                'element' => 'error'
            ]
        ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        /*if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }*/

        // Permitir "login"
        //$this->Auth->allow(['/admin/users/login']);

        // set theme
        $this->viewBuilder()->theme('AdminLTE');
        $this->set('theme', Configure::read('Theme'));

        // set user data.
        $this->set('loggedIn', $this->request->session()->read('Auth'));
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if($this->request->session()->read('Auth.User'))
        {
            // comentar esta linea para que funcione auth
            // $this->Auth->allow();
            // funciones que no requieren permiso
            if (! ($this->request->params['controller'] == 'Users' && (
                $this->request->params['action'] == 'login' ||
                $this->request->params['action'] == 'logout' ||
                $this->request->params['action'] == 'forgottenPassword' ||
                $this->request->params['action'] == 'restorePassword'
                ))) {

                // hugo: verifica el acceso al controlador y la acción
                //$this->verifyAccess();
                // hugo: fin

            }
        }
        else
        {
            if (! ($this->request->params['controller'] == 'Users' && (
                $this->request->params['action'] == 'login' ||
                $this->request->params['action'] == 'logout' ||
                $this->request->params['action'] == 'forgottenPassword' ||
                $this->request->params['action'] == 'restorePassword'
                //$this->request->params['action'] == 'home'
                ))) {

                //$this->redirect('/users/login');

            }

        }
    }

    public function verifyAccess()
    {
        if(!$this->request->is('ajax'))
        {
            $access = false;

            if(count($this->request->session()->read('Auth.Role')) > 0)
            {
                foreach($this->request->session()->read('Auth.Role.permissions') as $perm)
                {
                    if($perm->controller == $this->request->params['controller'] && $perm->action == $this->request->params['action'])
                    {
                        $access = true;
                        break;
                    }
                }
            }

            if($access == false)
            {
                $this->Flash->error('No tienes acceso a esta pagina. Contacta al administrador del sitio para obtener acceso.');
                $this->redirect(['controller' => 'Pages', 'action' => 'dashboard']);
            }
        }
    }

}
