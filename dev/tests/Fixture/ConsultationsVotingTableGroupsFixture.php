<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConsultationsVotingTableGroupsFixture
 *
 */
class ConsultationsVotingTableGroupsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'consultation_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'voting_table_group_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'consultation_id' => ['type' => 'index', 'columns' => ['consultation_id'], 'length' => []],
            'voting_table_group_id' => ['type' => 'index', 'columns' => ['voting_table_group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'consultations_voting_table_groups_ibfk_1' => ['type' => 'foreign', 'columns' => ['consultation_id'], 'references' => ['consultations', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'consultations_voting_table_groups_ibfk_2' => ['type' => 'foreign', 'columns' => ['voting_table_group_id'], 'references' => ['voting_table_groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'consultation_id' => 1,
            'voting_table_group_id' => 1,
            'created' => '2016-10-24 14:58:27',
            'modified' => '2016-10-24 14:58:27'
        ],
    ];
}
