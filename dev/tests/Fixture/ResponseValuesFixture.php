<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResponseValuesFixture
 *
 */
class ResponseValuesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'b_code_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'voting_table_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'election_alternative_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'survey_alternative_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'priorization_alternative_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'motion_alternative_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'blank_vote' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'null_vote' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'confirmed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'response_open_type' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'b_code_id' => ['type' => 'index', 'columns' => ['b_code_id'], 'length' => []],
            'election_alternative_id' => ['type' => 'index', 'columns' => ['election_alternative_id'], 'length' => []],
            'motion_alternative_id' => ['type' => 'index', 'columns' => ['motion_alternative_id'], 'length' => []],
            'priorization_alternative_id' => ['type' => 'index', 'columns' => ['priorization_alternative_id'], 'length' => []],
            'survey_alternative_id' => ['type' => 'index', 'columns' => ['survey_alternative_id'], 'length' => []],
            'voting_table_id' => ['type' => 'index', 'columns' => ['voting_table_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'response_values_ibfk_1' => ['type' => 'foreign', 'columns' => ['b_code_id'], 'references' => ['b_codes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'response_values_ibfk_2' => ['type' => 'foreign', 'columns' => ['election_alternative_id'], 'references' => ['election_alternatives', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'response_values_ibfk_3' => ['type' => 'foreign', 'columns' => ['motion_alternative_id'], 'references' => ['motion_alternatives', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'response_values_ibfk_4' => ['type' => 'foreign', 'columns' => ['priorization_alternative_id'], 'references' => ['priorization_alternatives', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'response_values_ibfk_5' => ['type' => 'foreign', 'columns' => ['survey_alternative_id'], 'references' => ['survey_alternatives', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'response_values_ibfk_6' => ['type' => 'foreign', 'columns' => ['voting_table_id'], 'references' => ['voting_tables', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'b_code_id' => 1,
            'voting_table_id' => 1,
            'election_alternative_id' => 1,
            'survey_alternative_id' => 1,
            'priorization_alternative_id' => 1,
            'motion_alternative_id' => 1,
            'blank_vote' => 1,
            'null_vote' => 1,
            'confirmed' => 1,
            'response_open_type' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ],
    ];
}
