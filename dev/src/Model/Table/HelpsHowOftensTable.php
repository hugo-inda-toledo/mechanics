<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpsHowOftens Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HelpsSituations
 *
 * @method \App\Model\Entity\HelpsHowOften get($primaryKey, $options = [])
 * @method \App\Model\Entity\HelpsHowOften newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HelpsHowOften[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HelpsHowOften|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HelpsHowOften patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsHowOften[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsHowOften findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HelpsHowOftensTable extends Table
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

        $this->table('helps_how_oftens');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('HelpsSituations', [
            'foreignKey' => 'helps_situation_id',
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
            ->requirePresence('how_often_name', 'create')
            ->notEmpty('how_often_name');

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
        $rules->add($rules->existsIn(['helps_situation_id'], 'HelpsSituations'));

        return $rules;
    }
}
