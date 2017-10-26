<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Cars
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $Communes
 * @property \Cake\ORM\Association\HasMany $AnsweredSurveys
 * @property \Cake\ORM\Association\HasMany $HealthReports
 * @property \Cake\ORM\Association\HasMany $ItemsLogs
 * @property \Cake\ORM\Association\HasMany $Payments
 * @property \Cake\ORM\Association\HasMany $PurcharseOrders
 * @property \Cake\ORM\Association\HasMany $RequestServices
 * @property \Cake\ORM\Association\HasMany $RequestsFiles
 * @property \Cake\ORM\Association\BelongsToMany $AvailableServices
 *
 * @method \App\Model\Entity\Request get($primaryKey, $options = [])
 * @method \App\Model\Entity\Request newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Request[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Request[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
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

        $this->table('requests');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clients', [
            'className' => 'Users',
            'foreignKey' => 'client_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Mechanics', [
            'className' => 'Users',
            'foreignKey' => 'mechanic_id',
        ]);
        $this->belongsTo('Cars', [
            'foreignKey' => 'car_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
        ]);
        $this->belongsTo('Communes', [
            'foreignKey' => 'commune_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AnsweredSurveys', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('HealthReports', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('ItemsLogs', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('ScheduleLogs', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasOne('Payments', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('PurchaseOrders', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('RequestServices', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('RequestsFiles', [
            'foreignKey' => 'request_id'
        ]);
        $this->belongsToMany('AvailableServices', [
            'foreignKey' => 'request_id',
            'targetForeignKey' => 'available_service_id',
            'joinTable' => 'requests_available_services'
        ]);
        $this->hasMany('QualificationsToMechanics', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasOne('Invoices', [
            'foreignKey' => 'request_id'
        ]);

        $this->hasMany('Reports', [
            'foreignKey' => 'request_id'
        ]);

        $this->hasMany('RequestsMechanicMods', [
            'foreignKey' => 'request_id'
        ]);
        
        // Tiene un motivo de cancelación (opcional)
        $this->hasOne('RequestCancelations', [
            'foreignKey' => 'request_id'
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
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('address_name', 'create')
            ->notEmpty('address_name');

        $validator
            ->integer('address_number')
            ->requirePresence('address_number', 'create')
            ->notEmpty('address_number');

        $validator
            ->allowEmpty('address_complement');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->allowEmpty('type_documents_payment');

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
        //$rules->add($rules->existsIn(['client_id'], 'Users'));
        //$rules->add($rules->existsIn(['mechanic_id'], 'Users'));
        //$rules->add($rules->existsIn(['requests_type_id'], 'RequestsTypes'));
        $rules->add($rules->existsIn(['car_id'], 'Cars'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['commune_id'], 'Communes'));

        return $rules;
    }
}
