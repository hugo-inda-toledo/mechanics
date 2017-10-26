<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CarBrandsProviders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CarBrands
 * @property \Cake\ORM\Association\BelongsTo $Providers
 * @property \Cake\ORM\Association\BelongsTo $Replacements
 *
 * @method \App\Model\Entity\CarBrandsProvider get($primaryKey, $options = [])
 * @method \App\Model\Entity\CarBrandsProvider newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CarBrandsProvider[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CarBrandsProvider|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarBrandsProvider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CarBrandsProvider[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CarBrandsProvider findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CarBrandsProvidersTable extends Table
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

        $this->table('car_brands_providers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CarBrands', [
            'foreignKey' => 'car_brand_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Providers', [
            'foreignKey' => 'provider_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Replacements', [
            'foreignKey' => 'replacement_id'
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
            ->integer('stock')
            ->allowEmpty('stock');

        $validator
            ->integer('default_provider')
            ->allowEmpty('default_provider');

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
        $rules->add($rules->existsIn(['car_brand_id'], 'CarBrands'));
        $rules->add($rules->existsIn(['provider_id'], 'Providers'));
        $rules->add($rules->existsIn(['replacement_id'], 'Replacements'));

        return $rules;
    }
}
