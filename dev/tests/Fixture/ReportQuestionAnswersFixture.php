<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReportQuestionAnswersFixture
 *
 */
class ReportQuestionAnswersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'report_question_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'report_question_alternative_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'report_question_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'score' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'report_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'report_question_group_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'report_question_id' => ['type' => 'index', 'columns' => ['report_question_id'], 'length' => []],
            'report_question_alternative_id' => ['type' => 'index', 'columns' => ['report_question_alternative_id'], 'length' => []],
            'report_question_category_id' => ['type' => 'index', 'columns' => ['report_question_category_id'], 'length' => []],
            'report_id' => ['type' => 'index', 'columns' => ['report_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'report_question_answers_ibfk_1' => ['type' => 'foreign', 'columns' => ['report_question_id'], 'references' => ['report_questions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'report_question_answers_ibfk_2' => ['type' => 'foreign', 'columns' => ['report_question_alternative_id'], 'references' => ['report_question_alternatives', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'report_question_answers_ibfk_3' => ['type' => 'foreign', 'columns' => ['report_question_category_id'], 'references' => ['report_question_categories', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'report_question_answers_ibfk_4' => ['type' => 'foreign', 'columns' => ['report_id'], 'references' => ['reports', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'report_question_id' => 1,
            'report_question_alternative_id' => 1,
            'report_question_category_id' => 1,
            'score' => 1,
            'created' => '2017-02-24 17:30:10',
            'report_id' => 1,
            'report_question_group_id' => 1
        ],
    ];
}
