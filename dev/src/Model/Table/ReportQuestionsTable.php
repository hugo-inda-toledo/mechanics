<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReportQuestions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestionCategories
 * @property \Cake\ORM\Association\BelongsTo $ReportQuestionGroups
 * @property \Cake\ORM\Association\HasMany $ReportQuestionAlternatives
 * @property \Cake\ORM\Association\HasMany $ReportQuestionAnswers
 *
 * @method \App\Model\Entity\ReportQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReportQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReportQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReportQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportQuestionsTable extends Table
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

        $this->table('report_questions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ReportQuestionCategories', [
            'foreignKey' => 'report_question_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReportQuestionGroups', [
            'foreignKey' => 'report_question_group_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ReportQuestionAlternatives', [
            'foreignKey' => 'report_question_id'
        ]);
        $this->hasMany('ReportQuestionAnswers', [
            'foreignKey' => 'report_question_id'
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
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->requirePresence('tips', 'create')
            ->notEmpty('tips');

        $validator
            ->requirePresence('obs', 'create')
            ->notEmpty('obs');

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

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
        $rules->add($rules->existsIn(['report_question_category_id'], 'ReportQuestionCategories'));
        $rules->add($rules->existsIn(['report_question_group_id'], 'ReportQuestionGroups'));

        return $rules;
    }
}
