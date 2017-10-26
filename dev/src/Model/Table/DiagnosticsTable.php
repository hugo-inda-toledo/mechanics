<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diagnostics Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HelpsWheres
 * @property \Cake\ORM\Association\BelongsTo $HelpsWhatsups
 * @property \Cake\ORM\Association\BelongsTo $HelpsWhens
 * @property \Cake\ORM\Association\BelongsTo $HelpsSituations
 * @property \Cake\ORM\Association\BelongsTo $HelpsHowOftens
 * @property \Cake\ORM\Association\BelongsTo $Requests
 *
 * @method \App\Model\Entity\Diagnostic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Diagnostic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Diagnostic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Diagnostic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diagnostic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Diagnostic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Diagnostic findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DiagnosticsTable extends Table
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

        $this->table('diagnostics');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('HelpsWheres', [
            'foreignKey' => 'helps_where_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HelpsWhatsups', [
            'foreignKey' => 'helps_whatsup_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HelpsWhens', [
            'foreignKey' => 'helps_when_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HelpsSituations', [
            'foreignKey' => 'helps_situation_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HelpsHowOftens', [
            'foreignKey' => 'helps_how_often_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Requests', [
            'foreignKey' => 'request_id'
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
        $rules->add($rules->existsIn(['helps_whatsup_id'], 'HelpsWhatsups'));
        $rules->add($rules->existsIn(['helps_when_id'], 'HelpsWhens'));
        $rules->add($rules->existsIn(['helps_situation_id'], 'HelpsSituations'));
        $rules->add($rules->existsIn(['helps_how_often_id'], 'HelpsHowOftens'));
        $rules->add($rules->existsIn(['request_id'], 'Requests'));

        return $rules;
    }
}
