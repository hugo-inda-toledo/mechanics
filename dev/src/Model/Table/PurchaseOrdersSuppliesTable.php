<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrdersSupplies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PurchaseOrders
 * @property \Cake\ORM\Association\BelongsTo $Supplies
 * @property \Cake\ORM\Association\BelongsTo $Providers
 *
 * @method \App\Model\Entity\PurchaseOrdersSupply get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrdersSupply newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrdersSupply[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrdersSupply|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrdersSupply patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrdersSupply[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrdersSupply findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PurchaseOrdersSuppliesTable extends Table
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

        $this->table('purchase_orders_supplies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'purchase_order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Supplies', [
            'foreignKey' => 'supply_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Providers', [
            'foreignKey' => 'provider_id',
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
        $rules->add($rules->existsIn(['purchase_order_id'], 'PurchaseOrders'));
        $rules->add($rules->existsIn(['supply_id'], 'Supplies'));
        $rules->add($rules->existsIn(['provider_id'], 'Providers'));

        return $rules;
    }
}
