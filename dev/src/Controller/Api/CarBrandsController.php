<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;


class CarBrandsController extends AppController
{
    public $id_local = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize

    /**
     * @api {get} /api/cities/index Listar ciudades
     * @apiVersion 0.1.0
     * @apiName index
     * @apiGroup Cities
     *
     * @apiHeaderExample {String} Headers-Example:
     * Accept: application/json
     * Content-type: application/json
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data detalles de la ciudad.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": [
     *            {
     *                "id": "1",
     *                "name": "Santiago"
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

    public function index(){
        $user = $this->Auth->identify();
        $this->Crud->on('beforePaginate', function(Event $event) {
            $user = $this->Auth->identify();
            $this->paginate = [
                'conditions' => ['CarBrands.active'=> true],
                'fields' => [
                    'CarBrands.id',
                    'CarBrands.brand_name',
                    'CarBrands.brand_logo'
                    ],
            ];
        });
        return $this->Crud->execute();
    }//end index

}//end CarBrands
