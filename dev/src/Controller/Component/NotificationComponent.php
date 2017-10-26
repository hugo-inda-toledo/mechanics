<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use ker0x\Push\Adapter\FcmAdapter;
use ker0x\Push\Push;
//use Cake\ORM\TableRegistry;

/**
 * Notification component
 */
class NotificationComponent extends Component
{

	// referencia: https://book.cakephp.org/3.0/en/controllers/components.html

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    // Enviar notificaciones.
    // Parámetros en "data".
    // Para llamar métodos se hace
    // 1) cargar componente
    // public function initialize()
    // {
    //     parent::initialize();
    //     $this->loadComponent('Notification');
    // }
    // 2: Llamar al método:
    // $this->Notification->send($data);
    //
    public function send($data){

        $defaults = [
            'title'=>'Notificación Fullmec',
            'body'=>  'Esto es un mensaje de Prueba',
            'tokensId' => [],
            'data' =>[]
        ];

        $data = array_merge($defaults,$data);

        // No tiene destinatario(s)
        if($data['tokensId'] == null || $data['tokensId'] == '' || (is_array($data) && (count($data['tokensId']) == 0)) ){
            return false;
        }
        try {
            $adapter = new FcmAdapter();

            $adapter
                ->setTokens($data['tokensId'])
                ->setNotification([
                    'title' => $data['title'],
                    'body' =>  $data['body']
                ]);

                if($data['data']  && count($data['data']>0) ){
                  $adapter->setDatas($data['data']);
                }
                /*->setDatas([
                    'data-1' => 'Lorem ipsum',
                    'data-2' => 1234,
                    'data-3' => true
                ]);*/

            $push = new Push($adapter);

            // Make the push
            $result = $push->send();

            // Get the response
            $response = $push->response();

            //ToDo: Agregar en BD la notificacion enviada: userId, tokenId, message, title, date, isRead

            return true;
        } catch (Exception $e) {
            return false;
        }

    }






}
