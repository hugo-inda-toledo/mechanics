<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cars Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $CarBrands
 * @property \Cake\ORM\Association\BelongsTo $CarModels
 * @property \Cake\ORM\Association\HasMany $HealthReports
 * @property \Cake\ORM\Association\HasMany $MaintenceRecords
 * @property \Cake\ORM\Association\HasMany $Requests
 *
 * @method \App\Model\Entity\Car get($primaryKey, $options = [])
 * @method \App\Model\Entity\Car newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Car[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Car|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Car patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Car[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Car findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CarsTable extends Table
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

        $this->table('cars');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CarBrands', [
            'foreignKey' => 'car_brand_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CarModels', [
            'foreignKey' => 'car_model_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('HealthReports', [
            'foreignKey' => 'car_id'
        ]);
        $this->hasMany('MaintenceRecords', [
            'foreignKey' => 'car_id'
        ]);
        $this->hasMany('Requests', [
            'foreignKey' => 'car_id'
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
            ->requirePresence('patent', 'create')
            ->notEmpty('patent');

        $validator
            ->allowEmpty('car_model_id');

        $validator
            ->allowEmpty('car_brand_id');

        $validator
            ->integer('year')
            ->allowEmpty('year');

        $validator
            ->integer('mileage')
            ->allowEmpty('mileage');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->allowEmpty('observations');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['car_brand_id'], 'CarBrands'));
        $rules->add($rules->existsIn(['car_model_id'], 'CarModels'));

        return $rules;
    }
}
