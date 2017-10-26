<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AvailableServices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $RequestsTypes
 * @property \Cake\ORM\Association\HasMany $RequestServices
 * @property \Cake\ORM\Association\BelongsToMany $Abilities
 * @property \Cake\ORM\Association\BelongsToMany $Replacements
 * @property \Cake\ORM\Association\BelongsToMany $Supplies
 * @property \Cake\ORM\Association\BelongsToMany $Requests
 *
 * @method \App\Model\Entity\AvailableService get($primaryKey, $options = [])
 * @method \App\Model\Entity\AvailableService newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AvailableService[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AvailableService|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AvailableService patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AvailableService[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AvailableService findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AvailableServicesTable extends Table
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

        $this->table('available_services');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RequestsTypes', [
            'foreignKey' => 'requests_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('RequestServices', [
            'foreignKey' => 'available_service_id'
        ]);
        $this->belongsToMany('Abilities', [
            'foreignKey' => 'available_service_id',
            'targetForeignKey' => 'ability_id',
            'joinTable' => 'available_services_abilities'
        ]);
        $this->belongsToMany('Replacements', [
            'foreignKey' => 'available_service_id',
            'targetForeignKey' => 'replacement_id',
            'joinTable' => 'available_services_replacements'
        ]);
        $this->belongsToMany('Supplies', [
            'foreignKey' => 'available_service_id',
            'targetForeignKey' => 'supply_id',
            'joinTable' => 'available_services_supplies'
        ]);
        $this->belongsToMany('Requests', [
            'foreignKey' => 'available_service_id',
            'targetForeignKey' => 'request_id',
            'joinTable' => 'requests_available_services'
        ]);

        $this->belongsToMany('RequestsMechanicMods', [
            'foreignKey' => 'available_service_id',
            'targetForeignKey' => 'request_mechanic_mod_id',
            'joinTable' => 'requests_mechanic_mod_items'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->numeric('estimated_time')
            ->allowEmpty('estimated_time');

        $validator
            ->numeric('real_estimated_time')
            ->requirePresence('real_estimated_time', 'create')
            ->notEmpty('real_estimated_time');

        $validator
            ->numeric('total_price')
            ->requirePresence('total_price', 'create')
            ->notEmpty('total_price');

        $validator
            ->numeric('supplies_price')
            ->allowEmpty('supplies_price');

        $validator
            ->numeric('replacements_price')
            ->allowEmpty('replacements_price');

        $validator
            ->numeric('mechanic_pay')
            ->requirePresence('mechanic_pay', 'create')
            ->notEmpty('mechanic_pay');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->boolean('inspection')
            ->requirePresence('inspection', 'create')
            ->notEmpty('inspection');

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

        return $rules;
    }
}
