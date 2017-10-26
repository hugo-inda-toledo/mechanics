<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Providers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $Communes
 * @property \Cake\ORM\Association\HasMany $PurchaseOrdersReplacements
 * @property \Cake\ORM\Association\HasMany $PurchaseOrdersSupplies
 * @property \Cake\ORM\Association\BelongsToMany $CarBrands
 * @property \Cake\ORM\Association\BelongsToMany $PaymentRefunds
 * @property \Cake\ORM\Association\BelongsToMany $Replacements
 * @property \Cake\ORM\Association\BelongsToMany $Supplies
 *
 * @method \App\Model\Entity\Provider get($primaryKey, $options = [])
 * @method \App\Model\Entity\Provider newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Provider[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Provider|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Provider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Provider[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Provider findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProvidersTable extends Table
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

        $this->table('providers');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Communes', [
            'foreignKey' => 'commune_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PurchaseOrdersReplacements', [
            'foreignKey' => 'provider_id'
        ]);
        $this->hasMany('PurchaseOrdersSupplies', [
            'foreignKey' => 'provider_id'
        ]);
        $this->belongsToMany('CarBrands', [
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'car_brand_id',
            'joinTable' => 'car_brands_providers'
        ]);
        $this->belongsToMany('PaymentRefunds', [
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'payment_refund_id',
            'joinTable' => 'providers_payment_refunds'
        ]);
        $this->belongsToMany('Replacements', [
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'replacement_id',
            'joinTable' => 'replacements_providers'
        ]);
        $this->belongsToMany('Supplies', [
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'supply_id',
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
            ->allowEmpty('contact_name');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('dni');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->allowEmpty('website');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['commune_id'], 'Communes'));

        return $rules;
    }
}
