<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Supplies Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $AvailableServices
 * @property \Cake\ORM\Association\BelongsToMany $Providers
 *
 * @method \App\Model\Entity\Supply get($primaryKey, $options = [])
 * @method \App\Model\Entity\Supply newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Supply[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Supply|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supply patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Supply[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Supply findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SuppliesTable extends Table
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

        $this->table('supplies');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('AvailableServices', [
            'foreignKey' => 'supply_id',
            'targetForeignKey' => 'available_service_id',
            'joinTable' => 'available_services_supplies'
        ]);
        $this->belongsToMany('Providers', [
            'foreignKey' => 'supply_id',
            'targetForeignKey' => 'provider_id',
            'joinTable' => 'supplies_providers'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->numeric('total_price')
            ->allowEmpty('total_price');

        $validator
            ->numeric('price_for_request')
            ->requirePresence('price_for_request', 'create')
            ->notEmpty('price_for_request');

        $validator
            ->integer('stock')
            ->requirePresence('stock', 'create')
            ->notEmpty('stock');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
