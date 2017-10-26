<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReportQuestionAlternatives Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestions
 * @property \Cake\ORM\Association\HasMany $ReportQuestionAnswers
 *
 * @method \App\Model\Entity\ReportQuestionAlternative get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReportQuestionAlternative newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAlternative[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAlternative|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReportQuestionAlternative patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAlternative[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAlternative findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportQuestionAlternativesTable extends Table
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

        $this->table('report_question_alternatives');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ReportQuestions', [
            'foreignKey' => 'report_question_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ReportQuestionAnswers', [
            'foreignKey' => 'report_question_alternative_id'
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
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->integer('score')
            ->requirePresence('score', 'create')
            ->notEmpty('score');

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
        $rules->add($rules->existsIn(['report_question_id'], 'ReportQuestions'));

        return $rules;
    }
}
