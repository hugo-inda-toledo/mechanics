<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequestCancelationOptions Model
 *
 * @method \App\Model\Entity\RequestCancelationOption get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequestCancelationOption newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequestCancelationOption[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequestCancelationOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestCancelationOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequestCancelationOption[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequestCancelationOption findOrCreate($search, callable $callback = null, $options = [])
 */
class RequestCancelationOptionsTable extends Table
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

        $this->table('request_cancelation_options');
        $this->displayField('name');
        $this->primaryKey('id');

        // Tiene muchos motivos de anulación.
        $this->hasMany('RequestCancelations', [
            'foreignKey' => 'request_cancelation_id'
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
            ->boolean('active')
            ->allowEmpty('active');

        return $validator;
    }
}
