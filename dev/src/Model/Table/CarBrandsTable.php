<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CarBrands Model
 *
 * @property \Cake\ORM\Association\HasMany $CarModels
 * @property \Cake\ORM\Association\HasMany $Cars
 * @property \Cake\ORM\Association\BelongsToMany $Providers
 *
 * @method \App\Model\Entity\CarBrand get($primaryKey, $options = [])
 * @method \App\Model\Entity\CarBrand newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CarBrand[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CarBrand|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarBrand patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CarBrand[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CarBrand findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CarBrandsTable extends Table
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

        $this->table('car_brands');
        $this->displayField('brand_name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CarModels', [
            'foreignKey' => 'car_brand_id'
        ]);
        $this->hasMany('Cars', [
            'foreignKey' => 'car_brand_id'
        ]);
        $this->belongsToMany('Providers', [
            'foreignKey' => 'car_brand_id',
            'targetForeignKey' => 'provider_id',
            'joinTable' => 'car_brands_providers'
        ]);
        $this->belongsToMany('Replacements', [
            'foreignKey' => 'car_brand_id',
            'targetForeignKey' => 'replacement_id',
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
            ->requirePresence('brand_name', 'create')
            ->notEmpty('brand_name');

        $validator
            ->allowEmpty('brand_logo');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
