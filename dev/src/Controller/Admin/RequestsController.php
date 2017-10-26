<?php
namespace App\Controller\Admin;

use Ideauno\RequestStatus;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Routing\Router;


/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow('excelToBills');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      $this->paginate = [
        'contain' => ['Clients', 'Mechanics', 'Cars' => ['CarBrands', 'CarModels'], 'Communes', 'AvailableServices' => ['Replacements', 'Supplies'], 'Cities', 'Payments', 'PurchaseOrders' => ['Replacements', 'Supplies']],
        'order' => [
          'Requests.created' => 'DESC'
        ]
      ];
      $requests = $this->paginate($this->Requests);
      /*echo '<pre>';
      print_r($requests->toArray());
      echo '</pre>';
      die;*/

      //$requests = $this->Requests->find('all')->contain(['Cars', 'Communes', 'Clients', 'Mechanics', ])->toArray();

      $this->set(compact('requests'));
      $this->set('_serialize', ['requests']);
    }

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => ['Clients', 'Mechanics', 'Cars' => ['CarBrands', 'CarModels'], 'Communes', 'AvailableServices' => ['Replacements', 'Supplies'], 'Cities', 'Payments', 'PurchaseOrders' => ['Replacements', 'Supplies']]
        ]);

        $this->set('request', $request);
        $this->set('_serialize', ['request']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $request = $this->Requests->newEntity();
        if ($this->request->is('post')) {

            $this->loadModel('Communes');
            $this->loadModel('Cities');

            $this->request->data['Request']['status'] = RequestStatus::Abierta;
            $this->request->data['Request']['active'] = 1;
            $this->request->data['Request']['sent_to_bill'] = 0;
            $this->request->data['Request']['mechanic_search_count'] = 0;

            $commune = $this->Communes->get($this->request->data['Request']['commune_id']);
            $city = $this->Cities->get($this->request->data['Request']['city_id']);

            $address = $this->request->data['Request']['address_name']." ".$this->request->data['Request']['address_number'].", ".$commune->commune_name.", ".$city->name;

            $address = str_replace(" ", "+", $address);

            $json = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false");
            $json = json_decode($json, true);
            
            $this->request->data['Request']['latitude'] = $json['results'][0]['geometry']['location']['lat'];
            $this->request->data['Request']['longitude'] = $json['results'][0]['geometry']['location']['lng'];

            $date_request = new Date($this->request->data['Request']['start_time_schedule_requested']);
            $this->request->data['Request']['start_time_schedule_requested'] = $date_request;
            
            $request = $this->Requests->patchEntity($request, $this->request->data['Request']);

            if ($this->Requests->save($request))
            {

              if($this->request->data['AvailableServices']['available_service_id'] != null)
              {
                $new = array();
                $total = 0;
                $available_services_ids = '';

                $this->loadModel('AvailableServices');

                foreach($this->request->data['AvailableServices']['available_service_id'] as $key => $value)
                {
                  $new[] = array('request_id' => $request->id, 'available_service_id' => $value);
                  $service = $this->AvailableServices->get($value);
                  $total += $service->price;
                  $available_services_ids .= $value.', ';
                }

                $requests_available_services = TableRegistry::get('RequestsAvailableServices');
                $entities = $requests_available_services->newEntities($new);
                $requests_available_services->saveMany($entities);

              }

              $available_services_ids = substr($available_services_ids, 0, -2);

              $request->total_price = $total;
              $this->Requests->save($request);

              return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }

        $clients = $this->Requests->Clients->find('list', [
                      'valueField' => function ($row){
                        return $row['name'].' '.$row['last_name'];
                      }
                    ])
                    ->where(['Clients.active' => '1' , 'Clients.role_id' => '5'])
                    ->toArray();

        $mechanics = $this->Requests->Mechanics->find('list', [
                      'valueField' => function ($row){
                        return $row['name'].' '.$row['last_name'];
                      }
                    ])
                    ->where(['Mechanics.active' => '1' , 'Mechanics.role_id' => '6'])
                    ->toArray();

        $this->loadModel('RequestsTypes');
        $services = $this->RequestsTypes->find('all')
                    ->contain([
                      'AvailableServices' => function ($q){
                        return $q->order(['AvailableServices.name' => 'ASC']);
                      }

                    ])
                    ->order(['RequestsTypes.name' => 'ASC'])
                    ->toArray();

        $services_list = array();
        foreach($services as $service)
        {
          foreach($service->available_services as $available_service)
          {
            $services_list[$service->name][$available_service->id] = $available_service->name;
          }
        }

        $this->set(compact('request', 'clients', 'mechanics', 'services_list'));
        $this->set('_serialize', ['request']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $clients = $this->Requests->Users->find('list', array('conditions' => ['Users.active' => '1' , 'Users.role_id' => '5']))->toArray();
        $mechanics = $this->Requests->Users->find('list', array('conditions' => ['Users.active' => '1' , 'Users.role_id' => '6']))->toArray();
        $requestsTypes = $this->Requests->RequestsTypes->find('list', ['limit' => 200]);
        $cars = $this->Requests->Cars->find('list', ['limit' => 200]);
        $communes = $this->Requests->Communes->find('list', ['limit' => 200]);
        $this->set(compact('request', 'clients', 'mechanics','requestsTypes', 'cars', 'communes'));
        $this->set('_serialize', ['request']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
    *Este servicio necesita recibir:
    * a) Lista de servicios solicitados (request_services)
    * b) Categoria de servicio escogida (requests_types)
    * c) Un bloque horario y fecha
    * d) Un codigo de auto (opcional para un requests_types)
    * e) Tipo de documento de pago
    *
    * Debe devolver una asginacion de mecanico. Para ello se requiere un algortimo que verifique que el mecanico:
    * a) Tenga en su horario disponibilidad en el horario solicitado
    * b) Tenga marcada la categoria entre sus habilidades
    * c) Tenga registrado el area para trabajar
    */
    public function ask(){

    }

    /** HU2.1.23 Aceptar/rechazar modificacion de servicio en terreno por cliente.
    *
    */
    public function acceptModByClient(){

    }


    /**
    *HU2.3.3 Aceptar/rechazar solicitud por mecanico
    */
    public function acceptRequestByMechanic($request_id = null, $mechanic_id = null)
    {
      if($request_id != null && $mechanic_id)
      {
        $request = $this->Requests->find('all')
                  ->where([
                    'Requests.id' => $request_id
                  ])
                  ->first();

        if($request != null)
        {
          $this->loadModel('ScheduleLogs');
          $schedule_logs = $this->ScheduleLogs->find('all')
                          ->where([
                            'ScheduleLogs.request_id' => $request->id,
                            'ScheduleLogs.mechanic_id' =>$mechanic_id
                          ])
                          ->toArray();

          if($schedule_logs != null)
          {
            $this->loadModel('Schedules');

            foreach($schedule_logs as $log)
            {
              $log->answered = 2;
              $this->ScheduleLogs->save($log);
            }

            $request->mechanic_id = $mechanic_id;
            $request->status = RequestStatus::EnEsperaTrabajo;

            $this->Requests->save($request);



            $this->Flash->success(__('The request has been assigned.'));
            return $this->redirect(['action' => 'index']);
          }
        }
      }
    }

    /**
    * Un admin puede editar una solicitud en curso y cambiar el mecanico a cargo
    */
    public function editMechanic($id){
      $request = $this->Requests->get($id, [
          'contain' => []
      ]);
      if ($this->request->is(['patch', 'post', 'put'])) {
          $request = $this->Requests->patchEntity($request, $this->request->data);
          if ($this->Requests->save($request)) {
              $this->Flash->success(__('The request has been saved.'));

              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The request could not be saved. Please, try again.'));
      }
      $mechanics = $this->Requests->Mechanics->find('list', [
                    'valueField' => function ($row){
                      return $row['name'].' '.$row['last_name'];
                    }
                  ])
                  ->where(['Mechanics.active' => '1' , 'Mechanics.role_id' => '6'])
                  ->toArray();

      $this->set(compact('request', 'mechanics'));
      $this->set('_serialize', ['request']);
    }



    /**
    *H2.3.11 Modificar solicitud en terreno: Un mecanico puede realizar modificaciones al servicio, debe ser aprobado por un cliente (acceptModByClient).
    */
    public function modByMechanic(){

    }

    /**
    *Se envia mail con link de cotizacion a cliente para que la confirme/rechaze.
    * La ruta del link debe ser algo asi como fullmec/#/requests/:requestId/confirmation/
    */
    private function sendEmailWithEstimate(){

    }


    /**
    * Se debe enviar un link con una encuesta a mecanicos y clientes al completar una solicitud.
    */
    private function sendEmailWithSurvey(){

    }


    /*
    * Se debe enviar un mail recordatorio si un usuario no ha contestado una encuesta en un tiempo determinado
    */
    private function sendReminderEmail(){

    }

    /*
    * Se debe enviar un mail a un cliente cuando a su vehiculo necesite de un mantenimiento
    */
    private function sendMaintenanceEmail(){

    }

    /**
    * HU2.3.5. Protocolo de buen servicio
    * Se debe enviar un mail con el protocolo del buen servicio a los mecanicos
    */
    private function sendEmailProtocolGoodService(){

    }

    /*
    *Se debe enviar un mail a un cliente con promociones, descuentos y cupones
    */
    private function sendPromotionalEmail(){

    }


    /**
    *Una vez finalizado la solicitud, el usuario puede descargar un pdf que representa los servicios realizados.
    */
    public function getPdfRequest(){

    }


    /**
    * Se puede cancelar una solicitud, se pueden aplicar costos asociados dependiendo de la distancia a la que se encuentre el mecanico.
    */
    public function cancelByClient($request_id = null)
    {
      if($request_id != null)
      {
        $request = $this->Requests->get($request_id, ['contain' => ['Payments']]);
        $request->status = RequestStatus::AnuladaCliente;

        if($request->payment != null)
        {
          if($request->payment->paid == 1)
          {
            $schedule_time = New Time($request->start_time_schedule_requested);
            $now = Time::now();

            $diff = $schedule_time->diff($now);
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            $hours = $hours + ($diff->i / 60);

            if($hours <= 24 && $hours >= 4)
            {
              $this->loadModel('Payments');
              $request->payment->penalty_payment = 5000;
              $request->payment->penalty_paid = 0;
              $this->Payments->save($request->payment);
            }
            elseif($hours < 4)
            {
              $this->loadModel('Payments');
              $request->payment->penalty_payment = 25000;
              $request->payment->penalty_paid = 0;
              $this->Payments->save($request->payment);
            }
          }
        }

        if ($this->Requests->save($request))
        {
          $this->Flash->success(__('The request has been updated.'));
          return $this->redirect(['action' => 'index']);
        }
      }
    }

    /**
    * HU2.2.8  Cancelar servicio por no poder realizar
    * Mecanico indica motivo y descripcion de esta. Se envia mail a admin y cliente.
    */
    public function cancelByMechanic($request_id = null)
    {
      if($request_id != null)
      {
        $request = $this->Requests->get($request_id);
        $request->status = RequestStatus::AnuladaMecanico;

        $this->loadModel('ScheduleLogs');
        $logs = $this->ScheduleLogs->find('all')
                ->where([
                  'ScheduleLogs.request_id' => $request->id,
                  'ScheduleLogs.mechanic_id' => $request->mechanic_id
                ])
                ->toArray();

        if(count($logs) > 0)
        {
          foreach($logs as $log)
          {
            $log->answered = 1;
            $this->ScheduleLogs->save($log);
          }
        }

        if ($this->Requests->save($request))
        {
          $this->Flash->success(__('The request has been updated.'));
          return $this->redirect(['action' => 'index']);
        }
      }
    }

    public function assignMechanic($id = null)
    {
      if($id != null)
      {
        $request = $this->Requests->get($id);
        $mechanics = $this->Requests->Mechanics->find('list', [
                      'valueField' => function ($row){
                        return $row['name'].' '.$row['last_name'];
                      }
                    ])
                    ->where(['Mechanics.active' => '1' , 'Mechanics.role_id' => '6'])
                    ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {

          $request = $this->Requests->get($this->request->data['id']);
          $request->mechanic_id = $this->request->data['mechanic_id'];
          $request->status = RequestStatus::EnEsperaPago;

          if ($this->Requests->save($request))
          {
            $this->Flash->success(__('The request has been updated.'));
            return $this->redirect(['action' => 'index']);
          }

          $this->Flash->error(__('The request could not be updated. Please, try again.'));

        }

        $this->set(compact('request', 'mechanics', 'id'));
        $this->set('_serialize', ['request']);
      }
    }

    function markInCourse($request_id = null)
    {
      if($request_id != null)
      {
        $request = $this->Requests->get($request_id, [
                    'contain' => [
                      'ScheduleLogs' => [
                        'Schedules'
                      ]
                    ]
                  ]);
        $request->status = RequestStatus::EnCurso;
        $this->loadModel('Schedules');
        foreach($request->schedule_logs as $log)
        {
          $log->schedule->is_available = 0;
          $this->Schedules->save($log->schedule);
        }
        

        if ($this->Requests->save($request))
        {
          $this->Flash->success(__('The request has been marked on course.'));
          return $this->redirect(['action' => 'index']);
        }
      }
    }

    function markFinish($request_id = null)
    {
      if($request_id != null)
      {
        $request = $this->Requests->get($request_id, [
                    'contain' => [
                      'ScheduleLogs' => [
                        'Schedules'
                      ]
                    ]
                  ]);
        $request->status = RequestStatus::Finalizada;
        $this->loadModel('Schedules');

        foreach($request->schedule_logs as $log)
        {
          $this->loadModel('Schedules');
          $log->schedule->is_available = 1;
          $this->Schedules->save($log->schedule);
        }

        if($this->Requests->save($request))
        {
          $this->Flash->success(__('The request has been finished.'));
          return $this->redirect(['action' => 'index']);
        }
      }
    }

    function salesSearch()
    {

    }

    public function salesResult()
    {
        if($this->request->is('post'))
        {
            $dates = explode('-', $this->request->data['range']);

            $month = $dates[0];
            $year = $dates[1];

            $this->loadModel('Payments');
            $payments = $this->Payments->find('all')
                    ->contain([
                        'Requests' => [
                            'Mechanics',
                            'Clients',
                            'Cars' => [
                              'CarBrands',
                              'CarModels'
                            ],
                            'Cities',
                            'Communes',
                            'AvailableServices'
                        ],
                        'PaymentMethods'
                    ])
                    ->where([
                        'Payments.paid' => 1,
                        'MONTH(Payments.created)' => $month,
                        'YEAR(Payments.created)' => $year
                    ])
                    ->toArray();

            if(count($payments) > 0)
            {
              $this->set('done_payments', $payments);
              $this->set('year', $year);
              $this->set('month', $month);
            }
            else
            {
                $this->Flash->error(__('No existen pagos para el mes/año seleccionado'));
                $this->redirect(['action' => 'salesSearch']);
            }
        }
    }

    function salesResultExport()
    {
      if($this->request->is('post'))
      {
        $this->loadModel('Payments');
        $payments = $this->Payments->find('all')
                ->contain([
                    'Requests' => [
                        'Mechanics',
                        'Clients',
                        'Cars' => [
                          'CarBrands',
                          'CarModels'
                        ],
                        'Cities',
                        'Communes',
                        'AvailableServices'
                    ],
                    'PaymentMethods'
                ])
                ->where([
                    'Payments.paid' => 1,
                    'MONTH(Payments.created)' => $this->request->data['month'],
                    'YEAR(Payments.created)' => $this->request->data['year']
                ])
                ->toArray();

        if(count($payments) > 0)
        {
          foreach($payments as $payment)
          {
              $services_text = '';
              foreach($payment->request->available_services as $service)
              {
                $services_text .= $service->name.', ';
              }

              $services_text = substr($services_text, 0, -2);

              $done_payments[] = array(
                  'Orden de trabajo' => $payment->request->ot_code, 
                  'Auto' => '('.$payment->request->car->year.') '.$payment->request->car->car_brand->brand_name.' '.$payment->request->car->car_model->model_name.' ['.$payment->request->car->patent.']', 
                  'Cliente' => $payment->request->client->name.' '.$payment->request->client->last_name, 
                  'Mecánico' => $payment->request->mechanic->name.' '.$payment->request->mechanic->last_name, 
                  'Servicios a Realizar' => $services_text, 
                  'Pago Total' => $payment->amount, 
                  'Pago Repuestos' => $payment->amount_replacements, 
                  'Pago Insumos' => $payment->amount_supplies, 
                  'Pago Mecánico' => $payment->amount_mechanic,
                  'Utilidad' => ($payment->amount - $payment->amount_mechanic - $payment->amount_supplies - $payment->amount_replacements),
              );
          }
        }

        $this->set('payments', $done_payments);
      }
    }

    function excelToBills()
    {
      $end_date = Time::now();
      $start_date = $end_date->modify('-1 day');
      $end_date = Time::now();

      $requests = $this->Requests->find('all')
              ->contain(['Payments', 'Invoices', 'Clients'])
              ->where([
                  'Requests.status' => 5,
                  'Requests.active' => 1,
                  'Requests.sent_to_bill' => 0,
                  function ($exp, $q) use($start_date,$end_date) {
                   return $exp->between('Requests.modified', $start_date, $end_date);
                  }
              ])
              ->matching('Payments', function ($q) {
                  return $q->where([
                      'Payments.active' => 1,
                      'Payments.paid' => 1,
                  ]);
              })
              ->toArray();

      /*echo '<pre>';
      print_r($requests);
      echo '</pre>';

      die();*/

      if(count($requests) > 0)
      {
          $bills = array();
          $facts = array();

          foreach($requests as $request)
          {
            if($request->invoice != null)
            {
              $facts[] = [
                  'ID Usuario' => $request->client_id,
                  'ID Solicitud' => $request->id,
                  'Fecha del servicio' => $request->created->format('d-m-Y H:i:s'),
                  'Nombre' => $request->invoice->full_name,
                  'Rut' => $request->invoice->rut,
                  'Dirección' => $request->invoice->address,
                  'Giro' => $request->invoice->giro,
                  'Total' => $request->payment->amount,
                  'Nombre para el archivo de factura' => $request->id.'_'.$request->client->id.'.jpg'
              ];
            }
            else
            {
              $bills[] = [
                  'ID Usuario' => $request->client_id,
                  'ID Solicitud' => $request->id,
                  'Fecha del servicio' => $request->created->format('d-m-Y H:i:s'),
                  'Nombre' => $request->client->name.' '.$request->client->last_name,
                  'Total' => $request->payment->amount,
                  'Nombre para el archivo de boleta' => $request->id.'_'.$request->client->id.'.jpg'
              ];
            }

            $request->sent_to_bill = 1;
            $this->Requests->save($request);
          }

          $this->set('facts', $facts);
          $this->set('bills', $bills);
      }
    }

    function uploadBills()
    {
      if($this->request->is('post'))
      {
        /*echo '<pre>';
        print_r($this->request->data);
        echo '</pre>';
        die();*/
        $count = 0;
        $existing = 0;

        $nueva_ruta = Router::url(ROOT . DS . 'webroot' . DS . 'files/documentos/pago_clientes/boletas/');

        if(count($this->request->data['docs']) > 0)
        {
          foreach($this->request->data['docs'] as $doc)
          {
            if(!empty($doc['tmp_name']) && $doc['error'] == 0)
            {
              $extension = explode('.', $doc['name']);
              $ids = explode('_', $extension[0]);

              if(count($ids) < 2)
              {
                $this->Flash->error('Verifica el nombre de los archivo con el formato correcto para poder cargarlos');
                return $this->redirect(['controller' => 'Requests', 'action' => 'uploadBills']);
              }

              $request = $this->Requests->get($ids[0]);

              if(count($request) > 0)
              {
                if($request->client_id == $ids[1])
                {
                  if(!file_exists($nueva_ruta.$doc['name']))
                  {
                    if(!move_uploaded_file($doc['tmp_name'], $nueva_ruta.$doc['name']))
                    {
                      $this->Flash->error('Hubo un error al cargar el archivo '.$doc['name']);
                      return $this->redirect(['controller' => 'Requests', 'action' => 'uploadBills']);
                    }
                    else
                    {
                      $count++;
                    }
                  }
                  else
                  {
                    $existing++;
                  }      
                }
                else
                {
                  $this->Flash->error('El usuario '.$ids[1].' no pertenece a la solicitud #'.$ids[0]);
                  return $this->redirect(['controller' => 'Requests', 'action' => 'uploadBills']);
                }
              }
            }
          }
        }

        if($count > 0)
        {
          $this->Flash->success($count.' archivos subidos, '.$existing.' archivos omitidos');
          
        }
        elseif($existing > 0)
        {
          $this->Flash->success($existing.' archivos omitidos');
        }

        return $this->redirect(['controller' => 'Requests', 'action' => 'uploadBills']);
      }
    }
}
