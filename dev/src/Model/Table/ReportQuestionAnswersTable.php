<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReportQuestionAnswers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestions
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestionAlternatives
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestionCategories
 * @property \Cake\ORM\Association\BelongsTo $Reports
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestionGroups
 *
 * @method \App\Model\Entity\ReportQuestionAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReportQuestionAnswer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAnswer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReportQuestionAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionAnswer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportQuestionAnswersTable extends Table
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

        $this->table('report_question_answers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ReportQuestions', [
            'foreignKey' => 'report_question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReportQuestionAlternatives', [
            'foreignKey' => 'report_question_alternative_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReportQuestionCategories', [
            'foreignKey' => 'report_question_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Reports', [
            'foreignKey' => 'report_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReportQuestionGroups', [
            'foreignKey' => 'report_question_group_id'
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
            ->integer('score')
            ->requirePresence('score', 'create')
            ->notEmpty('score');

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
        $rules->add($rules->existsIn(['report_question_alternative_id'], 'ReportQuestionAlternatives'));
        $rules->add($rules->existsIn(['report_question_category_id'], 'ReportQuestionCategories'));
        $rules->add($rules->existsIn(['report_id'], 'Reports'));
        $rules->add($rules->existsIn(['report_question_group_id'], 'ReportQuestionGroups'));

        return $rules;
    }
}
