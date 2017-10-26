<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AvailableServicesSupplies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AvailableServices
 * @property \Cake\ORM\Association\BelongsTo $Supplies
 *
 * @method \App\Model\Entity\AvailableServicesSupply get($primaryKey, $options = [])
 * @method \App\Model\Entity\AvailableServicesSupply newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AvailableServicesSupply[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AvailableServicesSupply|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AvailableServicesSupply patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AvailableServicesSupply[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AvailableServicesSupply findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AvailableServicesSuppliesTable extends Table
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

        $this->table('available_services_supplies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AvailableServices', [
            'foreignKey' => 'available_service_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Supplies', [
            'foreignKey' => 'supply_id',
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
        $rules->add($rules->existsIn(['available_service_id'], 'AvailableServices'));
        $rules->add($rules->existsIn(['supply_id'], 'Supplies'));

        return $rules;
    }
}
