<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpsSituations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HelpsWhens
 * @property \Cake\ORM\Association\HasMany $HelpsHowOftens
 *
 * @method \App\Model\Entity\HelpsSituation get($primaryKey, $options = [])
 * @method \App\Model\Entity\HelpsSituation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HelpsSituation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HelpsSituation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HelpsSituation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsSituation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsSituation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HelpsSituationsTable extends Table
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

        $this->table('helps_situations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('HelpsWhens', [
            'foreignKey' => 'helps_when_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('HelpsHowOftens', [
            'foreignKey' => 'helps_situation_id'
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
            ->requirePresence('situation_name', 'create')
            ->notEmpty('situation_name');

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
        $rules->add($rules->existsIn(['helps_when_id'], 'HelpsWhens'));

        return $rules;
    }
}
