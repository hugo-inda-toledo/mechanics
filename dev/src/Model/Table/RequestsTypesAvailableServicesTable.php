<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequestsTypesAvailableServices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $RequestsTypes
 * @property \Cake\ORM\Association\BelongsTo $AvailableServices
 *
 * @method \App\Model\Entity\RequestsTypesAvailableService get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequestsTypesAvailableService newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequestsTypesAvailableService[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequestsTypesAvailableService|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestsTypesAvailableService patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequestsTypesAvailableService[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequestsTypesAvailableService findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTypesAvailableServicesTable extends Table
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

        $this->table('requests_types_available_services');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RequestsTypes', [
            'foreignKey' => 'requests_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AvailableServices', [
            'foreignKey' => 'available_service_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['requests_type_id'], 'RequestsTypes'));
        $rules->add($rules->existsIn(['available_service_id'], 'AvailableServices'));

        return $rules;
    }
}
