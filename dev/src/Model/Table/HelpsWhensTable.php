<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpsWhens Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HelpsWhatsups
 * @property \Cake\ORM\Association\HasMany $HelpsSituations
 *
 * @method \App\Model\Entity\HelpsWhen get($primaryKey, $options = [])
 * @method \App\Model\Entity\HelpsWhen newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HelpsWhen[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HelpsWhen|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HelpsWhen patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsWhen[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsWhen findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HelpsWhensTable extends Table
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

        $this->table('helps_whens');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('HelpsWhatsups', [
            'foreignKey' => 'helps_whatsup_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('HelpsSituations', [
            'foreignKey' => 'helps_when_id'
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
            ->requirePresence('when_name', 'create')
            ->notEmpty('when_name');

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
        $rules->add($rules->existsIn(['helps_whatsup_id'], 'HelpsWhatsups'));

        return $rules;
    }
}
