<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Firebase\JWT\JWT;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Filesystem\File;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{
    public $hash_activate = null;
    public $photo_url= null;
    public $id_user = null;

    public function initialize()
    {
        parent::initialize();
        // $this->Auth->allow(['add', 'token']);
        $this->loadComponent('Message');
        $this->Auth->allow(['add','login','token','recover_password','activated_account']);
    }//end initialize

    /**
     * @api {post} /api/users/register Crea un cliente/mecanico
     * @apiVersion 0.1.0
     * @apiName Add
     * @apiGroup Users
     *
     * @apiParam {Number} role_id (5) Cliente / (6) Mecanico.
     * @apiParam {String} name Nombre.
     * @apiParam {String} last_name Apellido.
     * @apiParam {String} email Correo Electronico.
     * @apiParam {String} phone1 Teléfono.
     * @apiParam {String} address_name Calle.
     * @apiParam {String} address_nummber Numero.
     * @apiParam {String} address_complement Complemento.
     * @apiParam {Number} city_id Id Ciudad.
     * @apiParam {Number} commune_id Id Comuna.
     * @apiParam {String} password Contraseña.
     * @apiParam {String} confirm_password Repetir contraseña.
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data [id,toke,message].
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": ["id":1, "token":"tokenTokenToKen", "message":"Se ha enviado un correo para la activación de tu cuenta"],
     *     }
     *
     * @apiError UserBadResponse El usuario no ha podido crearse
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 400 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */

    public function add()
    {
        $this->hash_activate = Security::hash(Text::uuid());
        //En este lugar, van la validaciones que no se hacen por modelo
        $this->Crud->on('beforeSave', function(Event $event) {
                $event->subject->entity->active = false;// se envia false para que luego desde la validacion de correo se cambie a true
                $event->subject->entity->hash_activate = $this->hash_activate;
        });
        //$roles = $this->Users->Roles->find('list', ['active' => 1]);
        //$this->set(compact('roles'));

        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                //aqui se debe realizar el envio del mail al cliente para que valide el correo y/o bienvenida a mecanico
                $this->_send_mail_register($event->subject->entity, $this->hash_activate);

                //Se debe cambiar el tiempo de expiración del token, por ahora será de un minuto establecido en bootstrap.php
                // (604800)
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => __token($event->subject->entity->id, CFG_TIME_TOKEN),
                    'message'=>'Se ha enviado un correo para la activacion de tu cuenta!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }//end add

    /**
     * @api {post} /api/users/login Iniciar session
     * @apiVersion 0.1.0
     * @apiName login
     * @apiGroup Users
     *
     * @apiParam {String} email Correo electronico
     * @apiParam {String} password Contraseña.
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data [token] el token se debe pasar en el headers Authorization Bearer {Your_Token} para poder moverse en la aplicacion.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": ["token":"tokenTokenToKen"],
     *     }
     *
     * @apiError UserBadResponse El usuario no ha podido crearse
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 400 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */

    public function login(){

        if($this->request->is('post')) {
            $user = $this->Auth->identify();
            if (!$user) {
                throw new UnauthorizedException('Invalid username or password');
            }
            //se debe realizar a donde sera redirigido el usuario una vez logueado
            //
            $this->set('data', [
                'id' => $user['id'],
                'token' => __token($user['id'], CFG_TIME_TOKEN),
                'message'=>'Has ingresado correctamente'
                ]);
        }
        else{
          throw new UnauthorizedException('Access method not available');
        }


        /////====================================================================
        /// para consumir los servicios de la API
        /// se debe tener en cuenta que la APP cliente debe modificar los headers
        /// para que envie el token que retornó el login
        /// Authorization: Bearer {YOUR-JWT-TOKEN-LOGIN-RETURN}
        ///
        /// Ejemplo:
        ///
        /// Accept: application/json
        /// Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQ5LCJleHAiOjE0ODcxODczOTksImlkIjo0OX0.9kG0EFGoOBNSDiZClicqxXbRxWkqVkLC7DjpyPaOU88
        ///
        /// se debe ir actualizando el token cada vez que se realice acciones en la APP
        /////
        ///
    }//end login

    /**
     * @api {post} /api/users/recover_password Recuperar contraseña
     * @apiVersion 0.1.0
     * @apiName recover_password
     * @apiGroup Users
     *
     * @apiParam {String} email Correo electronico
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data [token,message] token y mensaje de, se ha enviado un correo para recuperar la contraseña.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": ["token":"tokenTokenToKen", "message": "Se ha enviado un correo a su mail para reestablecer la contraseña"],
     *     }
     *
     * @apiError UserBadResponse Correo no encontrado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
     /**
     * @api {get} /api/users/recover_password/hash_enviado_correo Recuperar contraseña
     * @apiVersion 0.1.0
     * @apiName recover_password
     * @apiGroup Users
     *
     * @apiParam {String} hash Hash enviado al correo
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data [token,message] aqui se depliega el form para ingresar las nuevas claves.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": ["token":"tokenTokenToKen", "message": "Se ha enviado un correo a su mail para reestablecer la contraseña"],
     *     }
     *
     * @apiError UserBadResponse Hash no encontrado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function recover_password($hash=null){
        if($this->request->is('post')){
            // Si recibe un post, se verifica el mail
            $email = $this->request->data['email'];
            $user = $this->Users->findByEmail($email)->first();

            if (empty($user->email)) {
                throw new UnauthorizedException('Email not found');
            } else {
                // Se genera una pass temporal
                $tempPass = Security::hash(Text::uuid());
                // Se guarda la pass temporal en la bd
                $user->temp_pass = $tempPass;
                $this->Users->save($user);
                // Se envía un mail con la pass Temporal (un link a restorePassword/[$tempPass])
                $contenido_correo =
                        'Saludos ' . $user->name . ' ' . $user->last_name . ':<br>' .
                        '<br>' .
                        'El sistema ha recibido una solicitud de recuperación de contraseña de su cuenta.<br>' .
                        'Para proseguir con el reestablecimiento de su contraseña ingrese en la siguiente dirección:<br>' .
                        '<br>' . get_server_url() . '/#/confirm-recover-password/' . $tempPass . '<br><br>' .
                        'No responda este mail, ha sido generado de manera automática.'
                        ;
                $data = [
                    'title'=>'Recuperar Contraseña',
                    'to'=>$user->email,
                    'body'=>  $contenido_correo,
                    'subject'=> 'Recuperar Contraseña'
                ];
                $this->Message->send($data);

                if ($email) {
                    $this->set([
                        'success' => true,
                        'data' => [
                            'token' => __token($user->id,CFG_TIME_TOKEN),
                            'message' => 'Se ha enviado un correo a su mail para reestablecer la contraseña.'
                            ],
                        '_serialize' => ['success', 'data']
                    ]);
                } else {
                    $this->Flash->error("No se pudo enviar el correo para reestablecer contraseña.");
                    $this->set([
                        'success' => False,
                        'data' => [
                                'msg' => 'No se pudo enviar el correo para reestablecer contraseña..'
                            ],
                        '_serialize' => ['success', 'data']
                    ]);
                }
            }

        }else if($this->request->is('put')){
            //recibir datos para cambio de clave
            $hash = $this->request->data['hash'];
            $password = $this->request->data['password'];
            $user = $this->Users->findByTempPass($hash)->first();
            if (!empty($user->email) && $password!='') {
                $user->password = $password;
                $user->temp_pass = null;
                $this->Users->save($user);
                $this->set([
                    'success' => true,
                    'data' => [
                            'msg' => 'Se ha cambiado exitosamente la contraseña.'
                        ],
                    '_serialize' => ['success', 'data']
                ]);
            }

        }else if(isset($hash) && $hash!=null){
            //realizar despligue para cambio de clave
            $user = $this->Users->findByTempPass($hash)->first();

            if (empty($user->email)) {
                throw new UnauthorizedException('Hash not found');
            }else{
                $this->set([
                        'success' => true,
                        'data' => [
                            'token' => __token($user->id,CFG_TIME_TOKEN),
                            'message' => 'Solicitar datos para cambio de clave'
                        ],
                        '_serialize' => ['success', 'data']
                ]);
                //redirigir al form donde se piden la nueva clave
                $this->set('form','request_data');
                $this->set('hash',$hash);
            }
        }else{
            $this->set('form','send_mail');
        }
    }//end recover_password

    /**
     * @api {post} /api/users/token Iniciar session
     * @apiVersion 0.1.0
     * @apiName token
     * @apiGroup Users
     *
     * @apiParam {String} email Correo electronico
     * @apiParam {String} password Contraseña.
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data [token] el token se debe pasar en el headers Authorization Bearer {Your_Token} para poder moverse en la aplicacion.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": ["token":"tokenTokenToKen"],
     *     }
     *
     * @apiError UserBadResponse El usuario no ha podido crearse
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 400 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function token() {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Session expire / Invalid Username or Password');
        }

        $this->set([
            'success' => true,
            'data' => [
                    'token' => __token($user['id'],CFG_TIME_TOKEN),
                    'role'  => $user['role_id'],
                    'name'  => $user['name'],
                    'last_name' => $user['last_name']
            ],
            '_serialize' => ['success', 'data']
        ]);
    }//end token

    public function _send_mail_register($user, $token_activate){
        $email = new Email('default');

        if($user->role_id==USR_GRP_MECHANIC){
            //correo de bienvenida
            $titulo = 'Bienvenido '.$user->name . ' ' . $user->last_name;
            $contenido_correo =
            'Saludos <b>' . $user->name . ' ' . $user->last_name . ',</b><br>' .
            '<br>' .
            'El sistema ha recibido una solicitud de registro de mecánico.<br>' .
            '<b>Fullmec</b> te contactará a la brevedad posible para completar la activación de tu cuenta.' . '<br><br>' .
            'No responda este mail, ha sido generado de manera automática.';

        }else if($user->role_id==USR_GRP_CLIENT){
            //correo para activar su cuenta
            $titulo = 'Activar Cuenta';
            $contenido_correo =
            'Saludos <b>' . $user->name . ' ' . $user->last_name . ',</b><br>' .
            '<br>' .
            'El sistema ha recibido una solicitud de registro de usuario.<br>' .
            'Para proseguir con la activacion de tu cuenta ingrese en la siguiente dirección:<br>' .
            '<br>' . get_server_url() . '/api/users/confirm-register/' . $token_activate . '<br><br>' .
            'No responda este mail, ha sido generado de manera automática.';

        }

        if(isset($contenido_correo)){
                $data = [
                    'title'=>$titulo,
                    'to'=>$user->email,
                    'body'=>  $contenido_correo,
                    'subject'=> $titulo
                ];
                $this->Message->send($data);
        }

    }//end _send_mail_register

    /**
     * @api {get} /api/users/activated_account Activar cuenta solo para clientes
     * @apiVersion 0.1.0
     * @apiName activated_account
     * @apiGroup Users
     *
     * @apiParam {String} hash_activate Hash enviado al correo
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data [token,redirec] regresa el token y la direccion para redireccionar.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": ["token":"tokenTokenToKen"],
     *     }
     *
     * @apiError UserBadResponse Hash not found
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 400 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */

    public function activated_account($hash){
        $user = $this->Users->findByHashActivate($hash)->first();
        if (empty($user->email)) {
            //throw new UnauthorizedException('Hash not found');
        }else{
            $user->active = True;
            $user->hash_activate = null;
            $this->Users->save($user);
            $this->Auth->setUser($user);
            $this->set([
                'success' => true,
                'data' => [
                        'token' => __token($user->id,CFG_TIME_TOKEN)
                ],
                '_serialize' => ['success', 'data']
            ]);

        }
    }//end activated_account

    public function logout(){
        //el logout se debe realizar desde la app cliente,
        //quitando el token en el headers authorization
        //
    }//end logout


    public function view($id = null ){
        $user = $this->Auth->identify();

        $this->set([
            'success' => true,
            'data' => $user,
            '_serialize' => ['success', 'data']
        ]);
    }

    public function photo($id = null){
        $this->viewBuilder()->layout('ajax');
        $user = $this->Auth->identify();
        $this->id_user = $id = $user['id'];
        $user = $this->Users->get($id);

        //Borro imagen vieja
        if(file_exists(WWW_ROOT. $user['photo_url'])){
          $old_file= new File( WWW_ROOT. $user['photo_url'], false, 0777);
          if($old_file->delete()){}
        }

        if($this->request->is(['patch', 'post', 'put'])){

            //verificar archivo subido
            //debug($this->request);
            if(!empty($this->request->data['file'])){
                $uid = Security::hash(Text::uuid());
                $types = ['image/jpeg'=>'jpg','image/jpg'=>'jpg','image/png'=>'png','image/gif'=>'gif','image/bmp'=>'bmp',];
                $new_name = isset($types[$this->request->data['file']['type']]) ? '.'.$types[$this->request->data['file']['type']] : '.jpg';
                $name = $id.$new_name;//str_replace(" ", "", $this->request->data['file']['name']);

                $uploadPath = 'img/profiles_img/';
                $uploadFile = $uploadPath.$uid.$name;

                if(move_uploaded_file($this->request->data['file']['tmp_name'], $uploadFile)){
                    $this->request->data['photo_url'] = $uploadFile;
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    if($this->Users->save($user)){
                        echo json_encode(['success'=>true,'data'=>['message'=>'Actualizado', 'dir_file'=> $uploadFile]]);
                    }else{
                        echo json_encode(['success'=>false,'data'=>['message'=>'No Actualizado.']]);
                    }
                }
            }else{
                echo json_encode(['success'=>false,'data'=>['message'=>'No Actualizado..']]);
            }
        }//end request is
        else{
            echo json_encode(['success'=>false,'data'=>['message'=>'No Actualizado...']]);
        }
        $this->autoRender = false;
    }//end photo

    public function edit($id = null ){
        $user = $this->Auth->identify();
        $this->id_user = $id = $user['id'];

        $this->Crud->on('beforeFind', function(Event $event) {
            $event->subject()->query->where(['id' => $this->id_user]);
        });

        $this->Crud->on('beforeSave', function(Event $event) {
            $event->subject()->entity->id = $this->id_user;
            //$event->subject()->entity->user_id = $user['id'];
        });
        $this->Crud->on('afterSave', function(Event $event) {
            if (!$event->subject->created) {
            	 $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'message'=>'Registro editado exitosamente!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }else{

            }
        });
        return $this->Crud->execute();
    }//end edit


    public function change_password($id = null ){
      $auser = $this->Auth->identify();
      $user = $this->Users->findByEmail($auser['email'])->first();

      $this->id_user = $id = $user['id'];
      $oldpassword = $this->request->data['oldpassword'];
      $password= $this->request->data['password'];

      $checkPassword= (new DefaultPasswordHasher)->check($oldpassword, $user['password']);
      if($checkPassword && $password!=''){

        $user->password = $password;
        $this->Users->save($user);
        $this->set([
            'success' => true,
            'data' => [
                    'msg' => 'Se ha cambiado exitosamente la contraseña.'
                ],
            '_serialize' => ['success', 'data']
        ]);
      }
      else{
        if(!$checkPassword){
          $msgError= 'La contraseña indicada no es correcta. Intente de nuevo.';
        }
        else{
          $msgError= 'Ha habido un error.';
        }

        $this->set([
            'success' => false,
            'data' => [
                    'msg' => $msgError
                ],
            '_serialize' => ['success', 'data']
        ]);
      }

    }



}//end UsersController
