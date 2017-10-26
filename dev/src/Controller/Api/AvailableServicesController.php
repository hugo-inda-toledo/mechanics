<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;


class AvailableServicesController extends AppController
{
    public $id_request_type = null;

    /**
     * @api {get} /api/available_services/index/request_type_id Listar servicios disponibles
     * @apiVersion 0.1.0
     * @apiName index
     * @apiGroup AvailableServices
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
     *                "requests_type_id": "1",
     *                "name": "Reparacion",
     *                "description": "Reparacion",
     *                "estimated_time": "0",
     *                "real_estimated_time": "0",
     *                "inspection": "0",
     *            },
     *     }
     *
     * @apiError AvailableServicesBadResponse Datos no encontrados
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function index($id = null)
    {
        $this->id_request_type = isset($id) && $id!=null ? $id : 0;

        $this->Crud->on('beforePaginate', function(Event $event) {
            $this->paginate = [
                'conditions' => ['AvailableServices.active'=> true, 'AvailableServices.requests_type_id'=> $this->id_request_type],
                'fields' => [
                    'AvailableServices.id',
                    'AvailableServices.name',
                    'AvailableServices.description',
                    'AvailableServices.estimated_time',
                    'AvailableServices.real_estimated_time',
                    'AvailableServices.inspection',
                    ],
            ];
        });
        return $this->Crud->execute();
    }


}
