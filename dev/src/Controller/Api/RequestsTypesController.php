<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

class RequestsTypesController extends AppController
{

    /**
     * @api {get} /api/requests_types/index Listar ciudades
     * @apiVersion 0.1.0
     * @apiName index
     * @apiGroup RequestsTypes
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
     *                "name": "Reparacion"
     *            },
     *     }
     *
     * @apiError RequestsTypeBadResponse Datos no encontrados
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function index()
    {
        $this->Crud->on('beforePaginate', function(Event $event) {
            $this->paginate = [
                'conditions' => ['RequestsTypes.active'=> true],
                'fields' => [
                    'RequestsTypes.id',
                    'RequestsTypes.name',
                    'RequestsTypes.car_is_optional',
                    ],
            ];
        });
        return $this->Crud->execute();
    }

}
