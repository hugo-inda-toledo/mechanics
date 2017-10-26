<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

class CommunesController extends AppController
{
	private $city_id = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize


    /**
     * @api {get} /api/communes/index/(:city_id) Listar Comunas
     * @apiVersion 0.1.0
     * @apiName index
     * @apiGroup Communes
     *
     * @apiHeaderExample {String} Headers-Example:
     * Accept: application/json
     * Content-type: application/json
     *
     * @apiParam {Number} id Identificador de la ciudad
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data listar comunas de acuerdo a la ciudad.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": [
     *            {
     *                "id": "14",
     *                "name": "Las Condes",
     *                "city_id": 1,
     *                "city": {
     *                    "name": "Santiago"
     *                }
     *            },
     *     }
     *
     * @apiError CarBadResponse Datos no encontrados
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */

    public function index($id = null){
    	$this->city_id = $id;
        $this->Crud->on('beforePaginate', function(Event $event) {
        	$conditions = $this->city_id !=null ? ['Communes.city_id'=>$this->city_id,'Communes.active'=> true] : ['Communes.active'=> true];
            $this->paginate = [
            	'contain' => ['Cities'],
                'conditions' => $conditions,
                'fields' => [
                    'Communes.id',
                    'Communes.name',
                    'Communes.city_id',
                    'Cities.name'
                    ],
                'limit' => 100,
            ];
        });
        return $this->Crud->execute();
    }//end index
}