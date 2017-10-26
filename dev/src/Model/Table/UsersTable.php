<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;
use Cake\I18n\Time;
use Cake\I18n\Date;
use ker0x\Push\Adapter\FcmAdapter;
use ker0x\Push\Push;
use Cake\View\Helper\UrlHelper;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $Communes
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\HasMany $AnsweredSurveys
 * @property \Cake\ORM\Association\HasMany $Cars
 * @property \Cake\ORM\Association\HasMany $ItemsLogs
 * @property \Cake\ORM\Association\HasMany $PaymentMethods
 * @property \Cake\ORM\Association\HasMany $Schedules
 * @property \Cake\ORM\Association\HasMany $Session
 * @property \Cake\ORM\Association\HasMany $UserAbilities
 * @property \Cake\ORM\Association\HasMany $Workloads
 * @property \Cake\ORM\Association\BelongsToMany $Communes
 * @property \Cake\ORM\Association\BelongsToMany $Tools
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Commune', [
            'className' => 'Communes',
            'foreignKey' => 'commune_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AnsweredSurveys', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('RequestsClients', [
            'className' => 'Requests',
            'foreignKey' => 'client_id'
        ]);
        $this->hasMany('RequestsMechanics', [
            'className' => 'Requests',
            'foreignKey' => 'mechanic_id'
        ]);
        $this->hasMany('ScheduleLogs', [
            'foreignKey' => 'mechanic_id'
        ]);
        $this->hasMany('Cars', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('ItemsLogs', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('PaymentMethod', [
            'className' => 'UsersPaymentMethods',
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Schedules', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Session', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserAbilities', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Workloads', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Communes', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'commune_id',
            'joinTable' => 'users_communes'
        ]);
        $this->belongsToMany('Tools', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'tool_id',
            'joinTable' => 'users_tools'
        ]);
        $this->belongsToMany('PaymentRefunds', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'payment_refund_id',
            'joinTable' => 'users_payment_refunds'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $rolesTable = TableRegistry::get('Roles');
        $validator
        ->add('role_id', 'existsIn', [
            'rule' => ['inList', $rolesTable->find('list', ['keyField' => 'id', 'valueField' => 'id'])->toArray(), true],
            'message' => 'Tipo de usuario no válido'
            ])
        ->requirePresence('role_id', 'create')
        ->notEmpty('role_id', 'Seleccione un tipo de usuario');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('phone1', 'create')
            ->notEmpty('phone1');

        $validator
            ->allowEmpty('phone2');

        // $validator
        //     ->requirePresence('password', 'create')
        //     ->notEmpty('password');

       /*$validator
        ->add('confirm_password',
            'compareWith', [
            'rule' => ['compareWith', 'password'],
            'message' => 'Contraseñas no coinciden.'
            ])
        ->add('password', 'passwordValid', [
            'rule' => function ($data, $context) {
                if ( empty(trim($data)) ) {
                    return 'Ingrese nueva contraseña';
                }
                else{
                    //NotEmpty
                    if(strlen($data)<6 || strlen($data)>20){
                        return 'La contraseña debe tener entre 6 y 20 caracteres, 2 de ellos numéricos.';
                    }else{
                        // min 2 digitos y 4 letras
                        if(!preg_match('/(?=.*?[0-9].*?[0-9])/', $data)){
                            return 'La contraseña debe tener al menos 6 caracteres, 2 de ellos numéricos.';
                        }
                        else{
                            // todo OK
                            return true;
                        }
                    }
                }
            }
        ])
        ->requirePresence('password', 'create','update')
        ->notEmpty('password','Completa este campo')
        ->requirePresence('confirm_password', 'create')
        ->notEmpty('confirm_password','Completa este campo');*/


        $validator
            ->allowEmpty('photo_url');

        $validator
            ->allowEmpty('sex');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->allowEmpty('id_fcm1');

        $validator
            ->allowEmpty('id_fcm2');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['commune_id'], 'Communes'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }

    public function validationOnlyChangePass(Validator $validator) {

        $validator
            ->requirePresence('password')
            ->notEmpty('password','Completa este campo')
            ->requirePresence('confirm_password')
            ->notEmpty('confirm_password','Completa este campo');

        $validator
            ->add('confirm_password',
                'compareWith', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Contraseñas no coinciden.'
                ])
            ->add('password', 'passwordValid', [
                'rule' => function ($data, $context) {
                    if ( empty(trim($data)) ) {
                        return 'Ingrese nueva contraseña';
                    }
                    else{
                        //NotEmpty
                        if(strlen($data)<6 || strlen($data)>20){
                            return 'La contraseña debe tener entre 6 y 20 caracteres, 2 de ellos numéricos.';
                        }
                        else{
                            // min 2 digitos
                            if(!preg_match('/(?=.*?[0-9].*?[0-9])/', $data)){
                                return 'La contraseña debe tener al menos 6 caracteres, 2 de ellos numéricos.';
                            }
                            else{
                                    // todo OK
                                    return true;
                            }
                        }
                    }
                }
        ]);

        return $validator;
    }//end validationOnlyChangePass

    public function searchMechanics($request_id = null)
    {
        $this->Requests = TableRegistry::get('Requests');
        $request = $this->Requests->get($request_id, ['contain' => ['AvailableServices' => ['Abilities'], 'Communes', 'Clients']]);

        if($request != null)
        {
            if($request->mechanic_id != null || $request->mechanic_id != '')
            {
                return false;
            }


            if($request->mechanic_search_count >= 0)
            {
                $request->mechanic_search_count++;
                $this->Requests->save($request);
            }

            if($request->mechanic_search_count >= 5)
            {
                //enviar mail a fullmec solicitud manual
                
            }
            else
            {
                $this->ScheduleLogs = TableRegistry::get('ScheduleLogs');

                $date_schedule_start = new Time($request->start_time_schedule_requested);

                /*************Buscar bloque de fin de acuerdo al tiempo de trabajo de los servicios elegidos*************/

                if(count($request->available_services) > 0)
                {
                    $hours = 0;
                    foreach($request->available_services as $service)
                    {
                        $hours = $hours + $service->real_estimated_time;
                    }


                    $date_schedule_end = new Time($request->start_time_schedule_requested);
                    $date_schedule_end->modify('+'.$hours.' hours');
                }

                /********************************************************************************************************/

                $commune_id = $request->commune->id;

                $users_ids = '';
                $logs = $this->ScheduleLogs->find('all')
                        ->contain(['Schedules'])
                        ->where([
                            'ScheduleLogs.request_id' => $request->id,
                            'ScheduleLogs.notified' => 1,
                            'ScheduleLogs.answered <>' => 2
                        ])
                        ->toArray();

                if(count($logs) > 0)
                {
                    foreach($logs as $log)
                    {
                        $users_ids .= $log->schedule->user_id.', ';
                    }

                    $users_ids = substr($users_ids, 0, -2);
                }

                
                $users_array = array();

                if($users_ids != '')
                {
                    $users_array['Schedules.user_id <>'] =  $users_ids;
                } 

                $mechanics = $this->find('all')
                            ->contain([
                                'Communes' => [
                                    'queryBuilder' => function ($q) use ($commune_id){
                                        return $q->where(['Communes.id' => $commune_id]);
                                    }
                                ],
                                'Schedules' =>[
                                    'queryBuilder' => function ($q) use ($date_schedule_start, $date_schedule_end){
                                        return $q->where([
                                            'Schedules.day_of_week' => $date_schedule_start->format('N'),
                                            'Schedules.start_hour >=' => $date_schedule_start->format('H:i:s'),
                                            'Schedules.start_hour <=' => $date_schedule_end->format('H:i:s'),
                                            'Schedules.is_available' => 1,
                                            'Schedules.active' => 1
                                        ]);
                                    }
                                ]
                            ])
                            ->where([
                                'Users.role_id' => 6
                            ])
                            ->matching('Communes', function ($q) use($commune_id) {
                                return $q->where(['Communes.id' => $commune_id]);
                            })
                            ->matching('Schedules', function ($q) use($date_schedule_start, $date_schedule_end, $users_array) {
                                return $q->where([
                                    'Schedules.day_of_week' => $date_schedule_start->format('N'),
                                    'Schedules.start_hour <=' => $date_schedule_start->format('H:i:s'),
                                    'Schedules.start_hour >=' => $date_schedule_end->format('H:i:s'),
                                    'Schedules.is_available' => 1,
                                    'Schedules.active' => 1
                                ]);
                            })
                            ->notMatching('Schedules', function ($q) use($users_array){
                                return $q->where([
                                    $users_array,
                                ]);
                            })
                            ->matching('RequestsMechanics', function ($q) {
                                return $q->where([
                                    'RequestsMechanics.active' => 1,
                                ]);
                            })
                            ->notMatching('RequestsMechanics', function ($q) {
                                return $q->where([
                                    'RequestsMechanics.status' => '2, 6, 9, 10',
                                ]);
                            })
                            ->group(['Users.id'])
                            ->limit(5)
                            ->toArray();

                $notification_sent = 0;
                $notification_not_sent = 0;

                if(count($mechanics) > 0)
                {
                    foreach($mechanics as $mechanic)
                    {
                        $tokensId=[];

                        if($mechanic->schedules != null)
                        {
                            foreach($mechanic->schedules as $schedule)
                            {
                                if($mechanic->active)
                                {
                                    if(isset($mechanic->id_fcm1) && ($mechanic->id_fcm1!=null)){
                                      array_push($tokensId, $mechanic->id_fcm1);
                                    }

                                    if(isset($mechanic->id_fcm2) && ($mechanic->id_fcm2!=null)){
                                      array_push($tokensId, $mechanic->id_fcm2);
                                    }

                                    if(count($tokensId) >0){
                                        $adapter = new FcmAdapter();

                                        $url = new UrlHelper(new \Cake\View\View());

                                        $adapter
                                          ->setTokens($tokensId)
                                          ->setNotification([
                                              'title' => 'Nueva Solicitud de Trabajo',
                                              'body' => __('{0} {1} ha solicitado {2} servicio', $request->client->name, $request->client->last_name, count($request->available_services))
                                          ])
                                          ->setDatas([
                                              'url' => $url->build('/pages/solicitar-servicios/view/'.$request->id),
                                              'data-2' => 1234,
                                              'data-3' => true
                                          ]);

                                        $push = new Push($adapter);

                                        // Make the push
                                        $result = $push->send();

                                        // Get the response
                                        $response = $push->response();

                                        if($result != null)
                                        {
                                            //add row schedulelogs
                                            $schedule_log = $this->ScheduleLogs->newEntity();
                                            $schedule_log->schedule_id = $schedule->id;
                                            $schedule_log->mechanic_id =  $mechanic->id;
                                            $schedule_log->request_id = $request->id;
                                            $schedule_log->notified = 1;
                                            $schedule_log->answered = 0;
                                            $this->ScheduleLogs->save($schedule_log);

                                            $notification_sent++;
                                        }
                                    }
                                }
                            }

                            
                        }
                        else
                        {
                            $notification_not_sent++;
                        }
                    }

                    return true;
                }
                else
                {
                    return false;
                }
                
            }
        }
    }
}
