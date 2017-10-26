<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Codes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Banks
 * @property \Cake\ORM\Association\BelongsToMany $Banks
 *
 * @method \App\Model\Entity\Code get($primaryKey, $options = [])
 * @method \App\Model\Entity\Code newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Code[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Code|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Code patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Code[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Code findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CodesTable extends Table
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

        $this->table('codes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Bank', [
            'foreignKey' => 'bank_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Banks', [
            'foreignKey' => 'code_id',
            'targetForeignKey' => 'bank_id',
            'joinTable' => 'banks_codes'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code');

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
        $rules->add($rules->existsIn(['bank_id'], 'Banks'));

        return $rules;
    }
}
