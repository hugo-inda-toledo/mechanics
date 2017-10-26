<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnsweredQuestions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AnsweredSurveys
 *
 * @method \App\Model\Entity\AnsweredQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\AnsweredQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AnsweredQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AnsweredQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AnsweredQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AnsweredQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AnsweredQuestion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnsweredQuestionsTable extends Table
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

        $this->table('answered_questions');
        $this->displayField('answered_surveys_id');
        $this->primaryKey('answered_surveys_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AnsweredSurveys', [
            'foreignKey' => 'answered_surveys_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['answered_surveys_id'], 'AnsweredSurveys'));

        return $rules;
    }
}
