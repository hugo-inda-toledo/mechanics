<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Replacements Model
 *
 * @property \Cake\ORM\Association\HasMany $CarBrandsProviders
 * @property \Cake\ORM\Association\BelongsToMany $AvailableServices
 * @property \Cake\ORM\Association\BelongsToMany $PurchaseOrders
 * @property \Cake\ORM\Association\BelongsToMany $Providers
 *
 * @method \App\Model\Entity\Replacement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Replacement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Replacement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Replacement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Replacement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Replacement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Replacement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReplacementsTable extends Table
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

        $this->table('replacements');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CarBrandsProviders', [
            'foreignKey' => 'replacement_id'
        ]);
        $this->belongsToMany('AvailableServices', [
            'foreignKey' => 'replacement_id',
            'targetForeignKey' => 'available_service_id',
            'joinTable' => 'available_services_replacements'
        ]);
        $this->belongsToMany('PurchaseOrders', [
            'foreignKey' => 'replacement_id',
            'targetForeignKey' => 'purchase_order_id',
            'joinTable' => 'purchase_orders_replacements'
        ]);
        $this->belongsToMany('Providers', [
            'foreignKey' => 'replacement_id',
            'targetForeignKey' => 'provider_id',
            'joinTable' => 'replacements_providers'
        ]);
        $this->belongsToMany('CarBrands', [
            'foreignKey' => 'replacement_id',
            'targetForeignKey' => 'car_brand_id',
            'joinTable' => 'car_brands_providers'
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
            ->numeric('original_price')
            ->allowEmpty('original_price');

        $validator
            ->numeric('price_for_request')
            ->requirePresence('price_for_request', 'create')
            ->notEmpty('price_for_request');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
