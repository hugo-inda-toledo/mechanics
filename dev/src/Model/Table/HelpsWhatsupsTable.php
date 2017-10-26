<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpsWhatsups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HelpsWheres
 * @property \Cake\ORM\Association\HasMany $HelpsWhens
 *
 * @method \App\Model\Entity\HelpsWhatsup get($primaryKey, $options = [])
 * @method \App\Model\Entity\HelpsWhatsup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HelpsWhatsup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HelpsWhatsup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HelpsWhatsup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsWhatsup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HelpsWhatsup findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HelpsWhatsupsTable extends Table
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

        $this->table('helps_whatsups');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('HelpsWheres', [
            'foreignKey' => 'helps_where_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('HelpsWhens', [
            'foreignKey' => 'helps_whatsup_id'
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
            ->requirePresence('whatsup_name', 'create')
            ->notEmpty('whatsup_name');

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
        $rules->add($rules->existsIn(['helps_where_id'], 'HelpsWheres'));

        return $rules;
    }
}
