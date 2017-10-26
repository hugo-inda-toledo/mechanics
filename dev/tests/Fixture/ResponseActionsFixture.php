<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResponseActionsFixture
 *
 */
class ResponseActionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'a_code_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'voting_table_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'uuid' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'confirmation_uuid' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'confirmed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'a_code_id' => ['type' => 'index', 'columns' => ['a_code_id'], 'length' => []],
            'voting_table_id' => ['type' => 'index', 'columns' => ['voting_table_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'response_actions_ibfk_1' => ['type' => 'foreign', 'columns' => ['a_code_id'], 'references' => ['a_codes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'response_actions_ibfk_2' => ['type' => 'foreign', 'columns' => ['voting_table_id'], 'references' => ['voting_tables', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'a_code_id' => 1,
            'voting_table_id' => 1,
            'uuid' => 'Lorem ipsum dolor sit amet',
            'confirmation_uuid' => 'Lorem ipsum dolor sit amet',
            'confirmed' => 1
        ],
    ];
}
