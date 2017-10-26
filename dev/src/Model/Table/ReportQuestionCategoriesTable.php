<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReportQuestionCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $ReportQuestionAnswers
 * @property \Cake\ORM\Association\HasMany $ReportQuestions
 *
 * @method \App\Model\Entity\ReportQuestionCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReportQuestionCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReportQuestionCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReportQuestionCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReportQuestionCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportQuestionCategoriesTable extends Table
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

        $this->table('report_question_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ReportQuestionAnswers', [
            'foreignKey' => 'report_question_category_id'
        ]);
        $this->hasMany('ReportQuestions', [
            'foreignKey' => 'report_question_category_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
