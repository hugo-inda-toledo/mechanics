<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
//use Cake\ORM\TableRegistry;

/**
 * Message component
 */
class MessageComponent extends Component
{

	// referencia: https://book.cakephp.org/3.0/en/controllers/components.html

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    // Enviar correo.
    // Parámetros en "data".
    // Para llamar métodos se hace
    // 1) cargar componente
    // public function initialize()
    // {
    //     parent::initialize();
    //     $this->loadComponent('Message');
    // }
    // 2: Llamar al método:
    // $this->Message->send($data);
    //
    public function send($data){

        $defaults = [
            'title'=>'Notificación Fullmec',
            'to'=> null,
            'body'=>  'Esto es un mensaje de Prueba',
            'subject'=> 'Notificación de Fullmec',
            'alias' => 'Fullmec dev', // que mostrar en vez del correo del remintente
            'template'=>'general', // template: Template/Email/general.ctp
            'layout'=>'general', // layout: Template/Layout/general.ctp
            'params' => [],  // parámetros para pasar a vista.
            'attachments' => []
        ];

        $data = array_merge($defaults,$data);

        // No tiene destinatario(s)
        if($data['to'] == null || $data['to'] == '' || (is_array($data) && (count($data['to']) == 0)) ){
            return false;
        }
        try {
            $email = new Email('default');
            $email
                ->template($data['template'],$data['layout'])
                ->emailFormat('html')
                ->to($data['to'])
                ->from([CFG_MAIL_USERNAME => $data['alias']])
                ->viewVars(['title' => $data['title'], 'params' => $data['params']])
                ->subject($data['subject']);

            $email->addAttachments($data['attachments']);

            $email->send($data['body']);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }






}
