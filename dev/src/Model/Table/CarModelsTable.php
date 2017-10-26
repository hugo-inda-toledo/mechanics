<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CarModels Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CarBrands
 * @property \Cake\ORM\Association\HasMany $Cars
 *
 * @method \App\Model\Entity\CarModel get($primaryKey, $options = [])
 * @method \App\Model\Entity\CarModel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CarModel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CarModel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarModel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CarModel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CarModel findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CarModelsTable extends Table
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

        $this->table('car_models');
        $this->displayField('model_name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CarBrands', [
            'foreignKey' => 'car_brand_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Cars', [
            'foreignKey' => 'car_model_id'
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
            ->requirePresence('model_name', 'create')
            ->notEmpty('model_name');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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

        return $rules;
    }
}
