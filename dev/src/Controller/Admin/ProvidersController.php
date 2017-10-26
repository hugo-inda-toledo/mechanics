<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Providers Controller
 *
 * @property \App\Model\Table\ProvidersTable $Providers
 */
class ProvidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cities', 'Communes']
        ];
        $providers = $this->paginate($this->Providers);

        $this->set(compact('providers'));
        $this->set('_serialize', ['providers']);
    }

    /**
     * View method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $provider = $this->Providers->get($id, [
            'contain' => ['Cities', 'Communes', 'CarBrands', 'PaymentRefunds', 'Replacements', 'Supplies', 'PurchaseOrdersReplacements', 'PurchaseOrdersSupplies']
        ]);

        $this->set('provider', $provider);
        $this->set('_serialize', ['provider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $provider = $this->Providers->newEntity();
        if ($this->request->is('post')) {
            $provider = $this->Providers->patchEntity($provider, $this->request->data);
            if ($this->Providers->save($provider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Provider'));
            }
        }
        $cities = $this->Providers->Cities->find('list', ['limit' => 200]);
        $communes = $this->Providers->Communes->find('list', ['limit' => 200]);
        $carBrands = $this->Providers->CarBrands->find('list', ['limit' => 200]);
        $paymentRefunds = $this->Providers->PaymentRefunds->find('list', ['limit' => 200]);
        $replacements = $this->Providers->Replacements->find('list', ['limit' => 200]);
        $supplies = $this->Providers->Supplies->find('list', ['limit' => 200]);
        $this->set(compact('provider', 'cities', 'communes', 'carBrands', 'paymentRefunds', 'replacements', 'supplies'));
        $this->set('_serialize', ['provider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $provider = $this->Providers->get($id, [
            'contain' => ['CarBrands', 'PaymentRefunds', 'Replacements', 'Supplies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $provider = $this->Providers->patchEntity($provider, $this->request->data);
            if ($this->Providers->save($provider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Provider'));
            }
        }
        $cities = $this->Providers->Cities->find('list', ['limit' => 200]);
        $communes = $this->Providers->Communes->find('list', ['limit' => 200]);
        $carBrands = $this->Providers->CarBrands->find('list', ['limit' => 200]);
        $paymentRefunds = $this->Providers->PaymentRefunds->find('list', ['limit' => 200]);
        $replacements = $this->Providers->Replacements->find('list', ['limit' => 200]);
        $supplies = $this->Providers->Supplies->find('list', ['limit' => 200]);
        $this->set(compact('provider', 'cities', 'communes', 'carBrands', 'paymentRefunds', 'replacements', 'supplies'));
        $this->set('_serialize', ['provider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $provider = $this->Providers->get($id);
        if ($this->Providers->delete($provider)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Provider'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Provider'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function exportData()
    {
        $this->loadModel('Banks');
        $this->set('banks', $this->Banks->find('list', ['conditions' => ['Banks.enabled_to_export' => 1]]));
    }


    function getExcelData()
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
                            'PurchaseOrders' => [
                                'Replacements',
                                'Supplies'
                            ]
                        ]
                    ])
                    ->matching('Requests.PurchaseOrders', function ($q) {
                        return $q->where(['PurchaseOrders.active' => 1]);
                    })
                    ->where([
                        'Payments.paid' => 1,
                        'Payments.paid_provider' => 0,
                        'MONTH(Payments.created)' => $month,
                        'YEAR(Payments.created)' => $year
                    ])
                    ->toArray();

            /*echo '<pre>';
            print_r($payments);
            echo '</pre>';
            die();*/

            if(count($payments) > 0)
            {
                $pending_payments = array();

                foreach($payments as $payment)
                {
                    if(count($payment->request->purchase_orders) > 0)
                    {
                        foreach($payment->request->purchase_orders as $purchase_order)
                        {
                            if(count($purchase_order->replacements) > 0)
                            {
                                foreach($purchase_order->replacements as $replacement)
                                {
                                    $provider_name = '';
                                    $provider_dni = '';
                                    $provider_email = '';
                                    $provider_account = '';

                                    $provider = $this->Providers->get($replacement->_joinData->provider_id, ['contain' => ['PaymentRefunds' => ['Banks' => ['Codes']]]]);

                                    if(count($provider->payment_refunds) > 0)
                                    {
                                        foreach($provider->payment_refunds as $payment_refund)
                                        {
                                            if($provider->id == $payment_refund->_joinData->provider_id)
                                            {
                                                $provider_name = $payment_refund->name;
                                                $provider_dni = $payment_refund->dni;
                                                $provider_email = $payment_refund->email;
                                                $provider_account = $payment_refund->account_number;
                                                $code_number = '';
                                                
                                                if(count($payment_refund->bank->codes) > 0)
                                                {

                                                    foreach($payment_refund->bank->codes as $code)
                                                    {
                                                        if($code->_joinData->bank_id == $payment_refund->bank->id)
                                                        {
                                                            $code_number = $code->code;
                                                            //echo 'codigo: '.$code->code;
                                                            break;
                                                        }
                                                    }
                                                }

                                                $pending_payments[] = array(
                                                    'Cuenta Origen' => '02536512545', 
                                                    'Moneda Cuenta Origen' => 'CLP', 
                                                    'Cuenta Destino' => $payment_refund->account_number, 
                                                    'Moneda Cuenta Destino' => 'CLP', 
                                                    'Codigo Banco' => $code_number, 
                                                    'Rut Beneficiario' => $provider_dni, 
                                                    'Nombre Beneficiario' => $provider_name, 
                                                    'Monto Transferencia' => $replacement->original_price.',00',
                                                    'Glosa Transferencia' => 'Pago de repuesto ['.$replacement->name.']',
                                                    'Dirección Correo Beneficiario' => $provider_email,
                                                    'Glosa Correo Beneficiario' => 'Pago de repuesto Fullmec',
                                                    'Glosa Cartola Cliente' => 'Pago de repuesto',
                                                    'Glosa Cartola Beneficiario' => 'Pago de repuesto',
                                                );

                                                break;
                                            }
                                        }
                                    }
                                }
                            }


                            if(count($purchase_order->supplies) > 0)
                            {
                                foreach($purchase_order->supplies as $supply)
                                {
                                    $provider_name = '';
                                    $provider_dni = '';
                                    $provider_email = '';
                                    $provider_account = '';

                                    $provider = $this->Providers->get($supply->_joinData->provider_id, ['contain' => ['PaymentRefunds' => ['Banks' => ['Codes']]]]);

                                    if(count($provider->payment_refunds) > 0)
                                    {
                                        foreach($provider->payment_refunds as $payment_refund)
                                        {
                                            if($provider->id == $payment_refund->_joinData->provider_id)
                                            {
                                                $provider_name = $payment_refund->name;
                                                $provider_dni = $payment_refund->dni;
                                                $provider_email = $payment_refund->email;
                                                $provider_account = $payment_refund->account_number;
                                                $code_number = '';
                                                
                                                if(count($payment_refund->bank->codes) > 0)
                                                {

                                                    foreach($payment_refund->bank->codes as $code)
                                                    {
                                                        if($code->_joinData->bank_id == $payment_refund->bank->id)
                                                        {
                                                            $code_number = $code->code;
                                                            //echo 'codigo: '.$code->code;
                                                            break;
                                                        }
                                                    }
                                                }

                                                $pending_payments[] = array(
                                                    'Cuenta Origen' => '02536512545', 
                                                    'Moneda Cuenta Origen' => 'CLP', 
                                                    'Cuenta Destino' => $payment_refund->account_number, 
                                                    'Moneda Cuenta Destino' => 'CLP', 
                                                    'Codigo Banco' => $code_number, 
                                                    'Rut Beneficiario' => $provider_dni, 
                                                    'Nombre Beneficiario' => $provider_name, 
                                                    'Monto Transferencia' => $supply->original_price.',00',
                                                    'Glosa Transferencia' => 'Pago de insumo ['.$supply->name.']',
                                                    'Dirección Correo Beneficiario' => $provider_email,
                                                    'Glosa Correo Beneficiario' => 'Pago de insumos Fullmec',
                                                    'Glosa Cartola Cliente' => 'Pago de insumos',
                                                    'Glosa Cartola Beneficiario' => 'Pago de insumos',
                                                );

                                                break;
                                            }
                                        }
                                    }
                                }
                            }

                        }
                    }
                }

                /*echo '<pre>';
                print_r($this->request->data);
                echo '</pre>';

                echo '<pre>';
                print_r($pending_payments);
                echo '</pre>';

                echo '<pre>';
                print_r($payments);
                echo '</pre>';

                die;*/

                $this->set('payments', $pending_payments);
            }
            else
            {
                $this->Flash->error(__('No existen pagos a proveedores pendientes entre las fechas seleccionadas'));
                $this->redirect(['controller' => 'Payments', 'action' => 'exportData']);
            }
        }
    }
}
