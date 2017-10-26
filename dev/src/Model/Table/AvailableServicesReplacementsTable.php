<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AvailableServicesReplacements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AvailableServices
 * @property \Cake\ORM\Association\BelongsTo $Replacements
 *
 * @method \App\Model\Entity\AvailableServicesReplacement get($primaryKey, $options = [])
 * @method \App\Model\Entity\AvailableServicesReplacement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AvailableServicesReplacement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AvailableServicesReplacement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AvailableServicesReplacement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AvailableServicesReplacement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AvailableServicesReplacement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AvailableServicesReplacementsTable extends Table
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

        $this->table('available_services_replacements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AvailableServices', [
            'foreignKey' => 'available_service_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Replacements', [
            'foreignKey' => 'replacement_id',
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
        $rules->add($rules->existsIn(['available_service_id'], 'AvailableServices'));
        $rules->add($rules->existsIn(['replacement_id'], 'Replacements'));

        return $rules;
    }
}
